<?php

class Library_Qframe_Paginator_Helper_PaginatorHelper
{
	private $leftPages;
	private $leftArrowPage;
	private $rightPages;
	private $rightArrowPage;
	private $currentPage;
	
	public function __construct()
	{
		$this->leftPages = array();
		$this->rightPages = array();
	}
	
	/**
	 * Devuelve el valor del atributo leftPages.
	 *
	 * @return array
	 */
	public function getLeftPages()
	{
	    return $this->leftPages;
	}
	 
	/**
	 * Establece el valor del atributo leftPages.
	 *
	 * @param array $leftPages
	 */
	public function setLeftPages($leftPages)
	{
	    $this->leftPages = $leftPages;
	}
	
	public function addLeftPage($leftPage)
	{
		$this->leftPages[] = $leftPage;
	}
	
	/**
	 * Devuelve el valor del atributo leftArrowPage.
	 *
	 * @return int
	 */
	public function getLeftArrowPage()
	{
	    return $this->leftArrowPage;
	}
	 
	/**
	 * Establece el valor del atributo leftArrowPage.
	 *
	 * @param int $leftArrowPage
	 */
	public function setLeftArrowPage($leftArrowPage)
	{
	    $this->leftArrowPage = $leftArrowPage;
	}
	
	/**
	 * Devuelve el valor del atributo rightPages.
	 *
	 * @return array
	 */
	public function getRightPages()
	{
	    return $this->rightPages;
	}
	 
	/**
	 * Establece el valor del atributo rightPages.
	 *
	 * @param array $rightPages
	 */
	public function setRightPages($rightPages)
	{
	    $this->rightPages = $rightPages;
	}
	
	public function addRightPage($rightPage)
	{
		$this->rightPages[] = $rightPage;
	}
	
	/**
	 * Devuelve el valor del atributo rightArrowPage.
	 *
	 * @return int
	 */
	public function getRightArrowPage()
	{
	    return $this->rightArrowPage;
	}
	 
	/**
	 * Establece el valor del atributo rightArrowPage.
	 *
	 * @param int $rightArrowPage
	 */
	public function setRightArrowPage($rightArrowPage)
	{
	    $this->rightArrowPage = $rightArrowPage;
	}
	
	/**
	 * Devuelve el valor del atributo currentPage.
	 *
	 * @return int
	 */
	public function getCurrentPage()
	{
	    return $this->currentPage;
	}
	 
	/**
	 * Establece el valor del atributo currentPage.
	 *
	 * @param int $currentPage
	 */
	public function setCurrentPage($currentPage)
	{
	    $this->currentPage = $currentPage;
	}
}