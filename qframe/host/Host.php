<?php

/**
 * Clase que obtiene y almacena la información relacionada con la
 * máquina física que está accediendo a la aplicación.
 * 
 * @package qframe
 * 
 * @subpackage host
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Host_Host
{
	private $ip;
	private $proxy;
	private $host;
	
	private $printer;
	
	public function __construct()
	{
		$this->ip = '';
		$this->proxy = '';
		$this->host = '';
		
		$this->getHostData();
		
		$this->printer = new Library_Qframe_Host_Printer();
		$this->printer->setElement($this);
	}
	
	/**
	 * Devuelve el valor del atributo ip.
	 *
	 * @return string
	 */
	public function getIp()
	{
	    return $this->ip;
	}
	 
	/**
	 * Establece el valor del atributo ip.
	 *
	 * @param string $ip
	 */
	public function setIp($ip)
	{
	    $this->ip = $ip;
	}
	
	/**
	 * Devuelve el valor del atributo proxy.
	 *
	 * @return string
	 */
	public function getProxy()
	{
	    return $this->proxy;
	}
	 
	/**
	 * Establece el valor del atributo proxy.
	 *
	 * @param string $proxy
	 */
	public function setProxy($proxy)
	{
	    $this->proxy = $proxy;
	}
	
	/**
	 * Devuelve el valor del atributo host.
	 *
	 * @return string
	 */
	public function getHost()
	{
	    return $this->host;
	}
	 
	/**
	 * Establece el valor del atributo host.
	 *
	 * @param string $host
	 */
	public function setHost($host)
	{
	    $this->host = $host;
	}
	
	/**
	 * Devuelve el valor del atributo printer.
	 *
	 * @return Library_Qframe_Host_Printer
	 */
	public function getPrinter()
	{
	    return $this->printer;
	}
	 
	/**
	 * Establece el valor del atributo printer.
	 *
	 * @param Library_Qframe_Host_Printer $printer
	 */
	public function setPrinter($printer)
	{
	    $this->printer = $printer;
	}
	
	/**
	 * Método privado llamado desde el contructor que establece
	 * los valores de la clase.
	 * 
	 * Estos valores rescatados hacen referencia a la IP, el HOST
	 * y el PROXY del cliente físico que está accediendo a la
	 * aplicación.
	 */
	private function getHostData()
	{
		// acceso por proxy
		if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
		{
			if(isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			{
				$this->ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
				$this->host = $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			
			if(isset($_SERVER["REMOTE_ADDR"]))
			{
				$this->proxy = $_SERVER["REMOTE_ADDR"];
			}
		}
		// acceso normal
		else
		{
			if(isset($_SERVER["REMOTE_ADDR"]))
			{
				$this->ip = $_SERVER["REMOTE_ADDR"];
				$this->host = $_SERVER["REMOTE_ADDR"];
			}
			
			$this->proxy = '';
		}
	}
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
}