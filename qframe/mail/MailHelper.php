<?php

class Library_Qframe_Mail_MailHelper
{
	public static function createPHPMailerObject($users)
	{
		$phpMailer = new Library_Qframe_Mail_PHPMailer();
		
		$phpMailer->IsHTML(true);
		$phpMailer->CharSet = "UTF-8";
		
		$phpMailer->WordWrap = 50;
		
		//$phpMailer->IsSMTP();
		$phpMailer->Host = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->Port = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->SMTPAuth = true;
		
		// Para tareas de internacionalización
		
		$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
			
		$phpMailer->From = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("contact.email"); // TODO introducir valor como atributos en el fichero config
		$phpMailer->FromName = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("app.client.name"); // TODO introducir valor como atributos en el fichero config
	
		$phpMailer->Username = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->Password = ""; // TODO introducir valor como atributos en el fichero config
			
		$phpMailer->AddAddress($users[0]);
			
		for ($i = 1 ; $i < count($users) ; $i++)
		{
			$phpMailer->AddBCC($users[$i]);
		}
			
		return $phpMailer;
	}
}