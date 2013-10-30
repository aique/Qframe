<?php

	/**
	 * Clase que gestiona todo lo relacionado con la adaptación de la aplicación
	 * a los diferentes idiomas soportados.
	 */
	class Library_Qframe_I18n_I18nData
	{
		private $locale;
		private $supportedLocations = null;
		
		private static $instance = null;
		
		public function __construct()
		{
			$this->supportedLocations = array();
			
			array_push($this->supportedLocations, new Library_Qframe_i18n_Locale(Library_Qframe_I18n_LocaleConst::SPANISH_LOCATION,
                                                                                 Library_Qframe_I18n_LocaleConst::SPANISH_ABB_LOCATION,
                                                                                 Library_Qframe_I18n_LocaleConst::SPAIN_UNI_LOCATION));
			
			array_push($this->supportedLocations, new Library_Qframe_i18n_Locale(Library_Qframe_I18n_LocaleConst::ENGLISH_LOCATION,
                                                                                 Library_Qframe_I18n_LocaleConst::ENGLISH_ABB_LOCATION,
                                                                                 Library_Qframe_I18n_LocaleConst::ENGLAND_UNI_LOCATION));
			
			array_push($this->supportedLocations, new Library_Qframe_i18n_Locale(Library_Qframe_I18n_LocaleConst::PORTUGUISH_LOCATION,
																				 Library_Qframe_I18n_LocaleConst::PORTUGUISH_ABB_LOCATION,
																				 Library_Qframe_I18n_LocaleConst::PORTUGAL_UNI_LOCATION));
			
			$this->locale = self::recognizeLanguage();
		}
		
		public function getLocale()
		{
			return $this->locale;
		}
		
		public function setLocale($locale)
		{
			if(Library_Qframe_I18n_LocaleHelper::validateLocation($locale))
			{
				$this->locale = $locale;
			}
		}
		
		public function getSupportedLocations()
		{
			return $this->supportedLocations;
		}
		
		public function getUniversalLocale()
		{
			return Library_Qframe_I18n_LocaleHelper::getUniversalLocation($this->locale);
		}
		
		private static function recognizeLanguage(Application_Model_Country_Item $country = null)
		{
			if($country == null)
			{
				return Library_Qframe_I18n_I18nDataHelper::recognizeLanguageByBrowser();
			}
			else
			{
				return $country->getIdlanguage();				
			}
		}
	}
?>