<?php

class Library_Qframe_Html_Printer_LinkPrinter extends Library_Qframe_Html_Printer_ElementBasePrinter
{
	public function standardPrint()
	{
		$output = "<a";
		
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
		
		$target = $this->getElement()->getAttribute("target");
		
		if($target)
		{
			$output .= ' target="'.$target.'"';
		}
		
		$href = $this->getElement()->getAttribute("href");
		
		$output .= ' href="'.$href.'"';
		
		$output .= ">";
		
		$text = $this->getElement()->getAttribute("text");
		
		if($text)
		{
			$output .= $text;
		}
		
		$output .= "</a>";
		
		return $output;
	}
}