<?php

/**
 * Se encarga de delegar en el controlador adecuado una petición realizada
 * sobre la aplicación.
 * 
 * Se instancia dentro del bootstrap como una de las primeras
 * acciones que se realiza dentro del proceso de atención de
 * una petición.
 * 
 * @package qframe
 * 
 * @subpackage app
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_App_Dispatcher
{

    /**
     * Crea una instancia del controlador que ha de gestionar la petición
     * realizada y llama a su método dispatch(), el cual será el verdadero
     * encargado de atender la petición.
     * 
     * @param Library_Qframe_Request_Request $request
     * 
     * 		Objeto que contiene entre sus atributos la información de la
     * 		petición solicitada.
     */
    public static function dispatchRequest(Library_Qframe_Request_Request $request)
    {
        $controller = self::getController($request);

        if($controller)
        {
            if(Library_Qframe_Parsers_ConfigFileParser::getVarValue(PROJECT_PATH . '/application/configs/config.ini', "maintenance.active"))
            {
                if(Library_Qframe_Manage_SessionManager::getVar("maintenanceUserLogged"))
                {
                    $controller->dispatch();
                }
                else
                {
                    if($request->getController() == "maintenance" && $request->getAction() == "login")
                    {
                        $controller->dispatch();
                    }
                    else
                    {
                        $maintenanceController = new Application_Controllers_MaintenanceController(new Library_Qframe_Request_Request(null, "maintenance"));
                        $maintenanceController->dispatch();
                    }
                }
            }
            else
            {
                $controller->dispatch();
            }
        }
        else
        {
            Library_Qframe_App_Dispatcher::dispatchRequest(new Library_Qframe_Request_Request("", "error", "pageNotFound"));
        }
    }

    private static function getController(Library_Qframe_Request_Request $request)
    {
        $module = $request->getModule();

        $controller = ucwords($request->getController());

        if(Library_Qframe_App_Helper::isController($controller))
        {
            if(empty($module))
            {
                $constructor = "Application_Controllers_" . $controller . "Controller";
            }
            else
            {
                $constructor = "Application_Modules_" . $module . "_Controllers_" . $controller . "Controller";
            }

            return new $constructor($request);
        }
        else
        {
            return null;
        }
    }

}