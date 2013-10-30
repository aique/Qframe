<?php

/**
 * Clase auxiliar encargada de realizar las diferentes tareas de
 * encriptación llevadas a cabo por la aplicación.
 * 
 * @package qframe
 * 
 * @subpackage encrypt
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Encrypt_Encrypter
{
	const STEP_FIRST = '*ANT@ant';
	const STEP_SECOND = '@MED/med#*';
	const STEP_THIRD = 'PO/*st@*/';
	
	/**
	 * Método que devuelve el resultado del proceso de encriptación
	 * de las contraseñas asociadas a los usuarios de la aplicación.
	 * 
	 * El algoritmo de encriptación utilizado es MD5, además se
	 * aplicarán varias constantes definidas en la clase a modo de
	 * salting.
	 * 
	 * @param string $password
	 * 
	 * 		Cadena de texto que se encritará.
	 * 
	 * @return string
	 * 
	 * 		Cadena de texto resultado del proceso de encriptación
	 * 		de la contraseña.
	 * 		
	 */
	public static function passwordEncrypt($password)
	{
		$password_0 = substr($password, 0, 2);
		$password_1 = substr($password, 2);
			
		return md5(self::STEP_FIRST.$password_0.self::STEP_SECOND.$password_1.self::STEP_THIRD);
	}
}