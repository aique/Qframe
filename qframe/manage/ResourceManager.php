<?php

/**
 * Clase que filtra el acceso a los distintos recursos del sistema.
 * 
 * Realiza las tareas previas necesarias antes de permitir el acceso
 * a estos recursos y los almacena en el sistema si fuera necesario.
 * 
 * @author qinteractiva
 */
class Library_Qframe_Manage_ResourceManager
{
	public static function getConfig()
	{
		$config = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Resources::APP_CONFIG);
		
		if(!$config)
		{
			$config = new Library_Qframe_App_Config();
			
			Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Resources::APP_CONFIG, $config);
		}
		
		return $config;
	}
	
	public static function getUserConfig()
	{
		$config = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Resources::USER_CONFIG);
	
		if(!$config)
		{
			$config = new Library_Qframe_User_Config();
				
			Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Resources::USER_CONFIG, $config);
		}
	
		return $config;
	}
	
	public static function getI18nData()
	{
		$i18n = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Resources::I18N);
		
		if(!$i18n)
		{
			$i18n = new Library_Qframe_I18n_I18nData();
	
			Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Resources::I18N, $i18n);
		}
		
		return $i18n;
	}
	
	public static function getRequestData()
	{
		$request = Library_Qframe_Request_URLParser::parse($_SERVER['REQUEST_URI']);
		
		Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Resources::REQUEST, $request);
		
		return $request;
	}
	
	public static function getHostData()
	{	
		return new Library_Qframe_Host_Host();
	}
	
	public static function getAclData()
	{
		$acl = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Resources::ACL);
		
		if(!$acl)
		{
			$acl = new Library_Qframe_ACL_ACL();
			
			Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Resources::ACL, $acl);
		}
		
		return $acl;
	} 
	
	public static function getLogger()
	{
		$logger = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Resources::LOGGER);
	
		if(!$logger)
		{
			$logger = new Library_Qframe_Log_Logger();
	
			Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Resources::LOGGER, $logger);
		}
	
		return $logger;
	}
	
}