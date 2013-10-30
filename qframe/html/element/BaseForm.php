<?php

/**
 * Formulario base del que heredarán todos los formularios utilizados
 * en la aplicación.
 * 
 * Contiene los atributos y el comportamiento común a todos ellos.
 * 
 * @package qframe
 * 
 * @subpackage html
 * 
 * @author qinteractiva
 *
 */
abstract class Library_Qframe_Html_Element_BaseForm extends Library_Qframe_Html_Element_FormElement
{
	protected $elements;
	protected $actions;
	protected $legend;
	
	protected $validator;
	
	const DEFAULT_ACTION = "#";
	const DEFAULT_METHOD = "POST";
	const DEFAULT_ENCTYPE = "application/x-www-form-urlencoded";
	
	public function __construct(array $attributes = array("action" => self::DEFAULT_ACTION,
														  "method" => self::DEFAULT_METHOD,
														  "enctype" => self::DEFAULT_ENCTYPE),
								array $validations = array(),
								$template = null)
	{
		$this->elements = array();
		$this->actions = array();
		$this->legend = null;
		$this->error = null;
		
		parent::__construct(Library_Qframe_Html_Const_FormElementConst::FORM, $attributes, $validations, $template, new Library_Qframe_Html_Printer_FormPrinter());

		$this->printer->setElement($this);
		
		$this->printer->setTemplate(Library_Qframe_Html_Printer_PrinterClient::getDefaultTemplate($this));
		
		$this->validator = new Library_Qframe_Html_Validation_FormElementValidator($this);
		
		$this->init();
	}
	
	/**
	 * Devuelve el valor del atributo action.
	 *
	 * @return string
	 */
	public function getAction()
	{
	    return $this->attributes["action"];
	}
	 
	/**
	 * Establece el valor del atributo action.
	 *
	 * @param string $action
	 */
	public function setAction($action)
	{
	    $this->attributes["action"] = $action;
	}
	
	/**
	 * Devuelve el valor del atributo method.
	 *
	 * @return string
	 */
	public function getMethod()
	{
	    return $this->attributes["method"];
	}
	 
	/**
	 * Establece el valor del atributo method.
	 *
	 * @param string $method
	 */
	public function setMethod($method)
	{
	    $this->attributes["method"] = $method;
	}
	
	/**
	 * Devuelve el valor del atributo enctype.
	 *
	 * @return string
	 */
	public function getEnctype()
	{
	    return $this->attributes["enctype"];
	}
	 
	/**
	 * Establece el valor del atributo enctype.
	 *
	 * @param string $enctype
	 */
	public function setEnctype($enctype)
	{
	    $this->attributes["enctype"] = $enctype;
	}
	
	/**
	 * Devuelve el valor del atributo elements.
	 *
	 * @return array
	 */
	public function getElements()
	{
	    return $this->elements;
	}
	 
	/**
	 * Establece el valor del atributo elements.
	 *
	 * @param array $elements
	 */
	public function setElements($elements)
	{
	    $this->elements = $elements;
	}
	
	/**
	 * Añade un nuevo elemento al formulario.
	 * 
	 * @param Library_Qframe_Html_Element_FormElement $element
	 * 
	 * @param int position
	 * 
	 * 		Especifica la posición en la que se quiere insertar el elemento,
	 * 		de manera que al imprimir el formulario éste se muestre en el
	 * 		lugar deseado. Por defecto toma el valor cero y añade el elemento
	 * 		a continuación del último.
	 */
	public function addElement(Library_Qframe_Html_Element_BaseElement $element, $position = 0)
	{
		if(isset($element))
		{
			if($position)
			{
				$i = count($this->elements);
				
				$this->elements[] = $this->elements[$i - 1];
				
				for( ; $i > $position + 1 ; $i--)
				{
					$this->elements[$i - 1] = $this->elements[$i - 2];
				}
				
				$this->elements[$position] = $element;
			}
			else
			{
				$this->elements[] = $element;
			}
		}
	}
	
	/**
	 * Devuelve el valor del atributo actions.
	 *
	 * @return array
	 */
	public function getActions()
	{
	    return $this->actions;
	}
	 
	/**
	 * Establece el valor del atributo actions.
	 *
	 * @param array $actions
	 */
	public function setActions($actions)
	{
	    $this->actions = $actions;
	}
	
