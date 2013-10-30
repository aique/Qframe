<?php

abstract class Library_Qframe_Html_Printer_FormElementPrinter extends Library_Qframe_Html_Printer_ElementBasePrinter
{
	protected $template;
	
	/**
	 * Devuelve el valor del atributo template.
	 *
	 * @return string
	 */
	public function getTemplate()
	{
	    return $this->template;
	}
	 
	/**
	 * Establece el valor del atributo template.
	 *
	 * @param string $template
	 */
	public function setTemplate($template)
	{
	    $this->template = $template;
	}
	
	public function standardPrint()
	{
		$this->initPrint();
		
		return Library_Qframe_File_FileUtil::getFileContent($this->template, array('element' => $this->getElement()));
	}
	
	protected function initPrint()
	{
		
	}
}