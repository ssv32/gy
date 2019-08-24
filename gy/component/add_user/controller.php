<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$data  = $_REQUEST;

$arRes['user_property'] = array(
	'login', 
	'name', 
	'pass', 
	'groups'
);

$redirectUrl = str_replace('index.php', '', $_SERVER['DOCUMENT_URI']);

function checkProperty($arr, $arRes){
	$result = true;
	foreach ($arRes['user_property'] as $val){		
		if (empty($arr[$val])){
			$result = false;
		}
	}
	return $result;
}

if (!empty($data['Добавить']) && ($data['Добавить'] == 'Добавить')) {
	if(checkProperty($data, $arRes)){
		// добавление пользователя
		global $user;
		$arDaraUser = array();
		foreach ($arRes['user_property'] as $val){
			$arDaraUser[$val] = $data[$val];
		}
		
		if( $user->addUsers($arDaraUser)){
			$arRes["stat"] = 'ok';
		} else{
			$arRes["stat"] = 'err';
		}
				
	}else{
		$arRes["stat-text"] = '! Не все поля заполнены';
		$arRes["stat"] = 'err';
	}
	
	
} elseif( (!empty($arRes["stat"]) && ($arRes["stat"] != 'err')) || empty($arRes["stat"]) ) {
	
	$arRes["stat"] = 'add';

}

if (empty($data['stat'])){
	header( 'Location: '.$redirectUrl.'?stat='.$arRes["stat"] );
}else{
	$arRes["stat"] = $data['stat'];
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
