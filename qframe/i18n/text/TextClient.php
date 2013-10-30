<?php

	/**
	 * Clase cliente cuya función es atender las peticiones de tipo texto que
	 * el módulo de internacionalización I18n recibe.
	 */
	class Library_Qframe_I18n_Text_TextClient
	{
		private $fileManager;
		
		private static $instance = null;
		
		private function __construct()
		{
			$this->fileManager = new Library_Qframe_I18n_I18nFileManager();
		}
		
		public static function getInstance()
		{
			if(self::$instance == null)
			{
				self::$instance = new Library_Qframe_I18n_Text_TextClient();
			}
			
			return self::$instance;
		}
		
		/**
		 * Devuelve el valor del atributo fileManager.
		 *
		 * @return Library_Qframe_I18n_I18nFileManager
		 */
		public function getFileManager()
		{
		    return $this->fileManager;
		}
		 
		/**
		 * Establece el valor del atributo fileManager.
		 *
		 * @param Library_Qframe_I18n_I18nFileManager $fileManager
		 */
		public function setFileManager($fileManager)
		{
		    $this->fileManager = $fileManager;
		}
		
		/**
		 * Método que devuelve un texto contenido en los ficheros de internacionalización
		 * a partir de la etiqueta asociada a él.
		 * 
		 * Según la localización proporcionada por el gestor de internacionalización extraerá
		 * el mencionado contenido de los ficheros correspondientes a uno y otro idioma.
		 * 
		 * @param string $textId
		 * 		Identificador del texto que se quiere extraer de los ficheros de internacionalización.
		 * 
		 * @param array $params
		 * 		Array de parámetros. Simplemente se trata de un array con cadenas, las cuales serán
		 * 		sustituidas por las interrogaciones que figuran en el texto rescatado. La posición
		 * 		vendrá determinada por el número que figura junto a la interrogación, que se utilizará
		 * 		como índice para acceder a la variable de este array de parámetros y sustituir su valor.
		 * 
		 * @throws Exception
		 * 		Se lanza una excepción alertando de que la localización no se encuentra dentro
		 * 		de las soportadas por el sistema, lo que implica que la ruta de los ficheros de
		 * 		internacionalización no se ha podido resolver ni por tanto extraer el texto
		 * 		solicitado.
		 */
		public function getText($textId, $params = null)
		{
                        $locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
			
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$text = self::getTextFromFile($textId);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$text = self::getTextFromFile($textId);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasPortuguishLocation($locale))
			{
				$text = self::getTextFromFile($textId);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
			
			return Library_Qframe_I18n_Text_TextPrinter::doPrint($text, $params);
		}
		
		/**
		 * Obtiene el contenido que se encuentra en un fichero especificado por los parámetros
		 * que este método recibe. A diferencia de otros métodos de esta clase, retorna la totalidad
		 * del contenido del fichero.
		 * 
		 * Es útil cuando la salida que se quiere mostrar por pantalla es exactamente el contenido
		 * que se encuentra dentro del fichero que este método volcará a salida.
		 * 
		 * @param string $name
		 * 		Parámetro que indica el nombre del fichero al que este método accederá. A diferencia
		 * 		del resto de parámetros, es el único obligatorio que este método ha de recibir.
		 * 
		 * @param string $filePath
		 * 		Ubicación física dentro del servidor en la cual se encuentra el fichero al que este
		 * 		método accederá. Es un parámetro opcional, sin embargo es importante tener claro cuando
		 * 		ha de completarse.
		 * 
		 * 		Si se deja en blanco, por defecto el método buscará un fichero con el nombre indicado
		 * 		en el primer parámetro dentro del directorio por defecto de ficheros de internacionalización.
		 * 
		 * 		Este directorio se encuentra en la siguiente ruta:
		 * 		[pathFicherosInternacionalización] + locale + files
		 * 
		 * 		Si se completa, se puede especificar cualquier ruta dentro del servidor, permitiendo que
		 * 		este método actúe sobre un fichero sin importar su ubicación.
		 * 
		 * @param array $view
		 * 		Array de parámetros al que el fichero puede tener acceso mediante código PHP.
		 * 
		 * @throws Exception
		 * 		Se lanza una excepción alertando de que uno de los parámetros necesarios para que el método
		 * 		pueda operar correctamente no se ha recibido o bien su contenido es vacío. Se trata del
		 * 		primer parámetro que especifica el nombre del fichero.
		 */
		public function getFileContent($name, $filePath = null, $view = null)
		{
			if(!isset($name) || empty($name))
			{
				throw new Exception("Parámetro requerido no recibido o vacío.");
			}
			
			if(!$filePath)
			{
				$locale = Library_Qframe_Manage_ResourceManager::geti18nData()->getLocale();
				
				$filePath = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("i18n.path") . '/' . $locale . '/files/' . $name;
			}
			
			return Library_Qframe_File_FileUtil::getFileContent($filePath, $view);
		}
		
		private static function getTextFromFile($textId)
		{
			return self::$instance->getFileManager()->getText($textId);
		}
		
	}

?>