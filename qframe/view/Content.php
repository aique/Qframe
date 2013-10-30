<?php

class Library_Qframe_View_Content
{
	private $htmlContent;
	private $jsonContent;
	
	public function __construct()
	{
		$htmlContent = array();
		$jsonContent = array();
	}
	
	/**
	 * Devuelve el valor almacenado en el array de contenidos
	 * HTML en función de la etiqueta que lo identifica.
	 * 
	 * @param string $key
	 * 
	 * 		Cadena de texto con la etiqueta a la que está
	 * 		asociado el valor que se desea rescatar.
	 *
	 * @return unknown_type
	 * 
	 * 		Variable u objeto asociado a la etiqueta recibida
	 * 		como parámetro. Devolverá null en caso de no
	 * 		encontrarse ningún valor asociado a la etiqueta
	 * 		recibida.
	 */
	public function getHtmlContent($key)
	{
	    $value = null;
		
		if($key)
		{
			if(isset($this->htmlContent[$key]))
			{
				$value = $this->htmlContent[$key];
			}
		}
		
	    return $value;
	}
	
	/**
	 * Añade cualquier tipo de contenido al array de valores
	 * HTML junto con una etiqueta identificativa.
	 *
	 * Al llamar a este método lo que se busca es almacenar
	 * en el array de contenidos de la vista variables u
	 * objetos que se mostrarán por pantalla desde un
	 * contexto HTML.
	 *
	 * @param string $key
	 *
	 * 		Cadena de texto que identificará al contenido
	 * 		almacenado.
	 *
	 * @param unknown_type $value
	 *
	 * 		Variable u objeto que se desea almacenar.
	 */
	public function addHtmlContent($key, $value)
	{
		$this->htmlContent[$key] = $value;
	}
	
	/**
	 * Devuelve el array de contenidos JSON.
	 *
	 * @return array
	 *
	 * 		Array que contiene los variable u objetos que se han
	 * 		almacenado desde el action con vista a ser retornados
	 * 		en un contexto JSON.
	 */
	public function getJsonContent()
	{
	    return $this->jsonContent;
	}
	
	/**
	 * Añade cualquier tipo de contenido al array de valores
	 * JSON junto con una etiqueta identificativa.
	 *
	 * Al llamar a este método lo que se busca es almacenar
	 * en el array de contenidos de la vista variables u
	 * objetos que se mostrarán por pantalla desde un
	 * contexto JSON.
	 *
	 * @param string $key
	 *
	 * 		Cadena de texto que identificará al contenido
	 * 		almacenado.
	 *
	 * @param unknown_type $value
	 *
	 * 		Variable u objeto que se desea almacenar.
	 */
	public function addJsonContent($key, $value)
	{
		$this->jsonContent[$key] = $value;
	}
}