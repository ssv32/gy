<? // TODO сделать нормальнопо шагам потом
include "../../gy/gy.php"; // подключить ядро // include core

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
        'groups int'
    )
);        

if ($res === true){
	echo '<br/>install table - user - OK';
	
	echo '<br/>add admin ...';
    
    $res = $db->insertDb(
        'users', 
        array(
            'login' => 'admin', 
            'name' => 'admin', 
            'pass' =>   'admin', 
            'groups' => 1
        )
    );

    $res = $db->insertDb(
        'users', 
        array(
            'login' => 'asd', 
            'name' => 'asd', 
            'pass' =>  'asdasd', 
            'groups' => 2
        )
    );
    	
	var_dump($res);
	print_r($res);
	
	if($res === true){
		echo '<br/>add admin - OK';
	}else{
		echo '<br/>add admin - NOT!';
	}
	
}else{
	echo '<br/>install table - user - NOT!';
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
    )
); 

$res = $db->insertDb(
    'types_property_info_box', 
    array(
        'name' => 'html', 
        'code' =>   'html', 
        'info' => 'property save date - html'
        //'id_type_property' => 1
    )
);

$res = $db->insertDb(
    'types_property_info_box', 
    array(
        'name' => 'number', 
        'code' =>   'number', 
        'info' => 'property save date - number'
        //'id_type_property' => 1
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

//-infoBox-------------
