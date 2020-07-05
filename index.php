<? include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

$app->component(
    'admin-button-public-site',
    '0',
    array()
);

$app->component(
    'includeHtml',
    '0',
    array(
        'html' => '<h1>Пример использования gy CMS/framework</h1>'
    )
);

// пример вызова одинаковых компонентов // example run two component 
$app->component(
    'includeHtml',
    '0',
    array(
        'html' => '<h4>Вызов компонента "form_auth_test" (1 раз)</h4>'
    )
);

$app->component(
    'form_auth_test',
    '0',
    array( 
        'test' => 'asd',
        'idComponent' => 1,
    )
);

 // пример вызова одинаковых компонентов // example run two component 
$app->component(
    'includeHtml',
    '0',
    array(
        'html' => '<h4>Вызов компонента "form_auth_test" (2 раз)</h4>'
    )
);

$app->component(
    'form_auth_test',
    '0',
    array( 
        'test' => 'asd2',
        'idComponent' => 2,
    )
);

/**
пример вызова компонента с выводом контента,
  + пример использования кастомного (пользовательского) шаблона компонента
  (пользователя - разработчика использующего gy)
*/
$app->component(
    'containerdata_element_show',
    '0',
    array( 
        'container-data-code' => 'Content',
        'element-code' => 'html-index-page',
        'cacheTime' => 86400 // закешить на 24 ч.
    )
);

    
    
    

