<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$data  = $_REQUEST;

// стоит ли галочка не обновлять пароль, при изменении пользователя
$notUpdatePass = (!empty($data['no-update-pass']) && ($data['no-update-pass'] == 'on') );

$arRes['user_property'] = array(
    'login' => 'login', 
    'name' => 'name', 
    'pass' => 'pass', 
    'groups' => 'groups'
);

// если идёт обновление пользователя без пароля то убрать пароль из списка свойств пользователя
if ($notUpdatePass) {
    unset($arRes['user_property']['pass']);
}

global $user; 

// взять все группы пользователей
$arRes['allUsersGroups'] = AccessUserGroup::getAccessGroup();

function checkProperty($arr, $arRes){
    $result = true;
    foreach ($arRes['user_property'] as $val) {	
        if (empty($arr[$val])) {
            $result = false;
        } 
    }
        
    if($result){
        foreach ($arr['groups'] as $value) {  // TODO протестировать
            
            if (empty($arRes['allUsersGroups'][$value])) {
                $result = false;
            }
            
            if (!empty($arr['groups']['admins']) && !$user->isAdmin()) { // TODO протестировать
                $result = false;
            }
        }
    }
    
    return $result;
}

// получить данные пользователя
if (!empty($this->arParam['id-user'])) {  
    $arRes['userData'] = $user->getUserById($this->arParam['id-user']);  
    unset($arRes['userData']['pass']);
}

if (!empty($data['Сохранить']) 
    && ($data['Сохранить'] == 'Сохранить') 
    && !empty($data['edit-id']) 
    && is_numeric($data['edit-id']) 
    && ($data['edit-id'] != 1)  
) {
        
    if (checkProperty($data, $arRes)) {

        // подготовить массив данных для обновления пользователей
        $dataUpdateUser = array();
        foreach ($arRes['user_property'] as $value) {
            $dataUpdateUser[$value] = $data[$value];
        }

        // сохранить группы для пользователя
        unset($dataUpdateUser['groups']);
        AccessUserGroup::deleteUserInAllGroups($data['edit-id']);
        foreach ($data['groups'] as $value) {
            AccessUserGroup::addUserInGroup($data['edit-id'], $value);
        }
        
        // обновить данные пользователя
        global $user;
        $res = $user->updateUserById($data['edit-id'], $dataUpdateUser);
        
        if ($res) {
            $arRes["stat"] = 'ok';
        } else {
            $arRes["stat-text"] = '! Не все поля заполнены';
            $arRes["stat"] = 'err';
        }
        			
    } else {
        $arRes["stat-text"] = '! Не все поля заполнены';
        $arRes["stat"] = 'err';
    }


} elseif ((!empty($arRes["stat"]) && ($arRes["stat"] != 'err')) || empty($arRes["stat"])) {
    $arRes["stat"] = 'edit';
}

if (empty($data['stat'])) {
    header( 'Location: ?stat='.$arRes["stat"].'&edit-id='.$this->arParam['id-user'] );
} else {
    $arRes["stat"] = $data['stat'];
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
