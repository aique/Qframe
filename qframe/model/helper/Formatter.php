<?php

class Library_Qframe_Model_Helper_Formatter
{
	/**
	 * Formatea el nombre de las opciones encontradas dentro
	 * del array que recibe como parámetro el método setOptions.
	 *
	 * Su finalidad es transformar a un formato adecuado las
	 * opciones con un nombre compuesto separado por un guión bajo,
	 * de manera que al añadir el prefijo set el método encaje con
	 * el definido en la clase DAO correspondiente.
	 *
	 * @param string $optionName
	 *
	 * 		Nombre del atributo dentro del array de opciones
	 * 		mencionado, el cual generalmente coincide con el nombre
	 * 		de un campo de la base de datos.
	 *
	 *  @return string
	 *
	 *  	Cadena de texto con el formato indicado para ser asociada
	 *  	a los atributos internos de la clase DAO correspondiente.
	 */
	public static function formatOptionName($optionName)
	{
		while($pos = strpos($optionName, '_'))
		{
			$str1 = substr($optionName, 0, $pos);
			$str2 = substr($optionName, intval($pos + 1), strlen($optionName));
			$optionName = $str1 . ucfirst($str2);
		}
		
		return $optionName;
	}
	
	public static function invertOptionNameFormat($optionName)
	{
		return strtolower(preg_replace('/([A-Z])/', '_$1', $optionName));
	}
	
	public function formatOptionsCollection(array $collection)
	{
		$renamedCollection = array();
		
		foreach($collection as $key => $value)
		{
			$renamedCollection[self::formatOptionName($key)] = $value;
		}
		
		return $renamedCollection;
	}
}