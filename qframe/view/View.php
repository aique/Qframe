<?php

class Library_Qframe_View_View
{
	private $content;
	
	private $jsFileCollection;
	private $cssFileCollection;
	
	public function __construct()
	{
		$this->content = new Library_Qframe_View_Content();
		
		$this->jsFileCollection = array();
		$this->cssFileCollection = array();
	}
	
	/**
	 * Devuelve el valor del atributo jsFileCollection.
	 *
	 * @return array
	 */
	public function getJsFileCollection()
	{
	    return $this->jsFileCollection;
	}
	 
	/**
	 * Establece el valor del atributo jsFileCollection.
	 *
	 * @param array $jsFileCollection
	 */
	public function setJsFileCollection($jsFileCollection)
	{
	    $this->jsFileCollection = $jsFileCollection;
	}
	
	/**
	 * Añade un fichero JavaScript a la vista del controlador.
	 * 
	 * @param Library_Qframe_View_Element_JS_File $jsFile
	 * 
	 * 		Objeto que contiene la información relativa al
	 * 		fichero añadido.
	 */
	public function addJsFile(Library_Qframe_View_Element_JS_File $jsFile, $appendDate = true)
	{
		if($appendDate)
		{
			$cacheDate = Library_Qframe_Parsers_ConfigFileParser::getVarValue(PROJECT_PATH . '/application/configs/config.ini', "common.filescache.date");
		
			$jsFile->setSrc($jsFile->getSrc()."?date_".$cacheDate);
		}
		
		$this->jsFileCollection[] = $jsFile;
	}
	
	/**
	 * Devuelve el valor del atributo cssFileCollection.
	 *
	 * @return array
	 */
	public function getCssFileCollection()
	{
	    return $this->cssFileCollection;
	}
	 
	/**
	 * Establece el valor del atributo cssFileCollection.
	 *
	 * @param array $cssFileCollection
	 */
	public function setCssFileCollection($cssFileCollection)
	{
	    $this->cssFileCollection = $cssFileCollection;
	}
	
	/**
	 * Añade un fichero CSS a la vista del controlador.
	 *
	 * @param Library_Qframe_View_Element_JS_File $jsFile
	 *
	 * 		Objeto que contiene la información relativa al
	 * 		fichero añadido.
	 */
	public function addCssFile(Library_Qframe_View_Element_CSS_File $cssFile, $appendDate = true)
	{
		if($appendDate)
		{
			$cacheDate = Library_Qframe_Parsers_ConfigFileParser::getVarValue(PROJECT_PATH . '/application/configs/config.ini', "common.filescache.date");
		
			$cssFile->setHref($cssFile->getHref()."?date_".$cacheDate);
		}
		
		$this->cssFileCollection[] = $cssFile;
	}
	
	/**
	 * Se utiliza desde la vista para rescatar los valores que
	 * han sido almacenados durante la ejecución del action.
	 * 
	 * El contexto desde el que se suele llamar es HTML.
	 * 
	 * @param string $key
	 * 
	 * 		Cadena de texto que identifica al contenido que se
	 * 		pretende obtener.
	 * 
	 * @return unknown_type
	 * 
	 * 		Variable u objeto almacenado en el array de valores
	 * 		HTML asociado con la etiqueta recibida como parámetro.
	 */
	public function getContent($key)
	{
		return $this->content->getHtmlContent($key);
	}
	
	/**
	 * Añade cualquier tipo de contenido dentro de la vista
	 * desde un contexto HTML.
	 *
	 * @param string $key
	 *
	 * 		Cadena de texto que identificará al contenido
	 * 		almacenado.
	 *
	 * @param unknown_type $value
	 *
	 * 		Variable u objeto que se desea almacenar.
	 */
	public function addContent($key, $value)
	{
		$this->content->addHtmlContent($key, $value);
	}
	
	/**
	 * Se utiliza desde la vista para rescatar los valores que
	 * han sido almacenados durante la ejecución del action en
	 * un contexto JSON.
	 * 
	 * @return array
	 * 
	 * 		array de valores JSON.
	 */
	public function getJsonContent()
	{
		return $this->content->getJsonContent();
	}
	
	/**
	 * Añade cualquier tipo de contenido dentro de la vista
	 * desde un contexto JSON.
	 *
	 * @param string $key
	 *
	 * 		Cadena de texto que identificará al contenido
	 * 		almacenado.
	 *
	 * @param unknown_type $value
	 *
	 * 		Variable u objeto que se desea almacenar.
	 */
	public function addJsonContent($key, $value)
	{
		$this->content->addJsonContent($key, $value);
	}
}