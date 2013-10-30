<?php

class Library_Qframe_View_Element_CSS_Printer
{
	public static function printFile(Library_Qframe_View_Element_CSS_File $file)
	{
		$txtType = '';
		if ($file->getType() != '')
		{
			$txtType =  'type="'.$file->getType().'"';
		}
		return '<link rel="'.$file->getRel().'" '.$txtType.' href="'.$file->getHref().'" media="'.$file->getMedia().'" />';
	}
}