	/**
	 * Añade una nueva acción o operación al formulario.
	 * 
	 * @param Library_Qframe_Html_Element_Input $action
	 */
	public function addAction(Library_Qframe_Html_Element_Input $action)
	{
		$this->actions[] = $action;
	}
	
	/**
	 * Devuelve el valor del atributo legend.
	 *
	 * @return string
	 */
	public function getLegend()
	{
	    return $this->legend;
	}
	 
	/**
	 * Establece el valor del atributo legend.
	 *
	 * @param string $legend
	 */
	public function setLegend($legend)
	{
	    $this->legend = $legend;
	}
	
	public abstract function init();
	
	/**
	 * Devuelve uno de los elementos que componen el formulario cuyo
	 * atributo name coincide con el valor recibido como parámetro.
	 * 
	 * @param string $nameValue
	 * 
	 * 		Valor del atributo name del elemento que se va a obtener.
	 * 
	 * @return Library_Qframe_Html_Form_FormElement
	 * 
	 * 		Objeto de tipo Library_Qframe_Html_Form_FormElement para el caso en
	 * 		el que el valor del atributo name de alguno de los elementos
	 * 		del formulario coincida con el recibido como parámetro.
	 * 
	 * 		Devolverá null en caso contrario.
	 */
	public function getElementByNameAttribute($nameValue)
	{
		foreach($this->elements as $element)
		{
                        if(get_parent_class($element) == 'Library_Qframe_Html_Element_FormElement')
			{
                            if($element->getAttribute('name') == $nameValue)
                            {
                                    return $element;
                            }
                        }
                        else
                        {
                            if(get_class($element) == 'Library_Qframe_Html_Element_Div')
                            {
                                if(count($element->getElements()) > 0)
				{
                                    foreach($element->getElements() as $element)
                                    {
                                        if($element->getAttribute('name') == $nameValue)
                                        {
                                                return $element;
                                        }
                                    }
                                }
                            }
                        }
		}
		
		return null;
	}
        
        /**
	 * Devuelve uno de los elementos que componen el formulario cuyo
	 * atributo id coincide con el valor recibido como parámetro.
	 * 
	 * @param string $id
	 * 
	 * 		Valor del atributo id del elemento que se va a obtener.
	 * 
	 * @return Library_Qframe_Html_Form_FormElement
	 * 
	 * 		Objeto de tipo Library_Qframe_Html_Form_FormElement para el caso en
	 * 		el que el valor del atributo name de alguno de los elementos
	 * 		del formulario coincida con el recibido como parámetro.
	 * 
	 * 		Devolverá null en caso contrario.
	 */
	public function getElementById($id)
	{
		foreach($this->elements as $element)
		{
                        if(get_parent_class($element) == 'Library_Qframe_Html_Element_FormElement')
			{
                            if(get_class($element) == 'Library_Qframe_Html_Element_RadioGroup')
                            {
                                if(count($element->getRadios()) > 0)
                                {
                                    foreach($element->getRadios() as $element)
                                    {
                                        if($element->getAttribute('id') == $id)
                                        {
                                            return $element;
                                        }
                                    }
                                }
                            }
                            else
                            {
                                if($element->getAttribute('id') == $id)
                                {
                                        return $element;
                                }
                            }
                        }
                        else
                        {
                            if(get_class($element) == 'Library_Qframe_Html_Element_Div')
                            {
                                if(count($element->getElements()) > 0)
				{
                                    foreach($element->getElements() as $element)
                                    {
                                        if($element->getAttribute('id') == $id)
                                        {
                                                return $element;
                                        }
                                    }
                                }
                            }
                        }
		}
		
		return null;
	}
	
