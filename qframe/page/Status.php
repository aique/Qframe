<?php

/**
 * Clase que contiene informacion de la pagina o seccion
 * 
 * @author qinteractiva
 * 
 */
class Library_Qframe_Page_Status
{
	private $id = null;
	private $name = null;
	private $title = null;
	
	private $mysqlSearch = "id";
	private $mysqlOrder = "asc";
	
	private $numRegForPage = 100;
	private $page = 1;
	
	private $filter = array();
	private $search = array();
	
	public function reset()
	{
		$this->id = null;
		$this->name = null;
		$this->title = null;
		$this->mysqlSearch = "id";
		$this->mysqlOrder = "asc";
		$this->numRegForPage = 30;
		$this->page = 1;
		$this->filter = array();
		$this->search = array();
	}
	
	public function resetListsParameters()
	{	
		$this->mysqlSearch = "id";
		$this->mysqlOrder = "asc";
		$this->numRegForPage = 100;
		$this->page = 1;	
		$this->filter = array();
	}
	
	/*
	 * Comprueba si el nombre de la seccion que se le pasa coincide con el actual, y en caso de no hacerlo
	 * resetea los valores que se usan en los listados. Devuelve true en caso de que se haga reseteo y false 
	 * en caso contrario. Se utiliza en los casos de secciones de misma profundidad que son de tipo listado y no
	 * comparten los criterios de filtrados, paginaciones...
	 */
	public function checkResetListsParameters($name)
	{		
		if ($this->name != $name)
		{
			$this->resetListsParameters();
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	  * Devuelve el valor del atributo id.
	  *
	  * @return integer
	  */
	public function getId()
	{
	     return $this->id;
	}
	
	/**
	  * Establece el valor del atributo id.
	  *
	  * @param integer $id
	  */
	public function setId($id)
	{
	     $this->id = $id;
	}
	
	/**
	  * Devuelve el valor del atributo title.
	  *
	  * @return string
	  */
	public function getTitle()
	{
	     return $this->title;
	}
	
	/**
	  * Establece el valor del atributo title.
	  *
	  * @param string $title
	  */
	public function setTitle($title)
	{
	     $this->title = $title;
	}
	
	/**
	  * Devuelve el valor del atributo name.
	  *
	  * @return string
	  */
	public function getName()
	{
	     return $this->name;
	}
	
	/**
	  * Establece el valor del atributo name.
	  *
	  * @param string $name
	  */
	public function setName($name)
	{		
	    $this->name = $name;
	}	
	
	/**
	  * Devuelve el valor del atributo mysqlSearch.
	  *
	  * @return string
	  */
	public function getMysqlSearch()
	{
	     return $this->mysqlSearch;
	}
	
	/**
	* Establece el valor del atributo mysqlSearch.
	*
	* @param string $mysqlSearch
	*/
	public function setMysqlSearch($mysqlSearch)
	{
		$this->mysqlSearch = $mysqlSearch;
	}
	
	/**
	  * Devuelve el valor del atributo mysqlOrder.
	  *
	  * @return string
	  */
	public function getMysqlOrder()
	{
	     return $this->mysqlOrder;
	}
	
	/**
	  * Establece el valor del atributo mysqlOrder.
	  *
	  * @param string $mysqlOrder
	  */
	public function setMysqlOrder($mysqlOrder)
	{
	     $this->mysqlOrder = $mysqlOrder;
	}
	
	/**
	  * Devuelve el valor del atributo numRegForPage.
	  *
	  * @return integer
	  */
	public function getNumRegForPage()
	{
	     return $this->numRegForPage;
	}
	
	/**
	  * Establece el valor del atributo numRegForPage.
	  *
	  * @param integer $numRegForPage
	  */
	public function setNumRegForPage($numRegForPage)
	{
	     $this->numRegForPage = $numRegForPage;
	}
	
	/**
	  * Devuelve el valor del atributo page.
	  *
	  * @return integer
	  */
	public function getPage()
	{
	     return $this->page;
	}
	
	/**
	  * Establece el valor del atributo page.
	  *
	  * @param integer $page
	  */
	public function setPage($page)
	{
	     $this->page = $page;
	}
	
	/**
	  * Devuelve el valor del atributo filter.
	  *
	  * @return array
	  */
	public function getFilter()
	{
	     return $this->filter;
	}
	
	public function getFilterById($id)
	{
		foreach($this->getFilter() as $filter)
		{
			if($filter["id"] == $id)
			{
				return $filter;
			}
		}
		
		return null;
	}
	
	/**
	  * Establece el valor del atributo filter.
	  *
	  * @param array $filter
	  */
	public function setFilter($filter)
	{
	     $this->filter = $filter;
	}
	
	/**
	  * Devuelve el valor del atributo search.
	  *
	  * @return array
	  */
	public function getSearch()
	{
	     return $this->search;
	}
	
	/**
	  * Establece el valor del atributo search.
	  *
	  * @param array $search
	  */
	public function setSearch($search)
	{
	     $this->search = $search;
	}
	
	public static function getVar($name)
	{
		$aux = "this->".$name;
		return $$aux;
	}
	
	public static function setVar($name, $value)
	{
		$aux = "this->".$name;
		$$aux = $value;
	}
}