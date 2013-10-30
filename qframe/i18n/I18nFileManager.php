<?php

class Library_Qframe_I18n_I18nFileManager
{
	private $translations;
		
	public function __construct()
	{
		$this->translations = array();
			
		$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
		$request = Library_Qframe_Manage_ResourceManager::getRequestData();
		$path = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("i18n.path") . $locale . "/screen";
		
		self::setTranslationsFromFolder($path . "/common/");
		
        self::setTranslationsFromFile($path . "/" . $request->getController() . "/common.txt");
                
		self::setTranslationsFromFile($path . "/" . $request->getController() . "/" . $request->getAction() . ".txt");
	}
	
	public function setTranslationsFromFolder($path)
	{
		foreach(Library_Qframe_File_FileUtil::getFilesFromFolder($path) as $translationFile)
		{
			$this->translations = array_merge($this->translations, Library_Qframe_Parsers_TranslationsFileParser::parse($path . $translationFile)); 
		}
	}
	
	public function setTranslationsFromFile($translationFile)
	{
		$this->translations = array_merge($this->translations, Library_Qframe_Parsers_TranslationsFileParser::parse($translationFile));
	}
	
	public function getText($textId)
	{
		return $this->translations[$textId];
	}
	
	public function putText($path, $label, $value)
	{
		$handler = fopen($path, "a");
		fwrite($handler, $label . ":" . "\"" . $value . "\"\n");
		fclose($handler);
	}
	
}