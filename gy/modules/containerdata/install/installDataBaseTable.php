<? 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

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
    containerData::addContainerData(array('code'=> 'Content','name'=> 'Контент2'));

    $dataContentContainerData = containerData::getContainerData(array('=' => array('code', "'Content'")), array('*'));

    //добавить свойство
    containerData::addPropertyContainerData(
        array(
            'id_type_property' => 1,
            'id_container_data' => $dataContentContainerData[0]['id'],
            'code' => 'html-code',
            'name' => 'html вставка'
        )
    );

    // добавить элемент контейнера данных
    containerData::addElementContainerData(
        array(
            'section_id' => 0,
            'code' => 'html-index-page',
            'name' => 'Приветствие на главной',
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
        'Привет пользователь, тебя приветствует gy php framework'.$br.' и текст показан из его контентной части!!!'
    );

    echo $br.'install sest content - containerData = OK!';
    ////
    
    echo $br.'add user group and action and user - containerData = start';
    // группы пользователей и права на действия 
    $db->insertDb(
        'action_user', 
        array(
            'code' => 'edit_container_data', 
            'text' => 'Изменение всех container-data', 
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
            'name' => 'Контент',
            'text' => 'Те кто изменяют контент сайта',
            'code_action_user' => 'edit_container_data'
        )
    );
    
    echo $br.'add user group and action and user - containerData = OK!';

    
    echo $br.'--install table module - containerData = OK!--'.$br;
    
}else{
    echo '! нужно запустить скрипт в консоли';

}