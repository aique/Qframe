<?php
	
	class Library_Qframe_I18n_Date_Printers_DatePrinterEsES
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
			$output = "";
			
			$datesOutputArray = array();
			
			foreach($dates as $date)
			{
				$datesOutputArray[$date->getMonth()][] = $date->getDay();
			}
			
			$i = 0;
			
			foreach($datesOutputArray as $key => $value)
			{
				if(count($value) > 1)
				{
					$output .= "los dias ";
				}
				else
				{
					$output .= "el día ";
				}
				
				for($j = 0 ; $j < count($value) ; $j++)
				{
					if(count($value) > 1)
					{
						if($j == count($value) - 1)
						{
							$output .= "y ".$value[$j]." ";
						}
						else
						{
							if($j == count($value) - 2)
							{
								$output .= $value[$j]." ";
							}
							else
							{
								$output .= $value[$j].", ";
							}
						}
					}
					else
					{
						$output .= $value[$j]." ";
					}
				}
				
				if($i == count($datesOutputArray) - 1)
				{
					$output .= "de ".self::getMonthName($key)." ";
				}
				else
				{
					if($i == count($datesOutputArray) - 2)
					{
						$output .= "de ".self::getMonthName($key)." y ";
					}
					else
					{
						$output .= "de ".self::getMonthName($key)." , ";
					}
				}
				
				$i++;
			}
			
			return $output;
		}
		
		public static function getMonthName($monthNumber)
		{
			$monthName = "";
			
			switch($monthNumber)
			{
				case(1):
					$monthName = "Enero";
					break;
				case(2):
					$monthName = "Febrero";
					break;
				case(3):
					$monthName = "Marzo";
					break;
				case(4):
					$monthName = "Abril";
					break;
				case(5):
					$monthName = "Mayo";
					break;
				case(6):
					$monthName = "Junio";
					break;
				case(7):
					$monthName = "Julio";
					break;
				case(8):
					$monthName = "Agosto";
					break;
				case(9):
					$monthName = "Septiembre";
					break;
				case(10):
					$monthName = "Octubre";
					break;
				case(11):
					$monthName = "Noviembre";
					break;
				case(12):
					$monthName = "Diciembre";
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
					$monthName = "Ene";
					break;
				case(2):
					$monthName = "Feb";
					break;
				case(3):
					$monthName = "Mar";
					break;
				case(4):
					$monthName = "Abr";
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
					$monthName = "Ago";
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
					$monthName = "Dic";
					break;
				default:
					throw new Exception("El valor numérico del mes es incorrecto, recibido " . $monthName . ', debe ser un número entre 1 y 12.');
			}
				
			return $monthName;
		
		}
		
		private static function printShortFormat($date)
		{
			return $date->getDay() . '/' . $date->getMonth() . '/' . $date->getYear();
		}
		
		private static function printLongFormat($date)
		{
			return $date->getDay() . ' de ' . self::getMonthName($date->getMonth()) . ' de ' . $date->getYear();
		}
		
		private static function printLongShortMonthFormat($date)
		{
			return $date->getDay() . ' ' . self::getShortMonthName($date->getMonth()) . ' ' . $date->getYear();
		}
		
		private static function printMonthFormat($date)
		{
			return self::getMonthName($date->getMonth()) . ' ' . $date->getYear();
		}		
		
	}

?>