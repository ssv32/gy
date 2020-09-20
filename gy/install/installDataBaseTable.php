<? 
// TODO проверку на ошибки переделать с учётом установки на пострис

global $argv;
$isRunConsole = isset($argv);
$br = "\n";

if($isRunConsole){

    include __DIR__."/../gy.php"; // подключить ядро // include core

    echo $br.'-----install gy core taldes db-----';
    echo $br.'install user table = start';

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
    
   // if ($res === true){
        echo $br.'install user table = OK!';

        echo $br.'add admin user (and test user) = start';

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

//        if($res === true){
            echo $br.'add admin user = OK!';
//        }else{
//            echo $br.'add admin user = ERROR!';
//        }
//    }else{
//        echo $br.'install user table = ERROR!';
//    }

    // задать группы прав доступа и действия разрешаемые для пользователей групп
    echo $br.'install access users = start';
    
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

    //if ($res === true){
        
        $db->insertDb(
            'action_user', 
            array(
                'code' => 'show_admin_panel', 
                'text' => 'Просматривать админку | View admin panel', 
            )
        );
        
        $db->insertDb(
            'action_user', 
            array(
                'code' => 'action_all', 
                'text' => 'Редактировать всё (Админ) | Edit All (Admin)', 
            )
        );
        
        $db->insertDb(
            'action_user', 
            array(
                'code' => 'edit_users', 
                'text' => 'Изменение пользователей (кроме админов) | Edit users (except admins)', 
            )
        );  
    //}
    
    echo $br.'install access users = OK!';
    
    
    echo $br.'install user groups (add action user) = start';
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

    //if ($res === true){
        
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'admins', 
                'name' => 'Админы | Admins',
                'text' => 'Админы, есть права на всё | Admins, have rights to everything',
                'code_action_user' => 'action_all'
            )
        );
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'admins', 
                'name' => 'Админы | Admins',
                'text' => 'Админы, есть права на всё | Admins, have rights to everything',
                'code_action_user' => 'show_admin_panel'
            )
        );
        
        
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'content', 
                'name' => 'Контент | Content',
                'text' => 'Те кто изменяют контент сайта | Those who change the content of the site',
                'code_action_user' => 'show_admin_panel'
            )
        );
        
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'user_admin', 
                'name' => 'Админи по пользователям | Admin for users',
                'text' => 'Могут изменять только пользователей | Can change users', 
                'code_action_user' => 'edit_users'
            )
        );
        $db->insertDb(
            'access_group', 
            array(
                'code' => 'user_admin', 
                'name' => 'Админи по пользователям | Admin for users',
                'text' => 'Могут изменять только пользователей | Can change users', 
                'code_action_user' => 'show_admin_panel'
            )
        );
        
    //}
    echo $br.'install user groups = OK!';
    
    echo $br.'add users in user groups = start';
    // в этой таблице будут группы и относящиеся к ним пользователи
    $res = $db->createTable(
        'users_in_groups',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'code_group varchar(255)', 
            'id_user int', 
        )
    );
    
    //if ($res === true){
        
        $db->insertDb(
            'users_in_groups', 
            array(
                'code_group' => 'admins', 
                'id_user' => 1,
            )
        );
        
        $db->insertDb(
            'users_in_groups', 
            array(
                'code_group' => 'user_admin', 
                'id_user' => 2,
            )
        );
    //}    
    
    echo $br.'add users in user groups = OK';
    
    // общие свойства для пользователей
    echo $br.'install all users propertys = start';
    // таблица с общими свойствами (список общих свойств для всех пользователей)
    $res = $db->createTable(
        'create_all_users_property',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'name_property varchar(255)', 
            'type_property int', 
            'code varchar(255)',
        )
    );
    
    // типы общих свойств для пользователей
    $res = $db->createTable(
        'type_all_user_propertys',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'name_type varchar(255)', 
            'info varchar(255)',
            'code varchar(255)',
        )
    );
    
    $db->insertDb(
        'type_all_user_propertys', 
        array( 
            'name_type' => 'text', 
            'info' => 'input type text',
            'code' => 'text',
        )
    );
    
    // значения общего свойства типа текст 
    $res = $db->createTable(
        'value_all_user_propertys_text',
        array( 
            'id int PRIMARY KEY AUTO_INCREMENT', 
            'value varchar(255)', 
            'id_users int',  
            'id_property int',  
        )
    );

    echo $br.'install all users propertys = OK';
        
    echo $br.'install all modules db = start';
    
    // теперь установка частей БД относящихся к модулям
    $module = module::getInstance();
    $module->installBdAllModules();
    
    echo $br.'install all modules db = OK!';
    
    
    echo $br.'-----install gy core taldes db = OK!-----'.$br;
    
}else{
	echo '! Error. You need to run the script in the console';

}