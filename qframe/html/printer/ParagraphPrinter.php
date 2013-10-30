<?php

class Library_Qframe_Html_Printer_ParagraphPrinter extends Library_Qframe_Html_Printer_ElementBasePrinter
{
	public function standardPrint()
	{
		$output = "<p";
		
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
		
		$output .= $this->getElement()->getAttribute('value');
		
		$output .= "</p>";
		
		return $output;
	}
}