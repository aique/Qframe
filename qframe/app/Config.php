<?php

/**
 * Clase que gestiona el contenido del fichero de configuración, así como
 * el entorno en el que se está ejecutando la aplicación.
 * 
 * Cuando se instancia un objeto de esta clase se realiza un parseo
 * del fichero de configuración de la aplicación. A partir de ese momento,
 * cada una de las variables establecidas en el mencionado fichero serán
 * accesibles utilizando los métodos de esta clase.
 * 
 * @package qframe
 * 
 * @subpackage app
 * 
 * @author qinteractiva 
 */
class Library_Qframe_App_Config
{
	private $configVars;
	private $currentEnvironment;
	
	public function __construct()
	{
		$this->configVars = Library_Qframe_Parsers_ConfigFileParser::parseAppConfigFile(PROJECT_PATH . '/application/configs/config.ini');
		$this->currentEnvironment = DEFAULT_ENVIRONMENT;
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
		return $this->configVars[$this->currentEnvironment][$name];
	}
	
	/**
	 * Devuelve el nombre del entorno en el que se está ejecutando la aplicación.
	 * 
	 * @return string
	 */
	public function getCurrentEnvironment()
	{
		return $this->currentEnvironment;
	}
	
	/**
	 * Establece el valor del entorno en el que se está ejecutando la aplicación.
	 * 
	 * @param string $currentEnvironment
	 */
	public function setCurrentEnvironment($currentEnvironment)
	{
		$this->currentEnvironment = $currentEnvironment;
	}
}