<?php

/**
 * Clase que realiza las tareas de inicialización necesarias.
 * 
 * @package qframe
 * 
 * @subpackage app
 * 
 * @author qinteractiva
 * 
 */
class Library_Qframe_App_Loader
{
	/**
	 * Realiza las tareas de inicialización imprescindibles para el correcto
	 * funcionamiento de la aplicación.
	 * 
	 * Entre otras tareas se encuentran las siguientes:
 	 * 
 	 * <ul>
 	 * <li>Inicializar la sesión.</li>
 	 * </ul>
	 */
	public static function load()
	{
    	session_start();
	}
}