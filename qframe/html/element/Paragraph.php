<?php

class Library_Qframe_Html_Element_Paragraph extends Library_Qframe_Html_Element_BaseElement
{
	public function __construct(array $attributes = array())
	{
		parent::__construct(Library_Qframe_Html_Const_BaseElementConst::PARAGRAPH, $attributes, new Library_Qframe_Html_Printer_ParagraphPrinter());
		
		$elements = array();
	}
}