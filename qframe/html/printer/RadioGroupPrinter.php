<?php

class Library_Qframe_Html_Printer_RadioGroupPrinter extends Library_Qframe_Html_Printer_FormElementPrinter
{
	protected function initPrint()
	{
		$radioChecked = $this->element->isRadioChecked();
		
		$radios = $this->element->getRadios();
		
		if(count($radios) > 0)
		{
			if(!$radioChecked)
			{
				$radios[0]->addAttribute('checked', 'checked');
			}
		}
	}
}