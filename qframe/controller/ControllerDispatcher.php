<?php

/**
 * Contiene la lógica común a todos los controladores que llevará a cabo
 * el proceso de atención de peticiones.
 * 
 * @package qframe
 * 
 * @subpackage controller
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Controller_ControllerDispatcher
{
	private $controller;
	
	public function __construct(Library_Qframe_Controller_BaseController $controller)
	{
		$this->controller = $controller;
	}
	
	/**
	 * Atiende una petición recibida por la aplicación. Los pasos que se
	 * llevan a cabo son los sigueintes:
	 * 
	 * <ul>
	 * <li>Realiza una llamada al método init() para llevar a cabo las tareas de inicialización.</li>
	 * <li>Lleva a cabo un bucle sobre todos los plugins asociados a él ejecutando sus métodos preDispatch().</li>
	 * <li>Realiza una llamada al action correspondiente, aplicando la vista a su respuesta y posteriormente el layout.</li>
	 * <li>Lleva a cabo un bucle sobre todos los plugins asociados a él ejecutando sus métodos postDispatch().</li>
	 * <li>Realiza una llamada al método init() para llevar a cabo las tareas de finalización.</li>
	 * </ul>
	 */
	public function dispatch()
	{
		try
		{
			// Se establece la conexión con la base de datos
			Library_Qframe_Manage_DBManager::getInstance()->connect();
			
			// Se almacena el action tratado inicialmente
			$currentAction = $this->controller->getRequest()->__toString();
			
			// Operaciones de inicio
			$this->controller->init();
			$this->checkControllerRedirection($this->controller->getRequest(), $currentAction);
			$this->preDispatch($this->controller->getRequest());
			
			// Ejecucion del action
			$this->doAction();
			
			// Operaciones de finalización
			$this->postDispatch($this->controller->getRequest());
			$this->controller->end();
			
			$this->checkControllerRedirection($this->controller->getRequest(), $currentAction);
			
			echo $this->controller->getContext()->applyContext($this->controller);
			
			// Se cierra la conexión con la base de datos
			Library_Qframe_Manage_DBManager::getInstance()->disconnect();
		}
		catch(Exception $exception)
		{
			Library_Qframe_Manage_ResourceManager::getLogger()->logError($exception);
	
			$this->controller->getHelper()->redirect(new Library_Qframe_Request_Request(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE, "error", "error"));
			
			// Se cierra la conexión con la base de datos
			Library_Qframe_Manage_DBManager::getInstance()->disconnect();
		}
	}
	
	
	/**
	 * Comprueba si ha habido alguna redirección durante la ejecución
	 * del plugin. De ser así aborta el ciclo normal de ejecución y
	 * redirecciona adecuadamente.
	 * 
	 * @param Library_Qframe_Request_Request $request
	 * 
	 * 		Objeto de tipo petición con la información de las
	 * 		redirecciones surgidas en la ejecución del plugin
	 * 		en caso de haberse producido.
	 * 
	 * @param string $currentAction
	 * 
	 * 		Cadena de texto con el nombre del action que se está
	 * 		ejecutando actualmente dentro del ciclo de ejecución.
	 */
	private function checkControllerRedirection(Library_Qframe_Request_Request $request, $currentAction)
	{
		$controllerActionRequested = $request->__toString();
		
		if($currentAction != $controllerActionRequested)
		{
			$this->controller->getHelper()->redirect($request);
			
			$this->endDispatch();
		}
	}
	
	/**
	 * Realiza un bucle sobre todos los plugins asociados al controlador
	 * ejecutando sus métodos preDispatch().
	 * 
	 * Este método recibe el objeto petición como parámetro, ya que existe
	 * la opción de poder hacer una redirección dentro del plugin en caso
	 * de que así se considere oportuno.
	 * 
	 * @param Library_Qframe_Request_Request $request
	 * 
	 * 		Petición que se está tratando en el momento de ejecutar los métodos
	 * 		preDispatch() de los plugins.
	 */
	private function preDispatch(Library_Qframe_Request_Request $request)
	{
		$currentAction = $request->__toString(); 
		
		foreach($this->controller->getPlugins() as $plugin)
		{
			$plugin->preDispatch($request);
			
			$this->checkPluginRedirection($request, $currentAction);
		}
	}
	
	/**
	 * Realiza un bucle sobre todos los plugins asociados al controlador
	 * ejecutando sus métodos postDispatch().
	 *
	 * Este método recibe el objeto petición como parámetro, ya que existe
	 * la opción de poder hacer una redirección dentro del plugin en caso
	 * de que así se considere oportuno.
	 *
	 * @param Library_Qframe_Request_Request $request
	 *
	 * 		Petición que se está tratando en el momento de ejecutar los métodos
	 * 		postDispatch() de los plugins.
	 */
	private function postDispatch(Library_Qframe_Request_Request $request)
	{
		$currentAction = $request->__toString();
		
		foreach($this->controller->getPlugins() as $plugin)
		{
			$plugin->postDispatch($request);
			
			$this->checkPluginRedirection($request, $currentAction);
		}
	}
	
	/**
	 * Comprueba si ha habido alguna redirección durante la ejecución
	 * del plugin. De ser así aborta el ciclo normal de ejecución y
	 * redirecciona adecuadamente.
	 * 
	 * @param Library_Qframe_Request_Request $request
	 * 
	 * 		Objeto de tipo petición con la información de las
	 * 		redirecciones surgidas en la ejecución del plugin
	 * 		en caso de haberse producido.
	 * 
	 * @param string $currentAction
	 * 
	 * 		Cadena de texto con el nombre del action que se está
	 * 		ejecutando actualmente dentro del ciclo de ejecución.
	 */
	private function checkPluginRedirection(Library_Qframe_Request_Request $request, $currentAction)
	{
		$pluginActionRequested = $request->__toString();
		
		if($currentAction != $pluginActionRequested)
		{
			$this->controller->getHelper()->redirect($request);
			
			$this->endDispatch();
		}
	}
	
	public function endDispatch()
	{
		exit();
	}
	
	/**
	 * Analiza la URL asociada a la petición y determina que action del
	 * controlador será el encargado de responder.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción cuando no existe dentro del controlador el
	 * 		action que por la URL asociada a la petición debería encargarse
	 * 		de responder.
	 */
	private function doAction()
	{
		$request = $this->controller->getRequest();
		
		$module = $request->getModule();
		$controller = $request->getController();
		$action = $request->getAction();
		
		$method = $action . "Action";
	
		if(method_exists($this->controller, $method))
		{
			Library_Qframe_Manage_ResourceManager::getLogger()->logTrace("Llamando al action " . $method . " del controlador " . get_class($this));
				
			$this->controller->$method();
		}
		else
		{
			throw new Exception('No se ha encontrado el método ' . $method . ' dentro del controlador ' . get_class($this->controller) . '.');
		}
	}
}