<?php

class Library_Qframe_I18n_Money_Money
{
	private $integerPart;
	private $decimalPart;
	
	public function __construct($integerPart, $decimalPart)
	{
		$this->integerPart = $integerPart;
		$this->decimalPart = $decimalPart;
	}
	
	/**
	 * Devuelve el valor del atributo integerPart.
	 *
	 * @return int
	 */
	public function getIntegerPart()
	{
	    return $this->integerPart;
	}
	 
	/**
	 * Establece el valor del atributo integerPart.
	 *
	 * @param int $integerPart
	 */
	public function setIntegerPart($integerPart)
	{
	    $this->integerPart = $integerPart;
	}
	
	/**
	 * Devuelve el valor del atributo decimalPart.
	 *
	 * @return int
	 */
	public function getDecimalPart()
	{
	    return $this->decimalPart;
	}
	 
	/**
	 * Establece el valor del atributo decimalPart.
	 *
	 * @param int $decimalPart
	 */
	public function setDecimalPart($decimalPart)
	{
	    $this->decimalPart = $decimalPart;
	}
	
	
}