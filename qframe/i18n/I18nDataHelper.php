<?php

class Library_Qframe_I18n_I18nDataHelper
{
	public static function recognizeLanguageByBrowser()
	{
		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			$language = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
		
			$language = strtolower($language[0]);
				
			if(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($language))
			{
				return Library_Qframe_I18n_LocaleConst::SPANISH_ABB_LOCATION;
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($language))
			{
				return Library_Qframe_I18n_LocaleConst::PORTUGUISH_ABB_LOCATION;
			}
			else
			{
				return Library_Qframe_Manage_ResourceManager::getConfig()->getVar("i18n.defaultLang");
			}
		}
		else
		{
			return Library_Qframe_Manage_ResourceManager::getConfig()->getVar("i18n.defaultLang");
		}
	}
}