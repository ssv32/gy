<?php
class lang{
	
	public $textLang; // тексты определённого языка

	function __construct($url, $fileName, $lang){
		$result = false; 
		
		if ( !empty($url) && !empty($fileName) && !empty($lang) ) {

			// если есть файл с языковыми параметрами
			if ( file_exists($url.'/lang_'.$fileName.'.php' ) ){

				include $url.'/lang_'.$fileName.'.php';

				if ( !empty($mess[$lang]) ) {
					$this->textLang = $mess[$lang];
				}

				unset($mess); // TODO перепроверить надо ли это делать
			}

			// $this->textLang = $url;
		}

		return $result;
	}

	/* авто подгрузка языковогофайла для файла где вызывается эта функция
	* 	нужно передать в какой файле вызывается (название компонента например, шаблона)
	*   namePHPFile	- файл в котором будет вызываться данный класс // там где нужен языковой файл
	*/

	function autoLoadLang($namePHPFile, $lang ){

	}

	/* GetMessage вернуть текст для заданной переменной текущего языка
	*   передать переменную 
	* 	вернёт текст или false
	*/
	function GetMessage($nameVar ){
		$result = false;
		if ( !empty($this->textLang[$nameVar]) ){
			$result = $this->textLang[$nameVar];
		}
		return $result;
	}

}
?>