<?php

/**
 * Contiene los métodos comunes a los objetos que encapsulan
 * la representación visual de un determinado Item.
 * 
 * Además de los establecidos por defecto para todos estos
 * objetos en la clase Library_Qframe_Printer_BasePrinter,
 * se suman también los necesarios para ser mostrados por
 * un paginador.
 * 
 * @package qframe
 * 
 * @subpackage model
 * 
 * @author qinteractiva
 *
 */
abstract class Library_Qframe_Model_ItemPrinter extends Library_Qframe_Printer_BasePrinter
{
	/**
	 * Representación visual del Item dentro del paginador.
	 */
	public abstract function paginationPrint();
	
	/**
	 * Conjunto de atributos del Item que se mostrarán en
	 * el contexto JSON.
	 */
	public abstract function JSONPrint();
}