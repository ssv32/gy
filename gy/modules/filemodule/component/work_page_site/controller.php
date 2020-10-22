<?php 

use Gy\Modules\filemodule\Classes\AppFromConstructorPageComponent;
use Gy\Modules\filemodule\Classes\SitePages;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$data = $_POST;

global $arRes;

// создание страницы сайта
if (!empty($data['action-1'])) {
    
    global $APP;
    $sitePage = new SitePages($APP->urlProject.'/');

    $res = $sitePage->createSitePage($data['url-site-page']);
    
    if ($res !== false) {
        $arRes['status'] = 'add-ok';
    } else {
        $arRes['status'] = 'err';
    }
}

// удаление страницы
if (!empty($data['action-3']) && empty($arRes['status'])) {

    global $APP;
    $sitePage = new SitePages($APP->urlProject.'/');

    $res = $sitePage->deleteSitePage($data['url-site-page']);

    if ($res !== false) {
        $arRes['status'] = 'del-ok';
    } else {
        $arRes['status'] = 'err';
    }
}

// изменение страницы
if (!empty($data['action-2']) && empty($arRes['status'])) {

    global $APP;
    $sitePage = new SitePages($APP->urlProject.'/');

    $res = $sitePage->getContextPage($data['url-site-page']);

    if ($res !== false) {
        $arRes['data-file'] = $res;
        $arRes['url-site-page'] = $data['url-site-page'];
        $arRes['status'] = 'edit';
    } else {
        $arRes['status'] = 'err';
    }
}

// изменение файла
if (!empty($data['action-2-1']) && !empty($data['url-site-page']) && !empty($data['new-text-page'])) {
    global $APP;
    $sitePage = new SitePages($APP->urlProject.'/');

    $res = $sitePage->putContextPage($data['url-site-page'], $data['new-text-page']);
    if ($res !== false) {
        $arRes['status'] = 'edit-ok';
    } else {
        $arRes['status'] = 'err';
    }
}

// открыть редактируемую страницу
if (!empty($data['action-4'])) {
    header("Location: /".$data['url-site-page'] );
}

if (!empty($data['action-5'])) {
    // сохраним основной app обьект
    global $APP;
    $APPGlobal = $APP;

    // переопределим app
    $APP = new AppFromConstructorPageComponent($APP->urlProject, $APP->options );

    $url = $APPGlobal->urlProject.((!empty($data['url-site-page']))? "/" : "").$data['url-site-page']."/index.php";

    include $url; // !! надо не подключать ядро

    $arRes['dataIncludeAllComponentsInThisPageSite'] = $APP->getAllDataIncludeComponents();
    
    // хочу найти поля обьявленные в компоненте как возможные но не заполненные в коде
    foreach ($arRes['dataIncludeAllComponentsInThisPageSite'] as $key => $value) {
        if (!empty($value['componentInfo']['all-property'])) {
            foreach ($value['componentInfo']['all-property'] as $key2 => $value2) {
                if (empty($value['arParam'][$value2])) {
                    $arRes['dataIncludeAllComponentsInThisPageSite'][$key]['arParam'][$value2] = '';
                }
            }
        }
    }

    $arRes['url-site-page'] = $data['url-site-page'];

    // вернём как было
    $APP = $APPGlobal;
    unset($APPGlobal);
    $arRes['status'] = 'constructor';
}

function getCodePageByArrayComponents($arrayComponents){
    $codePage = '<?php include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

global $APP;

    ';

    // добавить коды компонентов
    if (is_array($arrayComponents)) {
        foreach ($arrayComponents as $value) {
            $codeIncludeComponent = AppFromConstructorPageComponent::getCodeIncludeComponent($value['component'], $value['tempalate'], $value['params']);
            $codePage .= $codeIncludeComponent."\n";   
        }
    }
    return $codePage;
}

function savePageByArrayComponents($page, $arrayComponents){
    $codePage = getCodePageByArrayComponents($arrayComponents);

    global $APP;
    $sitePage = new SitePages($APP->urlProject.'/');

    $res = $sitePage->putContextPage( $page, $codePage);

    global $arRes;
    if ($res !== false) {
        $arRes['status'] = 'edit-ok';
    } else {
        $arRes['status'] = 'err';
    }
}

// сохранить всю страницу по компонентам
if (!empty($data['action-6'])) {    
    savePageByArrayComponents($data['url-site-page'], $data['component']);
}

// перемещение компонента ниже
if (!empty($data['action7_2']) && is_array($data['action7_2'])) {
    foreach ($data['action7_2'] as $key => $value) {
        //
    }

    if (!empty($data['component'][$key+1])) {
        $temp = $data['component'][$key];
        $data['component'][$key] = $data['component'][$key+1];
        $data['component'][$key+1] = $temp;
        unset($temp);
    }

    // записать всё обратно из получившегося набора компонентов
    savePageByArrayComponents($data['url-site-page'], $data['component']);

}

