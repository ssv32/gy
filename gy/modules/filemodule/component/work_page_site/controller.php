<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$data = $_POST;

global $arRes;

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
    $app = new appFromConstructorPageComponent($app->urlProject);

    $url = $appGlobal->urlProject.((!empty($data['url-site-page']))? "/" : "").$data['url-site-page']."/index.php";
    
    include $url; // !! надо не подключать ядро

    $arRes['dataIncludeAllComponentsInThisPageSite'] = $app->getAllDataIncludeComponents();
    
    // хочу найти поля обьявленные в компоненте как возможные но не заполненные в коде
    foreach ($arRes['dataIncludeAllComponentsInThisPageSite'] as $key => $value) {
        if(!empty($value['componentInfo']['all-property'])){
            foreach ($value['componentInfo']['all-property'] as $key2 => $value2) {
                if(empty( $value['arParam'][$value2] )){
                    $arRes['dataIncludeAllComponentsInThisPageSite'][$key]['arParam'][$value2] = '';
                }
            }
        }
    }
    
    $arRes['url-site-page'] = $data['url-site-page'];
    
    // вернём как было
    $app = $appGlobal;
    $arRes['status'] = 'constructor';
}

function getCodePageByArrayComponents($arrayComponents){
    $codePage = '<? include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

global $app;

    ';
    
    // добавить коды компонентов
    if(is_array($arrayComponents)){
        foreach ($arrayComponents as $value) {
            $codeIncludeComponent = appFromConstructorPageComponent::getCodeIncludeComponent($value['component'], $value['tempalate'], $value['params']);
            $codePage .= $codeIncludeComponent."\n";   
        }
    }   
    return $codePage;
}

function savePageByArrayComponents($page, $arrayComponents){
    $codePage = getCodePageByArrayComponents($arrayComponents);
    
    global $app;
    $sitePage = new sitePages($app->urlProject.'/');
            
    $res = $sitePage->putContextPage( $page, $codePage);
    
    global $arRes;
    if($res !== false){
        $arRes['status'] = 'edit-ok';
    }else{
        $arRes['status'] = 'err';
    }
}

// сохранить всю страницу по компонентам
if(!empty($data['action-6'])){    
    savePageByArrayComponents($data['url-site-page'], $data['component']);
}

// перемещение компонента ниже
if(!empty($data['action7_2']) && is_array($data['action7_2'])){
    foreach ($data['action7_2'] as $key => $value) {
        //
    }
    
    if(!empty($data['component'][$key+1]) ){
        $temp = $data['component'][$key];
        $data['component'][$key] = $data['component'][$key+1];
        $data['component'][$key+1] = $temp;
        unset($temp);
    }
    
    // записать всё обратно из получившегося набора компонентов
    savePageByArrayComponents($data['url-site-page'], $data['component']);
                
}

// перемещение компонента выше
if(!empty($data['action7_1']) && is_array($data['action7_1'])){
    foreach ($data['action7_1'] as $key => $value) {
        //
    }
    
    if( ($key - 1) >= 0 ){
        $temp = $data['component'][$key];
        $data['component'][$key] = $data['component'][$key-1];
        $data['component'][$key-1] = $temp;
        unset($temp);
    }
    
    // записать всё обратно из получившегося набора компонентов
    savePageByArrayComponents($data['url-site-page'], $data['component']);
}

// удалить компонент
if(!empty($data['action7_3']) && is_array($data['action7_3'])){
    foreach ($data['action7_3'] as $key => $value) {
        //
    }
    
    if( !empty($data['component'][$key])){
        unset($data['component'][$key]);
    }
    
    // записать всё обратно из получившегося набора компонентов
    savePageByArrayComponents($data['url-site-page'], $data['component']);
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
