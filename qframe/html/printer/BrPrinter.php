<?php

class Library_Qframe_Html_Printer_BrPrinter extends Library_Qframe_Html_Printer_ElementBasePrinter
{
	public function standardPrint()
	{
		$output = "<br";
		
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
		
		$output .= " />";
		
		return $output;
	}
}