<?php

class Library_Qframe_Html_Printer_PrinterClient
{
	public static function getDefaultTemplate(Library_Qframe_Html_Element_FormElement $element)
	{
		$template = null;
		
		switch($element->getName())
		{
			case(Library_Qframe_Html_Const_FormElementConst::FORM):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/form.php';
				break;
			
			case(Library_Qframe_Html_Const_FormElementConst::INPUT):
				$template = self::getInputDefaultTemplate($element);
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::SELECT):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/select.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::OPTION):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/option.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::RADIO_GROUP):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/radiogroup.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::TEXT_AREA):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/textarea.php';
				break;
			
			case(Library_Qframe_Html_Const_FormElementConst::QLEGEND):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/qlegend.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::FILE_UPLOADER):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/fileuploader.php';
				break;
				
			default:
				throw new Exception('El elemento que se está analizando, cuyo nombre es ' . $this->element->getName() . ', no está soportado.');
				break;
		}
		
		return $template;
	}
	
	private static function getInputDefaultTemplate(Library_Qframe_Html_Element_FormElement $element)
	{
		$template = null;
		
		switch($element->getAttribute('type'))
		{
			case('text'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/text.php';
				break;
				
			case('email'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/email.php';
				break;
				
			case('password'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/password.php';
				break;
				
			case('radio'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/radio.php';
				break;
				
			case('checkbox'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/checkbox.php';
				break;
				
			case('file'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/file.php';
				break;
			
			case('hidden'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/hidden.php';
				break;
			
			case('date'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/date.php';
				break;
				
			case('button'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/button.php';
				break;
			
			case('autoimage'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/autoimage.php';
				break;
			
			case('mpfile'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/mpfile.php';
				break;
				
			case('mplink'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/mplink.php';
				break;
			
            case('mpuser'):
                $template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/mpuser.php';
            	break;
                        
            case('coordinates'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/coordinates.php';
				break;
                        
			case('submit'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/submit.php';
				break;
				
			default:
				throw new Exception('El atributo type del elemento input que se está analizando, cuyo valor es ' . $element->getAttribute('type') . ', no está soportado.');
				break;
		}
		
		return $template;
	}
	
}