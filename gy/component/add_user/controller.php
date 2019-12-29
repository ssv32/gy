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

// взять все группы пользователей
$arRes['allUsersGroups'] = accessUserGroup::getAccessGroup();

function checkProperty($arr, $arRes){
	$result = true;
	foreach ($arRes['user_property'] as $val){	
        if (empty($arr[$val])){
            $result = false;
        }    
	}
    
    if($result){
        foreach ($arr['groups'] as $value) {  // TODO протестировать
            
            if( empty($arRes['allUsersGroups'][$value]) ){
                $result = false;
            }
            
            if(!empty($arr['groups']['admins']) && !$user->isAdmin()){ // TODO протестировать
                $result = false;
            }
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
		
        // убрать группы из добавления
        unset($arDaraUser['groups']);
       
		if( $user->addUsers($arDaraUser)){
            // найти id добавленного пользователя
            global $db;		   
            global $crypto;
            $res = $db->selectDb( 
                $user->tableName, 
                array('*'),
                array(
                    'AND' => array(
                        '=' => array('login', "'".$arDaraUser['login']."'"),
                        'AND' => array('=' => array('pass', "'".md5($arDaraUser['pass'].$crypto->getSole())."'") )
                    )
                )
            );
            $dataAddNewUser = $db->fetch($res);
            
            // добавить пользователя к указанным группам
            accessUserGroup::deleteUserInAllGroups($dataAddNewUser['id']);
            foreach ($data['groups'] as $value) {
                accessUserGroup::addUserInGroup($dataAddNewUser['id'], $value);
            }
            
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
