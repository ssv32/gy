<? // TODO сделать нормальнопо шагам потом
global $argv;
$isRunConsole = isset($argv);
$br = "\n";

if($isRunConsole){

    include __DIR__."/../gy.php"; // подключить ядро // include core

    echo 'install table - user ...';

    global $db;

    $res = $db->createTable(
        'users',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'login varchar(50)', 
            'name varchar(50)', 
            'pass varchar(50)', 
            'hash_auth varchar(50)', 
            //'groups int'
        )
    );        

    if ($res === true){
        echo $br.'install table - user - OK';

        echo $br.'add admin ...';

        $res = $db->insertDb(
            'users', 
            array(
                'login' => 'admin', 
                'name' => 'admin', 
                'pass' =>   'admin', 
                //'groups' => 1
            )
        );

        $res = $db->insertDb(
            'users', 
            array(
                'login' => 'asd', 
                'name' => 'asd', 
                'pass' =>  'asdasd', 
                //'groups' => 2
            )
        );

        if($res === true){
            echo $br.'add admin - OK';
        }else{
            echo $br.'add admin - NOT!';
        }

    }else{
        echo $br.'install table - user - NOT!';
    }

    //---infoBox---
    echo 'install table - infoBox ...';

    $res = $db->createTable( // infoBox-ы
        'info_box',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'name varchar(50)', 
            'code varchar(50)', 
        )
    );        

    $res = $db->createTable( // список свойств infoBox
        'list_propertys_info_box',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'id_type_property int', 
            'id_info_box int', 
            'code varchar(50)', 
            'name varchar(50)', 
        )
    );

    $res = $db->createTable( // типы свойств infoBox
        'types_property_info_box',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'info varchar(50)', 
            'code varchar(50)', 
            'name varchar(50)', 
            'name_table varchar(50)'
        )
    ); 

    $res = $db->insertDb(
        'types_property_info_box', 
        array(
            'name' => 'html', 
            'code' => 'html', 
            'info' => 'property save date - html',
            'name_table' => 'value_propertys_type_html'
        )
    );

    $res = $db->insertDb(
        'types_property_info_box', 
        array(
            'name' => 'number', 
            'code' =>   'number', 
            'info' => 'property save date - number',
            'name_table' => 'value_propertys_type_number'
        )
    );

    $res = $db->createTable( // элементы infoBox-а
        'element_info_box',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'section_id int', 
            'code varchar(50)', 
            'name varchar(50)', 
            'id_info_box int',
        )
    ); 

    $res = $db->createTable( // значения свойств infoBox-а типа строка
        'value_propertys_type_html',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'id_info_box int', 
            'id_element_info_box int',
            'id_property_info_box int',
            'value varchar(255)'
        )
    ); 

    $res = $db->createTable( // значения свойств infoBox-а типа число
        'value_propertys_type_number',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'id_info_box int', 
            'id_element_info_box int',
            'id_property_info_box int',
            'value int'
        )
    );
    echo $br.'install table - infoBox OK';
    //-infoBox-------------


    //--тестовый контент--
    echo $br.'install info-box Content - test content...';

    // добавить инфоблок контент
    infoBox::addInfoBox(array('code'=> 'Content','name'=> 'Контент2'));

    $dataContentInfoBox = infoBox::getInfoBox(array('=' => array('code', "'Content'")), array('*'));

    //добавить свойство
    infoBox::addPropertyInfoBox(
        array(
            'id_type_property' => 1,
            'id_info_box' => $dataContentInfoBox[0]['id'],
            'code' => 'html-code',
            'name' => 'html вставка'
        )
    );

    // добавить элемент инфоблока
    infoBox::addElementInfoBox(
        array(
            'section_id' => 0,
            'code' => 'html-index-page',
            'name' => 'Приветствие на главной',
            'id_info_box' => $dataContentInfoBox[0]['id']
        )
    );

    // взять типы свойств что бы знать названия таблиц где их искать
    //$dataTypeProperty = infoBox::getAllTypePropertysInfoBox();
    // найти элемент
    $dataElement = infoBox::getElementInfoBox(
        array(
            'AND' => array(
                '=' => array(
                    'id_info_box', 
                    $dataContentInfoBox[0]['id']
                ),
                'AND' => array(
                    '=' => array(
                        'code',
                        "'html-index-page'"
                    )
                )
            )
        )
    );

    // найти его свойства
    $propertyInfoBox = infoBox::getPropertysInfoBox(
        array(
            '='=>array(
                'id_info_box', 
                $dataContentInfoBox[0]['id']
            ) 
        ) 
    );
    $prop = array_shift($propertyInfoBox);

    // добавить значение свойства для элемента созданного выше
    infoBox::addValuePropertyInfoBox(
        $dataContentInfoBox[0]['id'], 
        $dataElement['id'], 
        $prop['id'],  
        'value_propertys_type_html', 
        'Привет пользователь, тебя приветствует gy php framework'.$br.' и текст показан из его контентной части!!!'
    );

    echo $br.'install info-box Content - test content OK';
    ////
    
    
    // задать группы прав доступа и дефствия разрешаемые для пользователей групп
    echo $br.'install access group - start';
    
    // это действия пользователей к которые можно указать для группы пользователей
    //  суда нужно добавлять новые при появление нового в админке и прочего (модули если будут сделаны в этой версии)
    $res = $db->createTable(
        'action_user',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'code varchar(255)', 
            'text varchar(255)', 
        )
    );        

    if ($res === true){
        
        $db->insertDb(
            'action_user', 
            array(
                'code' => 'action_all', 
                'text' => 'Редактировать всё (Админ)', 
            )
        );
        
        $db->insertDb(
            'action_user', 
            array(
                'code' => 'edit_info_box', 
                'text' => 'Изменение всех info_box', 
            )
        );
        
        $db->insertDb(
            'action_user', 
            array(
                'code' => 'edit_users', 
                'text' => 'Изменение пользователей (кроме админов)', 
            )
        );
        
        
    }
    
    
    // это группы (пользователей) прав доступа
    $res = $db->createTable(
        'access_group',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'code varchar(255)', 
            'name varchar(255)', 
            'text varchar(255)', 
            'code_action_user varchar(255)' // код действия пользователя, разрешённый для данной группы
        )
    );        

    if ($res === true){
        
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'admins', 
                'name' => 'Админы',
                'text' => 'Админы, есть права на всё',
                'code_action_user' => 'action_all'
            )
        );
        
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'content', 
                'name' => 'Контент',
                'text' => 'Те кто изменяют контент сайта',
                'code_action_user' => 'edit_info_box'
            )
        );
        
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'user_admin', 
                'name' => 'Админи по пользователям',
                'text' => 'Могут изменять только пользователей', 
                'code_action_user' => 'edit_users'
            )
        );
        
    }
    
    // в этой таблице будут группы и относящиеся к ним пользователи
    $res = $db->createTable(
        'users_in_groups',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'codeGroup varchar(255)', 
            'idUser int', 
        )
    );
    
    if ($res === true){
        
        $db->insertDb(
            'users_in_groups', 
            array(
                'codeGroup' => 'admins', 
                'idUser' => 1,
            )
        );
        $db->insertDb(
            'users_in_groups', 
            array(
                'codeGroup' => 'content', 
                'idUser' => 2,
            )
        );
        $db->insertDb(
            'users_in_groups', 
            array(
                'codeGroup' => 'user_admin', 
                'idUser' => 2,
            )
        );
    }    
    
    echo $br.'install access group - ok';
    
}else{
	echo '! нужно запустить скрипт в консоли';

}