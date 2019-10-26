<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$data  = $_REQUEST;

$arRes['user_property'] = array(
	'login', 
	'name', 
	'pass', 
	'groups'
);

function checkProperty($arr, $arRes){
	$result = true;
	foreach ($arRes['user_property'] as $val){		
		if (empty($arr[$val])){
			$result = false;
		}
	}
	return $result;
}

// получить данные пользователя
if(!empty($this->arParam['id-user'])){
    global $user; 
    $arRes['userData'] = $user->getUserById($this->arParam['id-user']);  
    unset($arRes['userData']['pass']);
}

if (!empty($data['Сохранить']) && ($data['Сохранить'] == 'Сохранить') && !empty($data['edit-id']) && is_numeric($data['edit-id']) ) {
	if(checkProperty($data, $arRes)){
        // подготовить массив данных для обновления пользователей
        $dataUpdateUser = array();
        foreach ($arRes['user_property'] as $value) {
            $dataUpdateUser[$value] = $data[$value];
        }

        // обновить данные пользователя
		global $user;
        $res = $user->updateUserById($data['edit-id'], $dataUpdateUser);
        
        if($res){
            $arRes["stat"] = 'ok';
        }else{
            $arRes["stat-text"] = '! Не все поля заполнены';
            $arRes["stat"] = 'err';
        }
        			
	}else{
		$arRes["stat-text"] = '! Не все поля заполнены';
		$arRes["stat"] = 'err';
	}
	
	
} elseif( (!empty($arRes["stat"]) && ($arRes["stat"] != 'err')) || empty($arRes["stat"]) ) {
	
	$arRes["stat"] = 'edit';

}

if (empty($data['stat'])){
	header( 'Location: ?stat='.$arRes["stat"].'&edit-id='.$this->arParam['id-user'] );
}else{
	$arRes["stat"] = $data['stat'];
}
     
// показать шаблон
$this->template->show($arRes, $this->arParam);
