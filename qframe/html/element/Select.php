<?php

class Library_Qframe_Html_Element_Select extends Library_Qframe_Html_Element_FormElement
{
	private $options;
	
	public function __construct(array $attributes = array(),
								array $validations = array(),
								$template = null)
	{
		parent::__construct(Library_Qframe_Html_Const_FormElementConst::SELECT, $attributes, $validations, $template, new Library_Qframe_Html_Printer_SelectPrinter);
	}
	
	/**
	 * Devuelve el valor del atributo options.
	 *
	 * @return array
	 */
	public function getOptions()
	{
	    return $this->options;
	}
	 
	/**
	 * Establece el valor del atributo options.
	 *
	 * @param array $options
	 */
	public function setOptions($options)
	{
	    $this->options = $options;
	}
	
	public function addOption(Library_Qframe_Html_Element_Option $option)
	{
		$this->options[] = $option;
	}
	
	public function getValue()
	{
		$value = "";
		
		if(count($this->options) > 0)
		{
			foreach($this->options as $option)
			{
				if($option->getAttribute("selected") == "selected")
				{
					$value = $option->getValue();
				}
			}
		}
		
		return $value;
	}
	
	public function setValue($value)
	{
        if(count($this->options) > 0)
        {
			foreach($this->options as $option)
			{
				if($option->getValue() == $value)
				{
					$option->addAttribute("selected", "selected");
				}
			}
        }
	}
}