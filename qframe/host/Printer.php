<?php

/**
 * Define la salida de la clase Library_Qframe_Host_Host
 * en todas sus variantes.
 * 
 * @package qframe
 * 
 * @subpackage host
 *  
 * @author qinteractiva
 *
 */
class Library_Qframe_Host_Printer extends Library_Qframe_Printer_BasePrinter
{
	public function standardPrint()
	{
		
	}
	
	/**
	 * Devuelve una cadena de texto con los datos del host
	 * en formato de log.
	 * 
	 * Este método es utilizado para imprimir en el log de
	 * accesos los detalles de cada uno de los equipos físicos
	 * que está accediendo a la aplicación.
	 * 
	 * @return string
	 * 
	 * 		Cadena de texto con la representación de los datos
	 * 		de un host en formato de log.
	 */
	public function logPrint()
	{
		$output = '';
		
		$output .= "Los datos del host son los siguientes:\n\n";
		$output .= "IP: " . $this->element->getIp() . "\n";
		$output .= "Host: " . $this->element->getHost() . "\n";
		$output .= "Proxy: " . $this->element->getProxy() . "\n\n";
		
		return $output;
		
	}
}