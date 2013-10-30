<?php

/**
 * Clase que parsea el fichero de configuración de la aplicación.
 * 
 * Este fichero se encuentra en el directorio application/configs/config.ini.
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Parsers_ConfigFileParser
{
	/**
	 * Obtiene el valor de una determinada variable que
	 * se encuentra en el fichero de configuración de la
	 * aplicación, cuyo nombre recibe como parámetro.
	 * 
	 * @param string $filePath
	 * 
	 * 		Cadena de texto que contiene la ubicación del
	 * 		fichero de configuración.
	 * 
	 * @param string $varName
	 * 
	 * 		Nombre de la variable cuyo valor será obtenido.
	 * 
	 * @return unknown_type
	 * 
	 * 		Valor asociado a la variable dentro del fichero
	 * 		de configuración. Devolverá null en caso de que
	 * 		no se haya encontrado ningún valor.
	 */
	public static function getVarValue($filePath, $varName)
	{
		$varValue = null;
		
		$currentEnvironment = null;
		
		$handler = fopen($filePath, 'r');
		
		while(!feof($handler) && $varValue == null)
		{
			$line = trim(fgets($handler));
		
			if(!self::isComment($line) && !empty($line))
			{
				if(self::isEnvironmentDefinition($line))
				{
					$currentEnvironment = null;
					
					$environments = self::getEnvironments($line);
					
					$default = DEFAULT_ENVIRONMENT;
					
					if(in_array($default, $environments))
					{
						$currentEnvironment = DEFAULT_ENVIRONMENT;
					}
				}
				else
				{
					if($currentEnvironment)
					{
						$value = self::getAttributeValue($line);
			
						if(isset($value[0]) && isset($value[1]))
						{
							if($value[0] == $varName)
							{
								$varValue = $value[1];
							}
						}
					}
				}
			}
		}
		
		fclose($handler);
		
		return $varValue;
	}
	
	/**
	 * Parsea el fichero de configuración y devuelve un array asociativo
	 * con los valores encontrados en un formato interpretable por
	 * la aplicación.
	 * 
	 * El array devuelto tendrá el siguiente formato:
 	 * 
 	 * - ("entorno1" => ("atributo1" => "valor1", "atributo2" => "valor2"), "entorno2" => ("atributo3" => "valor3") ... )
 	 * 
	 * @param string $filePath
	 * 
	 * 		Cadena de texto que contiene la ubicación del fichero de
	 * 		configuración.
	 * 
	 * @return array
	 * 
	 * 		Array asociativo con los datos de configuración establecidos.
	 */
	public static function parseAppConfigFile($filePath)
	{	
		$values = array();
		
		$currentEnvironment = null;
		
		$handler = fopen($filePath, 'r');
		
		while(!feof($handler))
		{
			$line = trim(fgets($handler));
				
			if(!self::isComment($line) && !empty($line))
			{
				if(self::isEnvironmentDefinition($line))
				{
					$environments = self::getEnvironments($line);
				}
				else
				{
					$value = self::getAttributeValue($line);
		
					if(isset($value[0]) && isset($value[1]))
					{
						foreach($environments as $environment)
						{
							$values[trim($environment)][$value[0]] = $value[1];
						}
					}
				}
					
			}
		}
		
		fclose($handler);
		
		return $values;
	}
	
	/**
	* Parsea el fichero de configuración del usuario y devuelve un array
	* con los valores encontrados en un formato interpretable por la
	* aplicación.
	*
	* @param string $filePath
	*
	* 		Cadena de texto que contiene la ubicación del fichero de
	* 		configuración del usuario.
	*
	* @return array
	*
	* 		Array con los datos de configuración establecidos.
	*/
	public static function parseUserConfigFile($filePath)
	{
		$values = array();
	
		$handler = fopen($filePath, 'r');
	
		while(!feof($handler))
		{
			$line = trim(fgets($handler));
	
			if(!self::isComment($line) && !empty($line))
			{
				$value = self::getAttributeValue($line);
	
				if(isset($value[0]) && isset($value[1]))
				{
					$values[$value[0]] = $value[1];
				}
			}
		}
	
		fclose($handler);
	
		return $values;
	}
	
	private static function getAttributeValue($line)
	{
		$values = array();
			
		$varEndPos = stripos($line, '=');
			
		$values[0] = trim(substr($line, 0, $varEndPos));
		
		$values[1] = self::renderValue(trim(substr($line, $varEndPos + 1, strlen($line))));
		
		return $values;
	}
	
	private static function renderValue($value)
	{
		$renderedValue = '';
		 
		$tokens = explode('+', $value);
		
		foreach($tokens as $token)
		{
			$token = trim($token);
			
			if(self::isPHPVar($token))
			{
				$renderedValue .= self::getPHPVarValue($token);
			}
			elseif(self::isTextValue($token))
			{
				$renderedValue .= self::getTextValue($token);
			}
			else
			{
				throw new Exception('No se ha podido renderizar el valor del atributo desde el parser del fichero de configuración: Error de formato en el valor: ' . $value . '.');
			}
		}
		
		return $renderedValue;
	}
	
	private static function getEnvironments($line)
	{
		$envInitValue = stripos($line, '[');
		$envEndValue = strrpos($line, ']');
		
		$environments = explode(':', trim(substr($line, $envInitValue + 1, $envEndValue - 1)));
		
		// Se limpian los posibles espacios en blanco
		
		for($i = 0 ; $i < count($environments) ; $i++)
		{
			$environments[$i] = trim($environments[$i]);
		}
		
		return $environments;
	}
	
	private static function isPHPVar($token)
	{
		return preg_match('/{*}/', $token);
	}
	
	private static function getPHPVarValue($token)
	{
		$varInitPos = stripos($token, '{') + 1;
		$varEndPos = strrpos($token, '}');
		
		return constant(substr($token, $varInitPos, $varEndPos - $varInitPos));
	}
	
	private static function isTextValue($token)
	{
		return preg_match('/"*"/', $token);
	}
	
	private static function getTextValue($token)
	{
		$valInitPos = stripos($token, "\"") + 1;
		$valEndPos = strrpos($token, "\"");
		
		return substr($token, $valInitPos, $valEndPos - $valInitPos);
	}
	
	private static function isComment($line)
	{
		$isComment = preg_match('/^\/\/.*/', $line);
		
		$a = $isComment;
		
		return $isComment;
	}
	
	private static function isEnvironmentDefinition($line)
	{
		return preg_match('/\[*\]/', $line);
	}
	
}