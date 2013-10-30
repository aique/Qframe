<?php

class Library_Qframe_I18n_Money_MoneyHelper
{
	const EURO = "euro";
	const DOLLAR = "dollar";
	
	public static function getCurrencyByLocation($location)
	{
		$currency = false;
		
		if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($location))
		{
			$currency = self::DOLLAR;
		}
		elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($location))
		{
			$currency = self::EURO;
		}
		elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($location))
		{
			$currency = self::EURO;
		}
		else
		{
			throw new Exception('No se ha encontrado la moneda correspondiente a la localización ' . $location . '.');
		}
		
		return $currency;
	}
}