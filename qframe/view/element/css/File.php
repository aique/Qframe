<?php

class Library_Qframe_View_Element_CSS_File
{
	private $type;
	private $href;
	private $rel;
	private $media;
	
	public function __construct($type, $href, $rel, $media)
	{
		$this->type = $type;
		$this->href = $href;
		$this->rel = $rel;
		$this->media = $media;
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
	 * Devuelve el valor del atributo href.
	 *
	 * @return string
	 */
	public function getHref()
	{
	    return $this->href;
	}
	 
	/**
	 * Establece el valor del atributo href.
	 *
	 * @param string $href
	 */
	public function setHref($href)
	{
	    $this->href = $href;
	}
	
	/**
	 * Devuelve el valor del atributo rel.
	 *
	 * @return string
	 */
	public function getRel()
	{
	    return $this->rel;
	}
	 
	/**
	 * Establece el valor del atributo rel.
	 *
	 * @param string $rel
	 */
	public function setRel($rel)
	{
	    $this->rel = $rel;
	}
	
	/**
	 * Devuelve el valor del atributo media.
	 *
	 * @return string
	 */
	public function getMedia()
	{
	    return $this->media;
	}
	 
	/**
	 * Establece el valor del atributo media.
	 *
	 * @param string $media
	 */
	public function setMedia($media)
	{
	    $this->media = $media;
	}
	
	public function __toString()
	{
		return Library_Qframe_View_Element_CSS_Printer::printFile($this);
	}
}