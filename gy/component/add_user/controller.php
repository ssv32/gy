<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$data  = $_REQUEST;

$arRes['user_property'] = array(
    'login',
    'name',
    'pass',
    'groups'
);

$redirectUrl = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

// взять все группы пользователей
$arRes['allUsersGroups'] = Gy\Core\User\AccessUserGroup::getAccessGroup();

function checkProperty($arr, $arRes){
    $result = true;
    foreach ($arRes['user_property'] as $val) {
        if (empty($arr[$val])) {
            $result = false;
        }
    }

    if ($result) {
        foreach ($arr['groups'] as $value) {  // TODO протестировать

            if (empty($arRes['allUsersGroups'][$value])) {
                $result = false;
            }

            if (!empty($arr['groups']['admins']) && !$USER->isAdmin()) { // TODO протестировать
                $result = false;
            }
        }
    }

    return $result;
}

if (!empty($data[$this->lang->getMessage('button')]) && ($data[$this->lang->getMessage('button')] == $this->lang->getMessage('button'))) {
    if (checkProperty($data, $arRes)) {
        // добавление пользователя
        global $USER;
        $arDaraUser = array();
        foreach ($arRes['user_property'] as $val) {
            $arDaraUser[$val] = $data[$val];
        }

        // убрать группы из добавления
        unset($arDaraUser['groups']);

        if ($USER->addUsers($arDaraUser)) {
            // найти id добавленного пользователя
            global $DB;
            global $CRYPTO;
            $res = $DB->selectDb(
                $USER->tableName,
                array('*'),
                array(
                    'AND' => array(
                        array('=' => array('login', "'".$arDaraUser['login']."'")),
                        array('=' => array('pass', "'".md5($arDaraUser['pass'].$CRYPTO->getSole())."'") )
                    )
                )
            );
            $dataAddNewUser = $DB->fetch($res);

            // добавить пользователя к указанным группам
            Gy\Core\User\AccessUserGroup::deleteUserInAllGroups($dataAddNewUser['id']);
            foreach ($data['groups'] as $value) {
                Gy\Core\User\AccessUserGroup::addUserInGroup($dataAddNewUser['id'], $value);
            }

            $arRes["stat"] = 'ok';
        } else {
            $arRes["stat"] = 'err';
        }

    } else {
        $arRes["stat-text"] = $this->lang->getMessage('err_property') ; // ! Не все поля заполнены
        $arRes["stat"] = 'err';
    }

} elseif ((!empty($arRes["stat"]) && ($arRes["stat"] != 'err')) || empty($arRes["stat"])) {
    $arRes["stat"] = 'add';
}

if (empty($data['stat'])) {
    header( 'Location: '.$redirectUrl.'?stat='.$arRes["stat"] );
} else {
    $arRes["stat"] = $data['stat'];
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