	/**
	 * Comprueba que los valores establecidos en cada uno de
	 * los campos del formulario son correctos.
	 * 
	 * @param array $elements
	 * 
	 * 		Parámetro opcional que si está cubierto, aplica
	 * 		la validación sobre estos elementos en lugar de
	 * 		hacerlo sobre los pertenecientes al formulario.
	 * 
	 * 		Este parámetro permite hacer llamadas recursivas,
	 * 		con el objetivo de validar los elementos que se
	 * 		encuentran en otros elementos contenedores, por
	 * 		ejemplo los DIV, cuya profundidad se desconoce.
	 * 
	 * @return boolean
	 * 
	 * 		Devuelve true en caso de que los campos del formulario
	 * 		sean correctos y false en caso contrario.
	 */
	public function isValid(array $elements = null)
	{
		if(!$elements)
		{
			$elements = $this->elements;
		}
		
		foreach($elements as $element)
		{
			if(get_parent_class($element) == 'Library_Qframe_Html_Element_FormElement')
			{
				if(!$this->validator->validateElement($element))
				{				
					$this->setError(Library_Qframe_I18n_I18n::getText('screen_common_error_validation'));
					
					return false;
				}
			}
			else
			{
				if(get_class($element) == 'Library_Qframe_Html_Element_Div')
				{
					if(count($element->getElements()) > 0)
					{
						if(!$this->isValid($element->getElements()))
						{
							return false;
						}
					}
				}
			}
		}
		
		return true;
	}
	
	/**
	 * Establece los valores de los campos del formulario en función
	 * de los encontrados en el array que recibe como parámetro.
	 * 
	 * El array recibido será un array asociativo. Este método
	 * comprobará sus claves y si alguna coincide con el valor del
	 * atributo name de alguno de los elementos del formulario,
	 * establecerá su valor al asociado a la mencionada clave dentro
	 * del array.
	 * 
	 * @param array $params
	 */
	public function setParams(array $params, array $elements = null)
	{
		if(!$elements)
		{
			$elements = $this->elements;
		}
			
		foreach($elements as $element)
		{
			if(get_parent_class($element) == 'Library_Qframe_Html_Element_FormElement')
			{
				foreach($params as $paramName => $paramValue)
				{
					if($paramName == $element->getAttribute("name"))
					{
						$element->setValue($paramValue);
						
						break;
					}
				}
			}
			else
			{
				if(get_class($element) == 'Library_Qframe_Html_Element_Div')
				{
					if(count($element->getElements()) > 0)
					{
						$this->setParams($params, $element->getElements());
					}
				}
			}
		}
	}
	
	/**
	 * Establece el valor de un campo del formulario por el recibido
	 * como parámetro.
	 * 
	 * El primer parámetro del método determina el valor del atributo
	 * name perteneciente al elemento que se modificará, mientras que
	 * el segundo será el valor que tomará su atributo value.
	 *
	 * @param string $nameAttribute
	 * 
	 * 		Cadena de texto con el valor que ha de tener el atributo
	 * 		name del elemento a modificar.
	 * 
	 * @param string $value
	 * 
	 * 		Cadena de texto con el valor que tomará el atributo value.
	 */
	public function setParam($nameAttribute, $value)
	{
		$paramFounded = false;
		
		for($i = 0 ; $i < count($this->elements) && !$paramFounded ; $i++)
		{
			if(get_class($this->elements[$i]) == "Library_Qframe_Html_Element_Div")
			{
				$paramFounded = $this->elements[$i]->setParam($nameAttribute, $value);
			}
			else
			{
				if($nameAttribute == $this->elements[$i]->getAttribute("name"))
				{
					$this->elements[$i]->setValue($value);
					
					$paramFounded = true;
				}
			}
		}
	}
	
	/**
	 * Establece el valor de un campo del formulario por el recibido
	 * como parámetro.
	 *
	 * El primer parámetro del método determina el valor del atributo
	 * id perteneciente al elemento que se modificará, mientras que
	 * el segundo será el valor que tomará su atributo value.
	 *
	 * @param string $nameAttribute
	 *
	 * 		Cadena de texto con el valor que ha de tener el atributo
	 * 		id del elemento a modificar.
	 *
	 * @param string $value
	 *
	 * 		Cadena de texto con el valor que tomará el atributo value.
	 */
	public function setParamById($idAttribute, $value)
	{
		$paramFounded = false;
	
		for($i = 0 ; $i < count($this->elements) && !$paramFounded ; $i++)
		{
			if(get_class($this->elements[$i]) == "Library_Qframe_Html_Element_Div")
			{
				$paramFounded = $this->elements[$i]->setParamById($idAttribute, $value);
			}
			else
			{
				if($idAttribute == $this->elements[$i]->getAttribute("id"))
				{
					$this->elements[$i]->setValue($value);
			
					$paramFounded = true;
				}
			}
		}
	}
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
	
}