<?php

/**
 * Contiene los atributos y métodos base comunes a todos
 * los objetos que encapsulan la representación visual de
 * un determinado elemento, de la cual heredarán de manera
 * directa o indirecta.
 * 
 * @package qframe
 * 
 * @subpackage printer
 * 
 * @author qinteractiva
 *
 */
abstract class Library_Qframe_Printer_BasePrinter
{
	/**
	 * Elemento del que se recuperará la representación visual.
	 * 
	 * @var unknown_type
	 */
	protected $element;
	
	/**
	 * Devuelve el valor del atributo element.
	 *
	 * @return unknown_type
	 */
	public function getElement()
	{
	    return $this->element;
	}
	 
	/**
	 * Establece el valor del atributo element.
	 *
	 * @param unknown_type $element
	 */
	public function setElement($element)
	{
	    $this->element = $element;
	}
	
	/**
	 * Representación visual por defecto del elemento.
	 */
	public abstract function standardPrint();
}