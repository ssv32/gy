<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

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

if ( $_REQUEST['Добавить'] == 'Добавить') {
	if(checkProperty($_REQUEST, $arRes)){
		// добавление пользователя
		global $user;
		$arDaraUser = array();
		foreach ($arRes['user_property'] as $val){
			$arDaraUser[$val] = $_REQUEST[$val];
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
	
	
} elseif($arRes["stat"] != 'err') {
	
	$arRes["stat"] = 'add';

}

if (empty($_REQUEST['stat'])){
	header( 'Location: '.$redirectUrl.'?stat='.$arRes["stat"] );
}else{
	$arRes["stat"] = $_REQUEST['stat'];
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
