<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $argv;
$isRunConsole = isset($argv);
$br = "\n";

if($isRunConsole){

//    include __DIR__."/../gy.php"; // подключить ядро // include core

    global $db;

    //---containerData---
    echo $br.$br.'--install table module - containerData = start--';

    echo $br.'install table module - containerData = start';
    $res = $db->createTable( // containerData-ы
        'container_data',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'name varchar(50)', 
            'code varchar(50)', 
        )
    );        

    $res = $db->createTable( // список свойств containerData
        'list_propertys_container_data',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'id_type_property int', 
            'id_container_data int', 
            'code varchar(50)', 
            'name varchar(50)', 
        )
    );

    $res = $db->createTable( // типы свойств containerData
        'types_property_container_data',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'info varchar(50)', 
            'code varchar(50)', 
            'name varchar(50)', 
            'name_table varchar(50)'
        )
    ); 

    $res = $db->insertDb(
        'types_property_container_data', 
        array(
            'name' => 'html', 
            'code' => 'html', 
            'info' => 'property save date - html',
            'name_table' => 'value_propertys_type_html'
        )
    );

    $res = $db->insertDb(
        'types_property_container_data', 
        array(
            'name' => 'number', 
            'code' =>   'number', 
            'info' => 'property save date - number',
            'name_table' => 'value_propertys_type_number'
        )
    );

    $res = $db->createTable( // элементы containerData-а
        'element_container_data',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'section_id int', 
            'code varchar(50)', 
            'name varchar(50)', 
            'id_container_data int',
        )
    ); 

    $res = $db->createTable( // значения свойств containerData-а типа строка
        'value_propertys_type_html',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'id_container_data int', 
            'id_element_container_data int',
            'id_property_container_data int',
            'value varchar(255)'
        )
    ); 

    $res = $db->createTable( // значения свойств containerData-а типа число
        'value_propertys_type_number',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'id_container_data int', 
            'id_element_container_data int',
            'id_property_container_data int',
            'value int'
        )
    );
    echo $br.'install table module - containerData = OK!';
    //-containerData-------------
    
    
    //--тестовый контент--
    echo $br.'install sest content - containerData = start';

    // добавить контейнер данных - контент
    containerData::addContainerData(array('code'=> 'Content','name'=> 'Контент2 | Content2'));

    $dataContentContainerData = containerData::getContainerData(array('=' => array('code', "'Content'")), array('*'));

    //добавить свойство
    containerData::addPropertyContainerData(
        array(
            'id_type_property' => 1,
            'id_container_data' => $dataContentContainerData[0]['id'],
            'code' => 'html-code',
            'name' => 'html вставка | html code'
        )
    );

    // добавить элемент контейнера данных
    containerData::addElementContainerData(
        array(
            'section_id' => 0,
            'code' => 'html-index-page',
            'name' => 'Приветствие на главной | Welcome on the main',
            'id_container_data' => $dataContentContainerData[0]['id']
        )
    );

    // взять типы свойств что бы знать названия таблиц где их искать
    //$dataTypeProperty = containerData::getAllTypePropertysContainerData();
    // найти элемент
    $dataElement = containerData::getElementContainerData(
        array(
            'AND' => array(
                array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                array( '=' => array( 'code', "'html-index-page'"))
            )
        )
    );

    // найти его свойства
    $propertyContainerData = containerData::getPropertysContainerData(
        array(
            '='=>array(
                'id_container_data', 
                $dataContentContainerData[0]['id']
            ) 
        ) 
    );
    $prop = array_shift($propertyContainerData);

    // добавить значение свойства для элемента созданного выше
    containerData::addValuePropertyContainerData(
        $dataContentContainerData[0]['id'], 
        $dataElement['id'], 
        $prop['id'],  
        'value_propertys_type_html', 
        'Привет пользователь, тебя приветствует gy php framework'.$br.' и текст показан из его контентной части!!!'.
            '| Hello user, you are greeted by the gy php framework and the text is shown from its content part !!!'
    );

    echo $br.'install sest content - containerData = OK!';
    ////
    
    echo $br.'add user group and action and user - containerData = start';
    // группы пользователей и права на действия 
    $db->insertDb(
        'action_user', 
        array(
            'code' => 'edit_container_data', 
            'text' => 'Изменение всех container-data | Edit all container-data', 
        )
    );
    
    $db->insertDb(
        'users_in_groups', 
        array(
            'code_group' => 'content', 
            'id_user' => 2,
        )
    );
    
    $db->insertDb(
        'access_group', 
        array(
            'code' => 'content', 
            'name' => 'Контент | Сontent',
            'text' => 'Те кто изменяют контент сайта | Those who can change the content of the site',
            'code_action_user' => 'edit_container_data'
        )
    );
    
    echo $br.'add user group and action and user - containerData = OK!';

    
    echo $br.'--install table module - containerData = OK!--'.$br;
    
}else{
    echo '! Error. You need to run the script in the console';

}