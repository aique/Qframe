<?php

	/**
	 * 
	 */
	class Library_Qframe_I18n_Date_Date
	{
		private $year, $month, $day;
		private $hour, $minutes, $seconds;
		
		public function __construct($day, $month, $year, $hour = 0, $minutes = 0, $seconds = 0)
		{
			$this->day = $day;
			$this->month = $month;
			$this->year = $year;
			$this->hour = $hour;
			$this->minutes = $minutes;
			$this->seconds = $seconds;
		}
		
		/**
		 * Returns the year.
		 * 
		 * @return int Returns the year.
		 */
		public function getYear()
		{
			return $this->year;
		}
		
		/**
		 * Returns the month.
		 * 
		 * @return int Returns the month.
		 */
		public function getMonth()
		{
			return $this->month;
		}
		
		/**
		 * Returns the day.
		 * 
		 * @return int Returns the day.
		 */
		public function getDay()
		{
			return $this->day;
		}
		
	}

?>