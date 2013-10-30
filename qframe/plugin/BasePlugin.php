<?php

/**
 * Clase base de la que heredarán todos los plugins utilizados en la
 * aplicación.
 * 
 * Un plugin es un fragmento de código que se ejecuta en un momento
 * determinado dentro del ciclo de atención de una petición. Este
 * momento viene determinado por el método de la clase padre (esta
 * misma clase) en el que se ubique.
 * 
 * Es importante asociar el plugin al controlador que servirá la
 * petición en su método init().
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Plugin_BasePlugin
{
	/**
	 * Ejecuta el fragmento de código contenido en este método antes
	 * de que la petición sea atendida por el controlador correspondiente.
	 * 
	 * Los plugins que deseen ejecutar un fragmento de código en ese
	 * preciso instante deberán sobreescribir este método con el código
	 * correspondiente.
	 * 
	 * @param Library_Qframe_Request_Request $request
	 * 
	 * 		Objeto de tipo Library_Qframe_Request_Request con la información
	 * 		sobre la petición que está siendo atendida.
	 * 
	 * 		Alterando su valor, al finalizar la ejecución de este método
	 * 		finalizará el ciclo de atención de la petición y se realizará
	 * 		una nueva con los datos modificados.
	 */
	public function preDispatch(Library_Qframe_Request_Request $request)
	{
		
	}
	
	/**
	 * Ejecuta el fragmento de código contenido en este método después
	 * de que la petición sea atendida por el controlador correspondiente.
	 *
	 * Los plugins que deseen ejecutar un fragmento de código en ese
	 * preciso instante deberán sobreescribir este método con el código
	 * correspondiente.
	 *
	 * @param Library_Qframe_Request_Request $request
	 *
	 * 		Objeto de tipo Library_Qframe_Request_Request con la información
	 * 		sobre la petición que está siendo atendida.
	 *
	 * 		Alterando su valor, al finalizar la ejecución de este método
	 * 		finalizará el ciclo de atención de la petición y se realizará
	 * 		una nueva con los datos modificados.
	 */
	public function postDispatch(Library_Qframe_Request_Request $request)
	{
		
	}
}