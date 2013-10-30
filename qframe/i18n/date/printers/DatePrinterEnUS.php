<?php

	class Library_Qframe_I18n_Date_Printers_DatePrinterEnUS
	{
		public static function doPrint($date, $format)
		{
			switch($format)
			{
				case(Library_Qframe_I18n_Date_DateFormat::SHORT):
					return self::printShortFormat($date);
					break;
				case(Library_Qframe_I18n_Date_DateFormat::LONG):
					return self::printLongFormat($date);
					break;
				case(Library_Qframe_I18n_Date_DateFormat::MONTH):
					return self::printMonthFormat($date);
					break;
				case(Library_Qframe_I18n_Date_DateFormat::LONGSHORTMONTH):
					return self::printLongShortMonthFormat($date);
					break;
				default:
					throw new Exception('El formato recibido es incorrecto, se ha encontrado ' . $format . '.');
			}
		}
		
		public static function getMultipleDates(array $dates, $format)
		{
			return "Sin completar";
		}
		
		public static function getMonthName($monthNumber)
		{
			$monthName = "";
			
			switch($monthNumber)
			{
				case(1):
					$monthName = "January";
					break;
				case(2):
					$monthName = "February";
					break;
				case(3):
					$monthName = "March";
					break;
				case(4):
					$monthName = "April";
					break;
				case(5):
					$monthName = "May";
					break;
				case(6):
					$monthName = "June";
					break;
				case(7):
					$monthName = "July";
					break;
				case(8):
					$monthName = "August";
					break;
				case(9):
					$monthName = "September";
					break;
				case(10):
					$monthName = "October";
					break;
				case(11):
					$monthName = "November";
					break;
				case(12):
					$monthName = "December";
					break;
				default:
					throw new Exception("El valor numérico del mes es incorrecto, recibido " . $monthName . ', debe ser un número entre 1 y 12.');
			}
			
			return $monthName;
			
		}
		
		public static function getShortMonthName($monthNumber)
		{
			$monthName = "";
				
			switch($monthNumber)
			{
				case(1):
					$monthName = "Jan";
					break;
				case(2):
					$monthName = "Feb";
					break;
				case(3):
					$monthName = "Mar";
					break;
				case(4):
					$monthName = "Apr";
					break;
				case(5):
					$monthName = "May";
					break;
				case(6):
					$monthName = "Jun";
					break;
				case(7):
					$monthName = "Jul";
					break;
				case(8):
					$monthName = "Aug";
					break;
				case(9):
					$monthName = "Sep";
					break;
				case(10):
					$monthName = "Oct";
					break;
				case(11):
					$monthName = "Nov";
					break;
				case(12):
					$monthName = "Dec";
					break;
				default:
					throw new Exception("El valor numérico del mes es incorrecto, recibido " . $monthName . ', debe ser un número entre 1 y 12.');
			}
				
			return $monthName;
				
		}
		
		private static function printShortFormat($date)
		{
			return $date->getDay() . ' ' . self::getMonthName($date->getMonth()) . ' ' .  $date->getYear();
		}
		
		private static function printLongFormat($date)
		{
			return self::getMonthName($date->getMonth()) . ' ' . self::printCardinalDay($date->getDay()) . ', ' . $date->getYear();
		}
		
		private static function printLongShortMonthFormat($date)
		{
			return self::getShortMonthName($date->getMonth()) . ' ' . self::printCardinalDay($date->getDay()) . ', ' . $date->getYear();
		}
		
		private static function printMonthFormat($date)
		{
			return self::getMonthName($date->getMonth()) . ' ' . $date->getYear();
		}
		
		private static function printCardinalDay($day)
		{
			if($day == 1)
			{
				return '1st';
			}
			elseif($day == 2)
			{
				return '2nd';
			}
			elseif($day == 3)
			{
				return '3rd';
			}
			else
			{
				return $day . 'th';
			}
		}
		
	}

?>