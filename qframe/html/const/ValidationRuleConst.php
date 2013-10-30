<?php

/**
 * Constantes relacionadas con la validación de formularios HTML.
 * 
 * @package qframe
 * 
 * @subpackage html
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Html_Const_ValidationRuleConst
{
	// Constantes para la validación de campo requerido
	const REQUIRED = "required";
	
	// Constantes para la validación de formato
	const FORMAT = "format";
	
	// Posibles formatos soportados
	const ALPHABETICAL_FORMAT = "alphabetical";
	const ALPHABETICAL_FORMAT_WITH_SPACES = "alphabetical&spaces";
	const ALPHANUMERIC_FORMAT = "alphanumeric";
	const ALPHANUMERIC_FORMAT_WITH_SPACES = "alphanumeric&spaces";
	
	const NUMERIC_FORMAT = "numeric";
	const NUMERIC_SIGNED_FORMAT = "numeric_signed";
	
	const DECIMAL_FORMAT = "decimal";
	const DECIMAL_SIGNED_FORMAT = "decimal_signed";
	
	const EMAIL = "email";
        
        const URL = "web";
	
	const DATE = "date";
	
	// Constantes para la validación del contenido
	const FIELD_VALUE = "field_value";
	
	// Constantes para la validación con expresiones regulares
	const REGEX = "regex";
}