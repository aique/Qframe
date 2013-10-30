<?php

/**
 * Clase auxiliar encargada de realizar las distintas tareas
 * necesarias sobre los ficheros físicos manejados por la
 * aplicación.
 * 
 * @package qframe
 * 
 * @subpackage file
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_File_FileUtil
{

    /**
     * Devuelve una lista con los nombres de los ficheros que
     * se encuentran dentro de un directorio específico.
     * 
     * Es utilizado, entre otras, en las tareas de verificación
     * de la existencia de un controlador concreto, ya que
     * mediante este método se pueden obtener los nombres de los
     * controladores que se encuentran dentro del directorio
     * en el que se ubican.
     * 
     * @param string $folder
     * 
     * 		Ruta del directorio del cual se extraerán los nombres
     * 		de los ficheros contienidos en él.
     * 
     * @return array
     * 
     * 		Array de cadenas de texto con los nombres de los
     * 		ficheros encontrados en la ubicación recibida como
     * 		parámetro.
     */
    public static function getFilesFromFolder($folder)
    {
        return array_diff(scandir($folder), array('..', '.'));
    }

    /**
     * Obtiene el contenido de un fichero, siendo capaz de procesar
     * el código PHP que se encuentra en él y devolverlo todo en
     * una cadena de texto.
     * 
     * Es utilizado fundamentalmente para procesar el contenido de
     * las plantillas empleadas dentro de la aplicación y obtener
     * el resultado, que posteriormente será mostrado al usuario.
     * 
     * @param string $template
     * 
     * 		Ruta de la plantilla de la cual se obtendrá el contenido.
     * 
     * @param array $view
     * 
     * 		Array que contiene variables que serán utilizadas dentro
     * 		del código PHP que alberga la plantilla.
     * 
     * @return string
     * 
     * 		Si el proceso es correcto, devuelve el contenido de la
     * 		plantilla con el código PHP procesado. Si existe algún
     * 		error devolverá null.
     */
    public static function getFileContent($template, $view)
    {
        if(is_file($template))
        {
            ob_start();
            include $template;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        else
        {
            return null;
        }
    }

    /**
     * Elimina de manera recursiva un directorio y todo el contenido
     * que se encuentra dentro de él.
     * 
     * @param string $dir
     * 
     * 		Ruta del directorio que se eliminará, tanto él como su
     * 		contenido, de la ubicación física del mismo.
     */
    public static function removeDirectoryTree($dir)
    {
        if(file_exists($dir))
        {
            $dhandle = opendir($dir);

            if($dhandle)
            {
                while(($fname = readdir($dhandle)) !== false)
                {
                    if(is_dir("{$dir}/{$fname}"))
                    {
                        if(($fname != '.') && ($fname != '..'))
                        {
                            self::removeDirectoryTree("$dir/$fname");
                        }
                    }
                    else
                    {
                        unlink("{$dir}/{$fname}");
                    }
                }
                closedir($dhandle);
            }

            rmdir($dir);
        }
    }
    
    /**
     * Escribe contenido en un fichero determinado.
     * 
     * @param string $path
     * 
     *      Nombre del fichero, precedido de la ruta en la que se
     *      debe crear.
     *      
     * @param string $content
     * 
     *      Contenido que se escribirá en el fichero.
     * 
     * @return boolean
     * 
     *      Valor booleano que será verdadero si la escritura se
     *      realiza correctamente y falso en caso contrario.
     * 
     */
    public static function writeFile($path, $content)
    {
        $success = false;

        $fileHandler = fopen($path, 'w');

        if($fileHandler)
        {
            if(fwrite($fileHandler, $content))
            {
                $success = true;
            }

            fclose($fileHandler);
        }

        return $success;
    }

}