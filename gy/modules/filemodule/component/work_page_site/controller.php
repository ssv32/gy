<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$data = $_POST;

// создание страницы сайта
if( !empty($data['action-1']) ){
    
    global $app;
    $sitePage = new sitePages($app->urlProject.'/');
        
    $res = $sitePage->createSitePage($data['url-site-page']);
    
    if($res !== false){
        $arRes['status'] = 'add-ok';
    }else{
        $arRes['status'] = 'err';
    }
}

// удаление страницы
if( !empty($data['action-3']) && empty($arRes['status']) ){
    
    global $app;
    $sitePage = new sitePages($app->urlProject.'/');
        
    $res = $sitePage->deleteSitePage($data['url-site-page']);
    
    if($res !== false){
        $arRes['status'] = 'del-ok';
    }else{
        $arRes['status'] = 'err';
    }
}

// изменение страницы
if( !empty($data['action-2']) && empty($arRes['status']) ){
    
    global $app;
    $sitePage = new sitePages($app->urlProject.'/');
            
    $res = $sitePage->getContextPage($data['url-site-page']);
    
    if($res !== false){
        $arRes['data-file'] = $res;
        $arRes['url-site-page'] = $data['url-site-page'];
        $arRes['status'] = 'edit';
    }else{
        $arRes['status'] = 'err';
    }
}

// изменение файла
if( !empty($data['action-2-1'])  && !empty($data['url-site-page'])  && !empty($data['new-text-page']) ){
    global $app;
    $sitePage = new sitePages($app->urlProject.'/');
        
    $res = $sitePage->putContextPage($data['url-site-page'], $data['new-text-page']);
    if($res !== false){
        $arRes['status'] = 'edit-ok';
    }else{
        $arRes['status'] = 'err';
    }
}

// открыть редактируемую страницу
if( !empty($data['action-4']) ){
    header("Location: /".$data['url-site-page'] );
}

if( !empty($data['action-5']) ){
    // сохраним основной app обьект
    global $app;
    $appGlobal = $app;
    
    // переопределим app
    $app = new appFromConstructorPageComponent();

    $url = $appGlobal->urlProject.((!empty($data['url-site-page']))? "/" : "").$data['url-site-page']."/index.php";
    
    include $url; // !! надо не подключать ядро

    $arRes['dataIncludeAllComponentsInThisPageSite'] = $app->getAllDataIncludeComponents();
    $arRes['url-site-page'] = $data['url-site-page'];
    
    // вернём как было
    $app = $appGlobal;
    $arRes['status'] = 'constructor';
}

// сохранить всю страницу по компонентам
if(!empty($data['action-6'])){
    $codePage = '<? include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

global $app;

    ';
            
    // добавить коды компонентов
    foreach ($data['component'] as $value) {
        $codeIncludeComponent = appFromConstructorPageComponent::getCodeIncludeComponent($value['component'], $value['tempalate'], $value['params']);
        $codePage .= $codeIncludeComponent."\n";   
    }
        
    global $app;
    $sitePage = new sitePages($app->urlProject.'/');
            
    $res = $sitePage->putContextPage( $data['url-site-page'], $codePage);
    if($res !== false){
        $arRes['status'] = 'edit-ok';
    }else{
        $arRes['status'] = 'err';
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
