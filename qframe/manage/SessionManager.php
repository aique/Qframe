<?php

/**
 * Clase que gestiona el acceso a las variables de sesión.
 * 
 * @author qinteractiva
 * 
 */
class Library_Qframe_Manage_SessionManager
{
	private static $sessionManager = null;
	
	public static function getVar($name, $value = null)
	{
		if(isset($_SESSION[$name]))
		{
			return $_SESSION[$name];
		}
		else
		{
			if($value != null)
			{
				self::setVar($name, $value);
				return $_SESSION[$name];
			}
		}
		
		return null;
	}
	
	public static function setVar($name, $value)
	{
		$_SESSION[$name] = $value;
	}
}