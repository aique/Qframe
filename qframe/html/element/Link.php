<?php

class Library_Qframe_Html_Element_Link extends Library_Qframe_Html_Element_BaseElement
{
	public function __construct(array $attributes = array())
	{
		parent::__construct(Library_Qframe_Html_Const_BaseElementConst::LINK, $attributes, new Library_Qframe_Html_Printer_LinkPrinter());
	}
}