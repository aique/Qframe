<?php

/**
 * Clase auxiliar con funcionalidad común para obtener información
 * acerca de la estructura de la aplicación.
 * 
 * @package qframe
 * 
 * @subpackage app
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_App_Helper
{
	/**
	 * Devuelve todos los módulos de los que consta la aplicación.
	 * 
	 * @return array
	 * 
	 * 		Array de cadenas de texto con el nombre de todos los módulos
	 * 		de la aplicación.
	 */
	public static function getModules()
	{
		return Library_Qframe_File_FileUtil::getFilesFromFolder(PROJECT_PATH . "/application/modules");
	}
	
	/**
	 * Identifica la existencia de un módulo a partir de su nombre dentro de la
	 * estructura de la aplicación.
	 * 
	 * @param string $moduleName
	 * 
	 * 		Nombre del módulo del cual se quiere identificar su existencia.
	 * 
	 * @return
	 * 
	 * 		Devuelve true en caso de que el módulo exista y false en caso contrario.
	 */
	public static function isModule($moduleName)
	{
		if(!empty($moduleName))
		{
			if(file_exists(PROJECT_PATH . "/application/modules/" . $moduleName))
			{
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Identifica la existencia de un controlador a partir de su nombre dentro de la
	 * estructura de la aplicación.
	 *
	 * @param string $controllerName
	 *
	 * 		Nombre del controlador del cual se quiere identificar su existencia.
	 *
	 *  @return
	 *
	 * 		Devuelve true en caso de que el controlador exista y false en caso contrario.
	 */
	public static function isController($controllerName)
	{
		$controllerName = ucwords($controllerName);
		
		if(!empty($controllerName))
		{
			if(file_exists(PROJECT_PATH . "/application/controllers/" . $controllerName . "Controller.php"))
			{
				return true;
			}
			
			foreach(self::getModules() as $module)
			{
				if(file_exists(PROJECT_PATH . "/application/modules/" . $module . "/controllers/" . $controllerName . "Controller.php"))
				{
					return true;
				}
			}
		}
	
		return false;
	}
	
	public static function isAction($moduleName, $controllerName, $actionName)
	{
		if($moduleName)
		{
			$controllerName = "Application_Modules_".ucwords($moduleName)."_Controllers_".ucwords($controllerName)."Controller";
		}
		else
		{
			$controllerName = "Application_Controllers_".ucwords($controllerName)."Controller";
		}
		
		$controllerMethods = get_class_methods($controllerName);
		
		foreach($controllerMethods as $method)
		{
			if(strtolower($actionName."Action") == strtolower($method))
			{
				return true;
			}
		}
		
		return false;
	}
}