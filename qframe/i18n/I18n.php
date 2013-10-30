<?php

	/**
	 * Clase que recibirá las peticiones referentes a la internacionalización y delegará
	 * su tratamiento al cliente correspondiente.
	 * 
	 * Se trata de una fachada a través de la cual se accede a los distintos servicios del
	 * sistema de internacionalización.
	 */
	class Library_Qframe_I18n_I18n
	{
		/**
		 * Obtiene el contenido de un texto que se encuentra dentro de los ficheros de
		 * internacionalización de la aplicación y que está marcado con una etiqueta
		 * cuyo valor corresponde con el recibido como parámetro.
		 * 
		 * @param string $textId
		 * 		Identificador del texto que se quiere extraer de los ficheros de internacionalización.
		 * 
		 * @param array $params
		 * 		Array de parámetros. Simplemente se trata de un array con cadenas, las cuales serán
		 * 		sustituidas por las interrogaciones que figuran en el texto rescatado. La posición
		 * 		vendrá determinada por el número que figura junto a la interrogación, que se utilizará
		 * 		como índice para acceder a la variable de este array de parámetros y sustituir su valor.
		 */
		public static function getText($textId, $params = null)
		{
			return Library_Qframe_I18n_Text_TextClient::getInstance()->getText($textId, $params);
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
		 */
		public static function getFileContent($name = null, $filePath = null, $view = null)
		{
			return Library_Qframe_I18n_Text_TextClient::getFileContent($name, $filePath, $view);
		}
		
		/**
		 * Devuelve la fecha recibida como parámetro internacionalizada en el lenguaje
		 * correspondiente y con el formato que se le indica al método.
		 * 
		 * @param Library_Qframe_I18n_Date_Date $date
		 * 
		 * 		Objeto con la información de la fecha que se desea internacionalizar.
		 * 
		 * @param string $format
		 * 
		 * 		Constante textual que indica el tipo de formato que se utilizará
		 * 		para devolver la respuesta a partir de una serie de formato ya
		 * 		fijados.
		 * 
		 * @return string
		 * 
		 * 		Cadena de texto con la fecha internacionalizada según los parámetros
		 * 		recibidos.
		 */
		public static function getDate($date, $format = Library_Qframe_I18n_Date_DateFormat::SHORT, $locale = null)
		{
			return Library_Qframe_I18n_Date_DateClient::getDate($date, $format, $locale);
		}
		
		/**
		 * Devuelve una cadena de texto con el resultado de varias fechas concatenadas
		 * entre sí de manera indicada según el lenguaje.
		 * 
		 * @param array $dates
		 * 
		 * 		Array de objetos de tipo Library_Qframe_I18n_Date_Date con las fechas
		 * 		que se desean internacionalizar.
		 * 
		 * @param string $format
		 * 
		 * 		Constante textual que indica el tipo de formato que se utilizará
		 * 		para devolver la respuesta a partir de una serie de formato ya
		 * 		fijados.
		 * 
		 * @return string
		 * 
		 * 		Cadena de texto con las fechas internacionalizadas según los parámetros
		 * 		recibidos
		 */
		public static function getMultipleDates(array $dates, $format = Library_Qframe_I18n_Date_DateFormat::SHORT)
		{
			return Library_Qframe_I18n_Date_DateClient::getMultipleDates($dates, $format);
		}
		
		/**
		 * @param unknown_type $monthNumber
		 */
		public static function getMonthName($monthNumber)
		{
			return Library_Qframe_I18n_Date_DateClient::getMonthName($monthNumber);
		}
		
		/**
		 * @param unknown_type $money
		 * @param unknown_type $format
		 * @param unknown_type $locale
		 */
		public static function getMoney($money, $format = Library_Qframe_I18n_Money_MoneyFormat::CURRENCY)
		{	
			return Library_Qframe_I18n_Money_MoneyClient::getMoney($money, $format);
		}
		
	}

?>