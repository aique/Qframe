<?php

class Library_Qframe_Html_Element_RadioGroup extends Library_Qframe_Html_Element_FormElement
{
	private $radios;
	
	public function __construct(array $attributes = array(), array $validations = array(), $template = null)
	{
		$this->radios = array();
		
		parent::__construct(Library_Qframe_Html_Const_FormElementConst::RADIO_GROUP, $attributes, $validations, $template, new Library_Qframe_Html_Printer_RadioGroupPrinter());
	}
	
	/**
	 * Devuelve el valor del atributo radios.
	 *
	 * @return array
	 */
	public function getRadios()
	{
	    return $this->radios;
	}
	 
	/**
	 * Establece el valor del atributo radios.
	 *
	 * @param array $radios
	 */
	public function setRadios(array $radios)
	{
	    $this->radios = $radios;
	}
	
	public function addRadio(Library_Qframe_Html_Element_Radio $radio)
	{
		$this->radios[] = $radio;
	}
	
        public function getValue()
	{
                $value = "";
		
		$radios = $this->radios;
		
		for($i = 0 ; $i < count($radios) && !$value ; $i++)
		{
			if($radios[$i]->getAttribute('checked') == 'checked')
			{
				$value = $radios[$i]->getValue();
			}
		}
                
                return $value;
	}
        
	public function setValue($value)
	{
		$settedValue = false;
		
		$radios = $this->radios;
		
		for($i = 0 ; $i < count($radios) && !$settedValue ; $i++)
		{
			if($radios[$i]->getAttribute('value') == $value)
			{
				$radios[$i]->addAttribute('checked', 'checked');
			}
		}
	}
	
	public function isRadioChecked()
	{
		foreach($this->radios as $radio)
		{
			if($radio->getAttribute('checked'))
			{
				return true;
			}
		}
		
		return false;
	}
	
}