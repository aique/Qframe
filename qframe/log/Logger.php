<?php

/**
 * Clase que se encarga de imprimir los diferentes mensajes
 * de log en los ficheros correspondientes.
 * 
 * @package qframe
 * 
 * @subpackage log
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Log_Logger
{
	// Archivos
	private $dbTraceFile;
	private $dbErrorFile;
	private $traceFile;
	private $errorFile;
	
	// Rutas
	private $mailPath;
	
	public function __construct()
	{
		$this->dbTraceFile = PROJECT_PATH . '/data/logs/db/trace';
		$this->dbErrorFile = PROJECT_PATH . '/data/logs/db/error';
		$this->traceFile = PROJECT_PATH . '/data/logs/trace/trace';
		$this->errorFile = PROJECT_PATH . '/data/logs/error/error';
		$this->mailPath = PROJECT_PATH . '/data/mail/';
	}
	
	/**
	 * Imprime el mensaje recibido como parámetro en el 
	 * formato y fichero correspondiente a la traza de
	 * ejecución de la aplicación.
	 * 
	 * El objetivo de este log es fundamentalmente registrar
	 * el recorrido que sigue el usuario por los diferentes
	 * apartados de la aplicación.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/logs/trace.
	 * 
	 * @param string $message
	 * 
	 * 		Cadena de texto con el mensaje que se imprimirá.
	 */
	public function logTrace($message)
	{
		if(Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PRODUCTION_ENV &&
		   Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PREPRODUCTION_ENV)
		{
			$content = date('H:i:s') .' ( ' . pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) . ' ) ' . $message . "\n";
			
			$handler = fopen($this->traceFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	/**
	 * Imprime los datos de una nueva conexión abierta con
	 * la base de datos y la información de la máquina que
	 * la ha realizado.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/logs/db/trace.
	 * 
	 * @param Library_Qframe_Manage_DBManager $dbManager
	 * 
	 * 		Objeto que contiene los datos de la nueva
	 * 		conexión establecida.
	 */
	public function logDBConnection(Library_Qframe_Manage_DBManager $dbManager)
	{
		if(Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PRODUCTION_ENV &&
		   Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PREPRODUCTION_ENV)
		{
			$content = "Conexión\n--------\n\n";
			$content .= "Hora: " . date("H:i:s") . "\n";
			$content .= "Se ha producido una conexión con los datos:\n\n";
			$content .= "Servidor: " . $dbManager->getServer() . "\n";
			$content .= "Base de datos: " . $dbManager->getDbName() . "\n";
			$content .= "Usuario: " . $dbManager->getUser() . "\n\n";
			$content .= Library_Qframe_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
			
			$handler = fopen($this->dbTraceFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	/**
	 * Imprime los datos de una consulta realizada sobre
	 * la base de datos y la información de la máquina que
	 * la ha realizado.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/logs/db/trace.
	 * 
	 * @param string $query
	 * 
	 * 		Cadena de texto con la consulta realizada.
	 */
	public function logDBQuery($query)
	{
		if(Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PRODUCTION_ENV &&
		   Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PREPRODUCTION_ENV)
		{
			$content = "Consulta\n--------\n\n";
			$content .= "Hora: " . date("H:i:s\n") . "\n";
			$content .= $query . "\n\n";
			$content .= Library_Qframe_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
			
			$handler = fopen($this->dbTraceFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	/**
	 * Imprime el mensaje de error fruto de un intento
	 * de conexión erróneo sobre la base de datos, así
	 * como la información del equipo que ha intentado
	 * realizar esta conexión.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/logs/db/error.
	 * 
	 * @param string $error
	 * 
	 * 		Mensaje de error lanzado durante el proceso
	 * 		de conexión a la base de datos.
	 */
	public function logDBConnectionError($error)
	{
		if(Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PRODUCTION_ENV &&
		   Library_Qframe_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Qframe_Consts_Environment::PREPRODUCTION_ENV)
		{
			$content = "Error\n----\n\n";
			$content .= "Hora: " . date("H:i:s\n");
			$content .= "Archivo: " . pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) . "\n\n";
			$content .= "Mensaje: " . $error . "\n\n";
			$content .= Library_Qframe_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
			
			$handler = fopen($this->dbErrorFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	/**
	 * Imprime el mensaje de error fruto de una ejecución
	 * errónea de una sentencia SQL sobre la base de datos,
	 * así como la información del equipo que ha ejecutado
	 * dicha sentencia.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/logs/db/error.
	 * 
	 * @param string $query
	 * 
	 * 		Cadena de texto con la consulta SQL que ha
	 * 		provocado un error de ejecución.
	 */
	public function logDBQueryError($query)
	{
		$content = "Error\n----\n\n";
		$content .= "Hora: " . date("H:i:s\n");
		$content .= "Archivo: " . pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) . "\n\n";
		$content .= "Mensaje: Error en base de datos al ejecutar una consulta SQL.\n\n";
		$content .= "Consulta:\n" . $query . "\n\n";
		$content .= Library_Qframe_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
				
		$handler = fopen($this->dbErrorFile . '.' . date("d.m.Y"), 'a');
		fwrite($handler, $content);
		fclose($handler);
	}
	
	/**
	 * Imprime una excepción lanzada por la aplicación en
	 * su log de errores.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/logs/error.
	 * 
	 * @param Exception $exception
	 * 
	 * 		Objeto de tipo Exception con los datos del error
	 * 		producido.
	 */
	public function logError(Exception $exception)
	{
		$content = "Error\n-----\n\n";
		$content .= "Hora: " . date("H:i:s\n");
		$content .= "Fichero: " . $exception->getFile()."\n";
		$content .= "Línea: " . $exception->getLine()."\n";
		$content .= "Mensaje: " . $exception->getMessage()."\n";
		$content .= "Traza de ejecución:\n" . $exception->getTraceAsString()."\n\n";
		$content .= Library_Qframe_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
		
		$handler = fopen($this->errorFile . '.' . date("d.m.Y"), 'a');
		fwrite($handler, $content);
		fclose($handler);
	}
	
	/**
	 * Imprime el contenido de un correo enviado por la
	 * aplicación en un fichero local.
	 * 
	 * Se utiliza para comprobar que el contenido de un
	 * correo cuyo envío se está desarrollando es el
	 * correcto sin necesidad de realizar un envío real.
	 * 
	 * El fichero que contiene estos mensajes se encuentra
	 * en la ruta data/mail.
	 *
	 * @param string $html
	 * 
	 * 		Cadena de texto con el contenido del correo.
	 * 
	 * @param string $name
	 * 
	 * 		Nombre con el que se identifica el correo.
	 */
	public function logMail($html, $name)
	{
		$handler = fopen($this->mailPath . $name, 'w');
		fwrite($handler, $html);
		fclose($handler);
	}
	
}