<?php

class Library_Qframe_Html_Element_TextArea extends Library_Qframe_Html_Element_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array(),
								$template = null)
	{
		parent::__construct(Library_Qframe_Html_Const_FormElementConst::TEXT_AREA, $attributes, $validations, $template, new Library_Qframe_Html_Printer_TextAreaPrinter());
	}
	
	public function getValue()
	{
		return $this->getAttribute('display');
	}
	
	public function setValue($value)
	{
		$this->addAttribute('display', $value);
	}
}