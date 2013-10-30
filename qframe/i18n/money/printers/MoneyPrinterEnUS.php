<?php

	class Library_Qframe_I18n_Money_Printers_MoneyPrinterEnUS
	{
		public static function doPrint($money, $format)
		{
			switch($format)
			{
				case(Library_Qframe_I18n_Money_MoneyFormat::CURRENCY):
					return self::printCurrencyFormat($money);
					break;
				case(Library_Qframe_I18n_Money_MoneyFormat::AMOUNT):
					return self::printAmountFormat($money);
					break;
				default:
					throw new Exception('El formato recibido es incorrecto, se ha encontrado ' . $format . '.');
			}
		}
		
		private static function printCurrencyFormat($money)
		{
			$currency = "$";
			
			return self::printAmountFormat($money) . ' ' . $currency;
		}
		
		private static function printAmountFormat($money)
		{
			$decimalPart = $money->getDecimalPart();
			
			if($decimalPart > 0)
			{
				return number_format($money->getIntegerPart() , 0, '.' , ',') . '.' . $money->getDecimalPart();
			}
			else
			{
				return number_format($money->getIntegerPart() , 0, '.' , ',');
			}
		}
	}

?>