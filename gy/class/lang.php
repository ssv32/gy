<?php
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class lang{
	
	public $textLang; // тексты определённого языка

	function __construct($url, $fileName, $lang){
		$result = false; 
		
		if ( !empty($url) && !empty($fileName) && !empty($lang) ) {
			//load array text language
			$this->textLang = $this->GetArrLangFromFilre( $url.'/lang_'.$fileName.'.php', $lang );
		}

		return $result;
	}

	/** 
     * autoLoadLang
     * авто загрузка языкового файла для файла где вызывается эта функция
	 * 	нужно передать в какой файле вызывается (название компонента например, шаблона)
	 * @param namePHPFile	- файл в котором будет вызываться данный класс // там где нужен языковой файл
     * @return
     */

	function autoLoadLang($namePHPFile, $lang ){

	}

	/**
     *  GetMessage вернуть текст для заданной переменной текущего языка
	 * @param string $nameVar - передать переменную 
	 * @return вернёт текст или false
	 */
	function GetMessage($nameVar ){
		$result = false;
		if ( !empty($this->textLang[$nameVar]) ){
			$result = $this->textLang[$nameVar];
		}
		return $result;
	}

	
	/**
	 * GetArrLangFromFilre загрузить массив с текстом нужного языка // load array text language
	 * @param $urlFile ссылка на загружаемый файл // url load file
	 * @param $lang - нужный язык // language // rus, eng ...
	 * 
	 * @return массив с текстом на выбранном языке // language text array 
	 */
	function GetArrLangFromFilre( $urlFile, $lang ){
		$mess = array();
	
		// если есть файл с языковыми параметрами
		if ( file_exists($urlFile) ){	
			include $urlFile;
		}

		return $mess[$lang];
	}
	
}
?>