<?php

class Library_Qframe_View_Element_JS_Printer
{
	public static function printFile(Library_Qframe_View_Element_JS_File $file)
	{
		return '<script type="'.$file->getType().'" src="'.$file->getSrc().'"></script>';
	}
}