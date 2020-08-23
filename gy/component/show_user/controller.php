<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if(!empty($this->arParam['id']) && is_numeric($this->arParam['id'])){
    global $user;
    $dateUser = $user->getUserById($this->arParam['id']);

    if(!empty($dateUser)){
        // взять все группы пользователей
        $allUsersGroups = accessUserGroup::getAccessGroup();
        
        $arRes['dataUser'] = array(
            'id' => $dateUser['id'],
            'login' => $dateUser['login'],
            'name' => $dateUser['name']
        );
        
        $groups = array();
        if(!empty($dateUser['groups'])){
            foreach ($dateUser['groups'] as $value) {
                if(!empty($allUsersGroups[$value])){
                    $groups[$value] = $allUsersGroups[$value]['name'].' - '.$allUsersGroups[$value]['text'];
                }
            }
        }
        $arRes['dataUser']['groups'] = $groups;
        
        // получить свойства и значения
        
        // получить все общие свойства пользователей которые были созданы
        $allUsersCreatePropertys = allUsersPropertys::getAllUsersPropertys();

        // получить значения свойств конкретного пользователя
        $valuePropertysThisUser = allUsersPropertys::getAllValueUserProperty( $this->arParam['id'], 'text'); // text - т.к. пока только такие типы свойств реализованы

        // собираю общий массив
        $propertys = array();
        foreach ($allUsersCreatePropertys as $key => $value) {

            $val = '';
            if(!empty($valuePropertysThisUser[$value['id']])){
                $val = $valuePropertysThisUser[$value['id']]['value'];
            }

            $propertys[] = array(
                'name_property' => $value['name_property'],
                'id_property' => $value['id'],
                'value' => $val
            );
        }
        $arRes['dataUser']['propertys'] = $propertys;
    }
        
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
