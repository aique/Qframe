<?php

	class Library_Qframe_i18n_Locale
	{
		private $location, $abbreviatedLocation, $universalLocation;
		
		public function __construct($location, $abbreviatedLocation, $universalLocation)
		{
			$this->location = $location;
			$this->abbreviatedLocation = $abbreviatedLocation;
			$this->universalLocation = $universalLocation;
		}
		
		public function getLocation()
		{
			return $this->location;
		}
		
		public function setLocation($location)
		{
			$this->location = $location;
		}
		
		public function getAbbreviatedLocation()
		{
			return $this->abbreviatedLocation;
		}
		
		public function setAbbreviatedLocation($abbreviatedLocation)
		{
			$this->abbreviatedLocation = $abbreviatedLocation;
		}
		
		public function getUniversalLocation()
		{
			return $this->universalLocation;
		}
		
		public function setUniversalLocation($universalLocation)
		{
			$this->universalLocation = $universalLocation;
		}
	}

?>