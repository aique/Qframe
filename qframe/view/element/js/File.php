<?php

class Library_Qframe_View_Element_JS_File
{
	private $type;
	private $src;
	
	public function __construct($type, $src)
	{
		$this->type = $type;
		$this->src = $src;
	}
	
	/**
	 * Devuelve el valor del atributo type.
	 *
	 * @return string
	 */
	public function getType()
	{
	    return $this->type;
	}
	 
	/**
	 * Establece el valor del atributo type.
	 *
	 * @param string $type
	 */
	public function setType($type)
	{
	    $this->type = $type;
	}
	
	/**
	 * Devuelve el valor del atributo src.
	 *
	 * @return string
	 */
	public function getSrc()
	{
	    return $this->src;
	}
	 
	/**
	 * Establece el valor del atributo src.
	 *
	 * @param string $src
	 */
	public function setSrc($src)
	{
	    $this->src = $src;
	}
	
	public function __toString()
	{
		return Library_Qframe_View_Element_JS_Printer::printFile($this);
	}
}