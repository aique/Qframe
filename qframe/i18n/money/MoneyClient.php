<?php

	class Library_Qframe_I18n_Money_MoneyClient
	{
		public static function getMoney($money, $format)
		{
			$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
			
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$money = Library_Qframe_I18n_Money_Printers_MoneyPrinterEnUS::doPrint($money, $format, $locale);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$money = Library_Qframe_I18n_Money_Printers_MoneyPrinterEsES::doPrint($money, $format, $locale);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($locale))
			{
				$money = Library_Qframe_I18n_Money_Printers_MoneyPrinterPtPT::doPrint($money, $format, $locale);
			}
			else
			{
				exit("Lenguaje no reconocido.");
			}
			
			return $money;
		}
		
	}

?>