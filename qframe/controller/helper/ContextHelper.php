<?php

/**
 * 
 * Clase que determina la respuesta del action en función
 * del contexto especificado en la definición del método
 * action.
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Controller_Helper_ContextHelper
{
	private $context;
	
	public function __construct($context)
	{
		$this->context = $context;
	}
	
	/**
	 * Devuelve la información que se mostrará como resultado de
	 * la llamada al action, dependiendo del contexto que se le
	 * ha indicado dentro del mismo.
	 * 
	 * Actualmente existen dos contextos. Uno, por defecto, para
	 * generar una salida en formato HTML prevista para mostrarse
	 * en un navegador. Otro para generar una salida en formato
	 * JSON, típicamente llamado desde un JavaScript para aplicar
	 * funcionalidad bajo AJAX.
	 * 
	 * @param Library_Qframe_Controller_BaseController $controller
	 * 
	 * 		Controlador dentro del cual se encuentra definido el
	 * 		action solicitado y que contiene la información necesaria
	 * 		para llevar a cabo este proceso.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción cuando no encuentra el fichero que renderiza
	 * 		la capa de la vista dentro del contexto HTML.
	 */
	public function applyContext(Library_Qframe_Controller_BaseController $controller)
	{
		$contextOutput = "";
		
		switch($this->context)
		{
			case(Library_Qframe_Controller_ControllerConsts::HTML_ACTION_CONTEXT):
				
				$contextOutput = $this->applyLayout($controller, $this->applyView($controller));
				
			break;
			
			case(Library_Qframe_Controller_ControllerConsts::JSON_ACTION_CONTEXT):
				
				$contextOutput = $this->applyJSONConversion($controller);
				
			break;
			
			default:
				
				throw new Exception("El contexto establecido en el action no es válido. Encontrado " . $this->context . ".");
			
			break;
		}
		
		return $contextOutput;
	}
	
	/**
	 * Aplica el layout definido para el controlador.
	 *
	 * Si no se ha especificado ninguno, se aplicará el layout por defecto,
	 * el cual se encuentra dentro del directorio de layouts bajo el nombre
	 * de layout.
	 * 
	 * @param Library_Qframe_Controller_BaseController $controller
	 * 
	 * 		Controlador dentro del cual se encuentra definido el
	 * 		action solicitado y que contiene la información necesaria
	 * 		para llevar a cabo este proceso.
	 *
	 * @param string $content
	 *
	 * 		Cadena de texto con el código HTML que se mostrará en el navegador,
	 * 		a falta de aplicar el layout sobre él.
	 * 
	 * @return string
	 * 
	 * 		Cadena de texto con el código HTML que se mostrará en el navegador
	 * 		una vez aplicado el layout correspondiente.
	 */
	private function applyLayout(Library_Qframe_Controller_BaseController $controller, $content)
	{
		$view = $controller->getView();
	
		$view->addContent('content', $content);
	
		$layout = PROJECT_PATH . "/application/layouts/scripts/" . $controller->getLayout() . ".php";
	
		if(file_exists($layout))
		{
			return Library_Qframe_File_FileUtil::getFileContent($layout, $view);
		}
		else
		{
			$layout = include PROJECT_PATH . "/application/layouts/scripts/" . Library_Qframe_Controller_ControllerConsts::DEFAULT_LAYOUT . ".php";
	
			if(file_exists($layout))
			{
				return Library_Qframe_File_FileUtil::getFileContent($layout, $view);
			}
		}
	}
	
	/**
	 * Aplica el fichero que renderiza la capa de la vista y devuelve su
	 * contenido.
	 * 
	 * @param Library_Qframe_Controller_BaseController $controller
	 * 
	 * 		Controlador dentro del cual se encuentra definido el
	 * 		action solicitado y que contiene la información necesaria
	 * 		para llevar a cabo este proceso.
	 *
	 * @return string
	 *
	 * 		Cadena de texto con el código HTML que se mostrará en el navegador,
	 * 		a falta de aplicar el layout sobre él.
	 *
	 * @throws Exception
	 *
	 * 		Lanza una excepción cuando no encuentra el fichero que renderiza
	 * 		la capa de la vista.
	 */
	private function applyView(Library_Qframe_Controller_BaseController $controller)
	{
		$request = $controller->getRequest();
	
		$module = $request->getModule();
		$requestedController = $request->getController();
		
		// Si existe una vista específica se aplica, si no se
		// obtiene aquella que coincide con el nombre del action
		if($controller->getManualView())
		{
			$viewTemplateName = strtolower($controller->getManualView());
		}
		else
		{
			$viewTemplateName = strtolower($request->getAction());
		}
	
		if(empty($module))
		{
			$viewPath = PROJECT_PATH . "/application/views/scripts/" . $requestedController . "/" . $viewTemplateName . ".php";
		}
		else
		{
			$viewPath = PROJECT_PATH . "/application/modules/" . $module . "/views/scripts/" . $requestedController . "/" . $viewTemplateName . ".php";
		}
	
		if(file_exists($viewPath))
		{
			return Library_Qframe_File_FileUtil::getFileContent($viewPath, $controller->getView());
		}
		else
		{
			return "";
		}
	}
	
	/**
	 * Realiza una conversión a formato JSON de la información
	 * que se encuentra relacionada con la clave json dentro
	 * del array de la vista y retorna el resultado.
	 * 
	 * Esta función es llamada cuando el contexto del action
	 * se trata de un contexto JSON, y por tanto se desea que
	 * la salida se realiza en este formato y con la información
	 * que se encuentra en la ubicación mencionada.
	 * 
	 * @param Library_Qframe_Controller_BaseController $controller
	 * 
	 * 		Controlador dentro del cual se encuentra definido el
	 * 		action solicitado y que contiene la información necesaria
	 * 		para llevar a cabo este proceso.
	 * 
	 * @return
	 * 
	 * 		Cadena de texto con la salida en formato JSON de la
	 * 		información que se ha solicitado en el action.
	 */
	private function applyJSONConversion(Library_Qframe_Controller_BaseController $controller)
	{
		$view = $controller->getView();
		
		$jsonView = $view->getJsonContent();
		
		$output = "";
		
		if($jsonView)
		{
			foreach($jsonView as $key => $value)
			{
				$jsonView[$key] = $this->parseValue($value);
			}
			
			$output = json_encode($jsonView);
		}
		
		return $output;
	}
	
	private function parseValue($value)
	{
		if(is_array($value))
		{
			foreach($value as $key => $currentValue)
			{
				if(is_array($currentValue))
				{
					$value[$key] = $this->parseValue($value[$key]);
				}
				else
				{
					if(is_object($currentValue))
					{
						if($currentValue instanceof Library_Qframe_Model_BaseItem)
						{
							$value[$key] = $currentValue->getPrinter()->JSONPrint();
						}
					}
					else
					{
						$value[$key] = $currentValue;
					}
				}
			}
			
			return $value;
		}
		else
		{
			if(is_object($value))
			{
				if($value instanceof Library_Qframe_Model_BaseItem)
				{
					return $value->getPrinter()->JSONPrint();
				}
			}
			else
			{
				return $value;
			}
		}
	}
	
	/**
	 * Devuelve el valor del atributo context.
	 *
	 * @return string
	 */
	public function getContext()
	{
	    return $this->context;
	}
	 
	/**
	 * Establece el valor del atributo context.
	 *
	 * @param string $context
	 */
	public function setContext($context)
	{
	    $this->context = $context;
	}
} 