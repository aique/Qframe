<?php

/**
 * Clase que gestiona el contenido del fichero de configuración del usuario.
 * 
 * Cuando se instancia un objeto de esta clase se realiza un parseo
 * del fichero de configuración del usuario. A partir de ese momento,
 * cada una de las variables establecidas en el mencionado fichero serán
 * accesibles utilizando los métodos de esta clase.
 * 
 * @package qframe
 * 
 * @subpackage user
 * 
 * @author qinteractiva 
 */
class Library_Qframe_User_Config
{
	private $configVars;
	
	public function __construct()
	{
		$this->configVars = Library_Qframe_Parsers_ConfigFileParser::parseUserConfigFile(PROJECT_PATH . '/application/configs/user.conf');
	}
	
	/**
	 * Devuelve el array de variables de configuración.
	 *
	 * @return array
	 */
	public function getConfigVars()
	{
	    return $this->configVars;
	}
	 
	/**
	 * Establece el valor del array de variables de configuración.
	 *
	 * @param array $configVars
	 */
	public function setConfigVars($configVars)
	{
	    $this->configVars = $configVars;
	}
	
	/**
	 * Devuelve el valor de una variable de configuración en
	 * función de su nombre.
	 * 
	 * @param string $name
	 * 
	 * 		Nombre de la variable de configuración solicitada.
	 * 
	 * @return string
	 * 
	 * 		Valor de la variable de configuración solicitada.
	 */
	public function getVar($name)
	{
		return $this->configVars[$name];
	}
}