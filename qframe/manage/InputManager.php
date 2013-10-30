<?php

/**
 * Clase encargada de gestionar la entrada de datos a aplicación.
 * 
 * Se encargará de ofrecer los métodos necesarios para comunicarse
 * con el usuario a través de la información enviada tanto por GET
 * como por POST.
 * 
 * A su vez también deberá eliminar auqella información introducida
 * por el usuario que pueda poner en peligro la seguridad de la aplicación.
 * 
 * @package qframe
 * 
 * @subpackage manage
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Manage_InputManager
{
	const GET = "GET";
	const POST = "POST";
	
	const INTEGER = "int";
	const FLOAT = "float";
	const STRING = "string";
	
	const LOW_CLEAN = 'low_clean';
	const HIGH_CLEAN = 'high_clean';
	
	/**
	 * Devuelve el valor de un parámetro enviado a la aplicación a
	 * partir de su nombre y del método utilizado para realizar este
	 * envío.
	 * 
	 * @param string $name
	 * 
	 * 		Nombre del parámetro cuyo valor se desea obtener.
	 * 
	 * @param string $method
	 * 
	 * 		Nombre del método utilizado en el envío del parámetro.
	 * 
	 * @return
	 * 
	 * 		Cadena de texto con el valor del parámetro solicitado.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de que el segundo parámetro
	 * 		que identifica el medio por el que se le ha enviado el
	 * 		parámetro no sea ni GET ni POST.
	 */
	public static function getParam($name, $method = self::POST, $restrictionDegree = self::HIGH_CLEAN, $allowedTags = null)
	{
		$param = false;
		
		if($method == self::GET)
		{
			if(isset($_GET[$name]))
			{
				$param = self::clean($_GET[$name], $restrictionDegree, $allowedTags);
			}
		}
		elseif($method == self::POST)
		{
			if(isset($_POST[$name]))
			{
				$param = self::clean($_POST[$name], $restrictionDegree, $allowedTags);
			}
		}
		else
		{
			throw new Exception("Se intenta acceder a una variable con entrada " . $method . ". Sólo GET y POST están permitidas.");
		}
		
		return $param;
	}
	
	/**
	 * Devuelve en un array asociativo todos los parámetros enviados
	 * a través de un determinado método de envío.
	 * 
	 * @param string $method
	 * 
	 * 		Método de envío del cual se quieren obtener todos los parámetros.
	 * 
	 * @return array
	 * 
	 * 		Array asociativo con los parámetros solicitados.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de que el segundo parámetro
	 * 		que identifica el medio por el que se le ha enviado el
	 * 		parámetro no sea ni GET ni POST.
	 */
	public static function getParams($method = self::POST, $restrictionDegree = self::HIGH_CLEAN)
	{
		$params = array();
		
		if($method == self::GET)
		{
			foreach($_GET as $key => $value)
			{
				$params[$key] = self::clean($value, $restrictionDegree);
			}
		}
		elseif($method == self::POST)
		{
			foreach($_POST as $key => $value)
			{
				$params[$key] = self::clean($value, $restrictionDegree);
			}
		}
		else
		{
			throw new Exception("Se intenta acceder a las variables con entrada " . $method . ". Sólo GET y POST están permitidas.");
		}
		
		return $params;
	}
	
	/**
	 * Devuelve en un array asociativo todos los ficheros subidos
	 * desde un formulario HTML.
	 *
	 * @return array
	 *
	 * 		Array asociativo con los ficheros solicitados.
	 */
	public static function getFileNames()
	{
		$files = array();
	
		foreach($_FILES as $key => $value)
		{
			$files[$key] = self::clean($value['name']);
		}		
	
		return $files;
	}
	
	public static function getFilePath($fileInputName)
	{
		return $_FILES[$fileInputName]['tmp_name'];
	}
	
	/**
	 * Comprueba si se ha realizado una petición GET sobre la aplicación.
	 * 
	 * @return boolean
	 * 
	 * 		Devuelve true en caso que se haya enviado información
	 * 		a la aplicación mediante GET y false en caso contrario.
	 */
	public static function isGET()
	{
		return count($_GET) > 0;
	}
	
	/**
	* Comprueba si se ha realizado una petición POST sobre la aplicación.
	*
	* @return boolean
	*
	* 		Devuelve true en caso que se haya enviado información
	* 		a la aplicación mediante POST y false en caso contrario.
	*/
	public static function isPOST()
	{
		return (count($_POST) > 0 || count($_FILES) > 0);
	}
	
	public static function cleanQueryParam($param, $type)
	{
     	$param = addslashes($param);
           
        switch($type)
        {
            case self::INTEGER:				
                Library_Qframe_Manage_DBManager::getInstance()->real_escape_string(intval($param));
            break;

        	case self::FLOAT:
            	Library_Qframe_Manage_DBManager::getInstance()->real_escape_string(floatval($param));
            break;

            case self::STRING:
            	Library_Qframe_Manage_DBManager::getInstance()->real_escape_string(strval($param));
            	break;

            default:
            	throw new Exception('Tipo de parámetro no permitido al realizar la limpieza de la consulta, recibido ' . $type . '.');
            break;
		}

        return $param;
	}
	
	private static function clean($param, $restrictionDegree = self::HIGH_CLEAN, $allowedTags = null)
	{
		switch($restrictionDegree)
		{
			case self::LOW_CLEAN:
				
				if(is_array($param))
				{
					foreach($param as $element)
					{
						$element = self::clean($element, $restrictionDegree, $allowedTags);
					}
				}
				else
				{
					$param = self::lowDegreeClean($param, $allowedTags);
				}
				
				break;
				
			case self::HIGH_CLEAN:
				
				if(is_array($param))
				{
					foreach($param as $element)
					{
						$element = self::clean($element, $restrictionDegree, $allowedTags);
					}
				}
				else
				{
					$param = self::highDegreeClean($param, $allowedTags);
				}
				
				break;
				
			default:
				
				if(is_array($param))
				{
					foreach($param as $element)
					{
						$element = self::clean($element, $restrictionDegree, $allowedTags);
					}
				}
				else
				{
					$param = self::highDegreeClean($param, $allowedTags);
				}
				
				break;
		}
		
		return $param;
	}
	
	private static function lowDegreeClean($param, $allowedTags = null)
	{
		if ($allowedTags == null)
		{
			$param = strip_tags($param);
		}
		else
		{
			$param = strip_tags($param, $allowedTags);
		}
		$param = stripslashes($param);
		
		return $param;
	}
	
	private static function highDegreeClean($param)
	{
		$param = htmlentities($param, ENT_COMPAT, 'UTF-8');
		$param = stripslashes($param);
		
		return $param;
	}
}