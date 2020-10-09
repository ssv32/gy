<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

// контроллер компонента form_auth_test (форма авторизации)

// подключить модель // include model this component
if (isset($this->model)) {
    $this->model->includeModel();
}

// были доступны параметры
//echo '$arParam<pre>'; print_r($this->arParam); echo '</pre>';

// если задан параметр idComponent значит сверить с пришедшим
$isChackIdComponent = ( empty($this->arParam['idComponent'])
    || (!empty($this->arParam['idComponent']) && !empty($_REQUEST['idComponent']) && ($this->arParam['idComponent'] == $_REQUEST['idComponent']) )
);

// $model - теоретически должно быть тут доступно
if ($isChackIdComponent && !empty($_REQUEST['auth'])) {
    $arRes["auth_ok"] = 'ok';
    $arRes["auth_user"] = $_REQUEST['auth'].' '.model_setAuth($_REQUEST['auth']);
} else {
    $arRes["auth"] = "auth";
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
