<?php

/**
 * Clase que parsea un fichero de traducciones.
 * 
 * Estos ficheros se encuentran en el directorio application/configs/locale/[siglaIdioma]/screen,
 * divididos en distintas carpetas que representan el nombre de los controladores y dentro de
 * ficheros con el nombre de los diferentes action en los que participan.
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Parsers_TranslationsFileParser
{
	/**
	 * Parsea el contenido de un fichero de traducciones y devuelve un array
	 * asociativo con los valores encontrados en un formato interpretable por
	 * la aplicación.
	 * 
	 * Cada clave de este array será un literal encontrado y el valor asociado
	 * a ella será el contenido	que debe ser sustituido en la vista. El formato
	 * por tanto es el siguiente:
	 * 
	 * - ("literal1" => "traduccion1", "literal2" => "traduccion2", ... )
	 * 
	 * @param string $filePath
	 * 
	 * 		Cadena de texto con la ubicación donde se encuentra el fichero
	 * 		de traducciones.
	 * 
	 * @return array
	 * 
	 * 		Array asociativo con las traducciones encontradas.
	 */
	public static function parse($filePath)
	{	
		$translations = array();
		
		if(file_exists($filePath))
		{
			$handler = fopen($filePath, 'r');
		
			while(!feof($handler))
			{
				$line = trim(fgets($handler));
			
				if(!empty($line))
				{
					$translation = self::getTranslation($line);
			
					if(isset($translation[0]) && isset($translation[1]))
					{
						$translations[$translation[0]] = $translation[1];
					}
				}
			}
			
			fclose($handler);
		}
		
		return $translations;
	}
	
	/**
	 * Identifica los valores que se encuentran dentro de una línea del
	 * fichero de traducciones y devuelve un array de dos elementos; el
	 * primero es el literal y el segundo el valor asociado a él.
	 * 
	 * Cada una de estas líneas tienen el siguiente formato:
	 * 
	 * - [literal] = "[contenido]"
	 * 
	 * @param string $line
	 * 
	 * 		Cadena de texto con una de las línea del fichero de traducciones.
	 * 
	 * @return
	 * 		
	 * 		Array con la información de la traducción establecida.
	 * 		
	 */
	private static function getTranslation($line)
	{
		$translation = array();
		
		$translation[0] = trim(substr($line, 0, stripos($line, '=')));
		
		$transInitValue = stripos($line, '"');
		$transEndValue = strrpos($line, '"');
	
		$translation[1] = substr($line, $transInitValue + 1, $transEndValue - $transInitValue - 1);
	
		return $translation;
	}
	
}