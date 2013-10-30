<?php

class Library_Qframe_Html_Printer_DivPrinter extends Library_Qframe_Html_Printer_ElementBasePrinter
{
	public function standardPrint()
	{
		$output = "<div";
		
		$class = $this->getElement()->getAttribute("class");
		
		if($class)
		{
			$output .= ' class="'.$class.'"';
		}

		$id = $this->getElement()->getAttribute("id");
		
		if($id)
		{
			$output .= ' id="'.$id.'"';
		}
		
		$output .= ">";
		
		$elements = $this->getElement()->getElements();
		
		if(count($elements) > 0)
		{
			foreach($elements as $element)
			{
				$output .= $element->getPrinter()->standardPrint();
			}
		}
		
		$output .= "</div>";
		
		return $output;
	}
}