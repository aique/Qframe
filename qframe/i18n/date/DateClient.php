<?php

	class Library_Qframe_I18n_Date_DateClient
	{
		public static function getDate($date, $format, $locale = null)
		{
			if(!$locale)
			{
				$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
			}
			
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterEnUS::doPrint($date, $format);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterEsES::doPrint($date, $format);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterPtPT::doPrint($date, $format);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
			
			return $date;
		}
		
		public static function getMultipleDates(array $dates, $format)
		{
			$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
			
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterEnUS::getMultipleDates($dates, $format);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterEsES::getMultipleDates($dates, $format);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterPtPT::getMultipleDates($dates, $format);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
				
			return $date;
		}
		
		public static function getMonthName($monthNumber)
		{
			$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
				
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$monthName = Library_Qframe_I18n_Date_Printers_DatePrinterEnUS::getMonthName($monthNumber);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$monthName = Library_Qframe_I18n_Date_Printers_DatePrinterEsES::getMonthName($monthNumber);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($locale))
			{
				$monthName = Library_Qframe_I18n_Date_Printers_DatePrinterPtPT::getMonthName($monthNumber);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
				
			return $monthName;
		}
                
        public static function getShortMonthName($monthNumber)
		{
			$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
				
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$monthName = Library_Qframe_I18n_Date_Printers_DatePrinterEnUS::getShortMonthName($monthNumber);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$monthName = Library_Qframe_I18n_Date_Printers_DatePrinterEsES::getShortMonthName($monthNumber);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($locale))
			{
				$monthName = Library_Qframe_I18n_Date_Printers_DatePrinterPtPT::getShortMonthName($monthNumber);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
				
			return $monthName;
		}
		
	}

?>