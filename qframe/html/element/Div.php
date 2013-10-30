<?php

class Library_Qframe_Html_Element_Div extends Library_Qframe_Html_Element_BaseElement
{
	private $elements;
	
	public function __construct(array $attributes = array())
	{
		parent::__construct(Library_Qframe_Html_Const_BaseElementConst::DIV, $attributes, new Library_Qframe_Html_Printer_DivPrinter());
		
		$elements = array();
	}
	
	public function getElements()
	{
		return $this->elements;
	}
	
	public function addElement(Library_Qframe_Html_Element_BaseElement $element)
	{
		$this->elements[] = $element;
	}
	
	public function setParam($nameAttribute, $value)
	{
		$paramFounded = false;
		
		for($i = 0 ; $i < count($this->elements) && !$paramFounded ; $i++)
		{
			if(get_class($this->elements[$i]) == "Library_Qframe_Html_Element_Div")
			{
				$this->elements[$i]->setParam($nameAttribute, $value);
			}
			else
			{
				if($nameAttribute == $this->elements[$i]->getAttribute("name"))
				{
					$this->elements[$i]->setValue($value);
					
					$paramFounded = true;
				}
			}
		}
		
		return $paramFounded;
	}
	
	public function setParamById($idAttribute, $value)
	{
		$paramFounded = false;
	
		for($i = 0 ; $i < count($this->elements) && !$paramFounded ; $i++)
		{
			if(get_class($this->elements[$i]) == "Library_Qframe_Html_Element_Div")
			{
				$this->elements[$i]->setParamById($idAttribute, $value);
			}
			else
			{
				if($idAttribute == $this->elements[$i]->getAttribute("id"))
				{
					$this->elements[$i]->setValue($value);
			
					$paramFounded = true;
				}
			}
		}
	
		return $paramFounded;
	}
}