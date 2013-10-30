<?php

/**
 * Clase de la que heredarán todos los elementos HTML soportados.
 * 
 * Contiene los atributos y el comportamiento común para todos estos elementos.
 * 
 * @package qframe
 * 
 * @subpackage html
 * 
 * @author qinteractiva
 *
 */
abstract class Library_Qframe_Html_Element_BaseElement
{

    protected $name;
    protected $attributes;
    protected $printer;

    public function __construct($name, $attributes = array(), Library_Qframe_Html_Printer_ElementBasePrinter $printer = null)
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->printer = $printer;

        $this->printer->setElement($this);
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
     * Devuelve el valor del atributo attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Establece el valor del atributo attributes.
     *
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Añade un atributo a la lista de los asociados al elemento.
     * 
     * @param string $attribute
     * 
     * 		Nombre del atributo que se añadirá.
     * 
     * @param string $value
     * 
     * 		Valor del atributo que se añadirá.
     */
    public function addAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    /**
     * Devuelve el valor de un atributo asociado a este elemento en
     * función de su nombre.
     * 
     * @param string $name
     * 
     * 		Nombre del atributo del cual se va a devolver su valor
     * 
     * @return string
     * 
     * 		Cadena de texto con el valor del atributo cuyo nombre
     * 		coincide con el recibido como parámetro o null en caso
     * 		de que no se encuentre.
     */
    public function getAttribute($name)
    {
        foreach($this->attributes as $attributeName => $attributeValue)
        {
            if($attributeName == $name)
            {
                return $attributeValue;
            }
        }

        return null;
    }

    /**
     * Establece el valor de un atributo asociado a este elemento en
     * función de su nombre.
     *
     * @param string $name
     *
     * 		Nombre del atributo del cual se va a devolver su valor.
     * 
     * @param unknown_type $value
     * 
     * 		Valor que se le asignará al atributo cuyo nombre coincida
     * 		con el primer parámetro.
     */
    public function setAttribute($name, $value)
    {
        foreach($this->attributes as $attributeName => $attributeValue)
        {
            if($attributeName == $name)
            {
                $this->attributes[$attributeName] = $value;
            }
        }
    }

    /**
     * Devuelve el valor del atributo value.
     * 
     * Es comúnmente utilizado para conocer el valor que el usuario
     * ha introducido en un campo. Sin embargo, no todos los elementos
     * HTML funcionan de esta manera.
     * 
     * Por ejemplo, un checkbox tendrá valor 1 si está marcado
     * y 0 si no lo está. Cada elemento específico por tanto deberá
     * sobreescribir este método para devolver su valor de la manera
     * oportuna.
     * 
     * @return string
     * 
     * 		Cadena de texto con el valor del atributo value. Si no se
     * 		ha establecido todavía, devolverá una cadena vacía.
     */
    public function getValue()
    {
        if(isset($this->attributes["value"]))
        {
            return $this->attributes["value"];
        }
        else
        {
            return "";
        }
    }

    /**
     * Establece el valor del atributo value.
     * 
     * @param string $value
     */
    public function setValue($value)
    {
        $this->attributes["value"] = $value;
    }

    /**
     * Devuelve el valor del atributo display.
     * 
     * Es comúnmente utilizado para mostrar un valor en pantalla
     * que el elemento ha de establecer entre sus etiquetas de
     * apertura y cierre.
     * 
     * @return string
     * 
     * 		Cadena de texto con el valor del atributo display.
     * 		Si no se ha establecido todavía, devolverá una cadena
     * 		vacía.
     */
    public function getDisplay()
    {
        if(isset($this->attributes["display"]))
        {
            return $this->attributes["display"];
        }
        else
        {
            return "";
        }
    }

    /**
     * Establece el valor del atributo display.
     * 
     * @param string $display
     */
    public function setDisplay($display)
    {
        $this->attributes["display"] = $display;
    }

    /**
     * Devuelve el valor del atributo printer.
     *
     * @return Library_Qframe_Form_Printer_BaseDefaultPrinter
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * Establece el valor del atributo printer.
     *
     * @param Library_Qframe_Form_Printer_DefaultInputPrinter $printer
     */
    public function setPrinter($printer)
    {
        $this->printer = $printer;
    }

    /**
     * Deriva la salida estándar de los elementos HTML soportados
     * a la salida estandar de la impresora establecida entre sus
     * atributos.
     * 
     * Esta salida estará determinada por el método standardPrint()
     * de la misma.
     * 
     * @return string
     * 
     * 		Cadena de texto con la representación estándar del
     * 		elemento en pantalla.
     */
    public function __toString()
    {
        return $this->printer->standardPrint();
    }

}