// перемещение компонента выше
if (!empty($data['action7_1']) && is_array($data['action7_1'])) {
    foreach ($data['action7_1'] as $key => $value) {
        //
    }

    if (($key - 1) >= 0) {
        $temp = $data['component'][$key];
        $data['component'][$key] = $data['component'][$key-1];
        $data['component'][$key-1] = $temp;
        unset($temp);
    }

    // записать всё обратно из получившегося набора компонентов
    savePageByArrayComponents($data['url-site-page'], $data['component']);
}

// удалить компонент
if (!empty($data['action7_3']) && is_array($data['action7_3'])) {
    foreach ($data['action7_3'] as $key => $value) {
        //
    }

    if (!empty($data['component'][$key])) {
        unset($data['component'][$key]);
    }
    
    // записать всё обратно из получившегося набора компонентов
    savePageByArrayComponents($data['url-site-page'], $data['component']);
}

// добавление компонента
if (!empty($data['action_8']) && is_array($data['action_8'])) {
    foreach ($data['action_8'] as $key => $value) {
        //
    }

    $arRes['status'] = 'addConstructor';
    $arRes['url-site-page'] = $data['url-site-page'];
    $arRes['key'] = $key; // где вставлять компонент в какую позицию

}

// первый шаг добавления компонента
if (!empty($data['action_8_1'])) {
    
    if (
        !empty($data['url-site-page'])
        && (!empty($data['position_new_component']) || ($data['position_new_component'] == 0) )
        && !empty($data['name_new_component'])
    ) {
    
        // шаблон по умолчанию 0
        if (empty($data['name_new_template'])) {
            $data['name_new_template'] = '0';
        }

        global $APP;

        // проверим есть ли такой компонент (точнее файл информации о нём)
        $dataComponent = AppFromConstructorPageComponent::getInfoAboutComponent(
            $data['name_new_component'], 
            $data['name_new_template'],
            array(),
            $APP->urlProject
        );

        if (!empty($dataComponent)) {
            $arRes['status'] = 'good-component';

            $arRes['url-site-page'] = $data['url-site-page'];
            $arRes['position_new_component'] = $data['position_new_component'];

            $arRes['data-component'] = array(
                'name' => $data['name_new_component'],
                'template' => $data['name_new_template'],
                'arParam' => $dataComponent['all-property'],
                'componentInfo' => $dataComponent
            );
        } else {
            $arRes['status'] = 'error-not-component';
        }
    } else {
        $arRes['status'] = 'error-not-component';
    }
}

// надо добавить новый компонент на выбранную страницу
if( !empty($data['action_8_2']) 
    && !empty($data['url-site-page'])
    && (!empty($data['position_new_component']) || ($data['position_new_component'] == 0) )
    && !empty($data['name_new_component'])
    && (!empty($data['name_new_template']) || ($data['name_new_template'] == 0) )
) {
    // надо взять все компоненты с редактируемой страницы

    // сохраним основной app обьект
    global $APP;
    $APPGlobal = $APP;

    // переопределим app
    $APP = new AppFromConstructorPageComponent($APP->urlProject, $APP->options );

    $url = $APPGlobal->urlProject.((!empty($data['url-site-page']))? "/" : "").$data['url-site-page']."/index.php";

    include $url; // !! надо не подключать ядро

    $allComponentsThisPage = $APP->getAllDataIncludeComponents();
    // вернём как было
    $APP = $APPGlobal;
    unset($APPGlobal);

    $newArrayComponents = array();

    if ($data['position_new_component'] == "'-1'") {
        $newArrayComponents[] = array(
            'name' => $data['name_new_component'],
            'template' => $data['name_new_template'],
            'arParam' => $data['params']
        );
        foreach ($allComponentsThisPage as $value) {
            $newArrayComponents[] = $value;
        }
    } elseif (is_numeric($data['position_new_component'])) {
        $data['position_new_component']++;
        $flagAdd = false;
        foreach ($allComponentsThisPage as $key => $value) {
            if ($data['position_new_component'] == $key) {
                $newArrayComponents[] =  array(
                    'name' => $data['name_new_component'],
                    'template' => $data['name_new_template'],
                    'arParam' => $data['params']
                );
                $flagAdd  = true;
            }
            $newArrayComponents[] = $value;
        }
        if (!$flagAdd) {
            $newArrayComponents[] =  array(
                'name' => $data['name_new_component'],
                'template' => $data['name_new_template'],
                'arParam' => $data['params']
            );
        }
    }
    unset($allComponentsThisPage);
        
    // правильно подготовить массив с компонентами 
    $trueNewArrayComponents = array();
    foreach ($newArrayComponents as $value) {
        $trueNewArrayComponents[] = array(
            'component' => $value['name'],
            'tempalate' => $value['template'],
            'params' => $value['arParam']
        );
    }

    // сохранить всё на страницу
    savePageByArrayComponents($data['url-site-page'], $trueNewArrayComponents);

}

// показать шаблон
$this->template->show($arRes, $this->arParam);
