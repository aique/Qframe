<?php

	class Library_Qframe_I18n_Text_TextPrinter
	{
		public static function doPrint($text, $params)
		{
			return self::replaceParams($text, $params);
		}
		
		private static function replaceParams($text, $params)
		{
			for($i = 0 ; $i < count($params) ; $i++)
			{
				$text = str_replace("?" . ($i + 1), $params[$i], $text);
			}
			
			return $text;
		}
		
	}

?>