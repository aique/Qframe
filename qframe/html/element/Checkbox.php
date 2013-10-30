<?php

/**
 * Representa un elemento de tipo checkbox.
 * 
 * @package qframe
 * 
 * @subpackage html
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Html_Element_Checkbox extends Library_Qframe_Html_Element_FormElement
{

    public function __construct(array $attributes = array(), array $validations = array(), $template = null)
    {
        parent::__construct(Library_Qframe_Html_Const_FormElementConst::INPUT, $attributes, $validations, $template, new Library_Qframe_Html_Printer_CheckboxPrinter());
    }

    public function getValue()
    {
        if($this->getAttribute('checked'))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function setValue($value)
    {
        if($value != 0)
        {
            $this->addAttribute('checked', 'checked');
        }
    }

}