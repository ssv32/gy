<?php // языковой файл для componentInfo.php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$mess['rus'] = array(
    'text-info' => 'Новости',
    'property-container-data-id' => 'Id контейнера данных',
    'property-container-data-code' => 'code контейнера данных',
    'cacheTime' => 'Время кеширования', 
    'count-news-in-1-page' => 'Количество новостей на одной странице',
    'show-pagination' => 'Показать пагинацию (1\0), если 0 покажет все', 
    'show-property-news' => 'Массив с кодами свойств новостей какие надо вывести', 
    'show-in-url-code' => 'Сделать url на детальную страницу с кодом новости (1 - да, 0 -нет)',
    'this-url-dir' => 'раздел сайта где выводятся новости (нужен для чпу)',
    'show-detail-url' => 'показать ссылку, на детальную страницу новости в виде ссылки с get параметром  (1 \ 0) (+ нужно заполнить detail-url-property)', 
    'detail-url-property' => 'названия параметра куда указывать код новости (+нужно заполнить show-detail-url )',
);

$mess['eng'] = array(
    'text-info' => 'news',
    'property-container-data-id' => 'Data container id',
    'property-container-data-code' => 'Data container code',
    'cacheTime' => 'Caching time', 
    'count-news-in-1-page' => 'Number of news items on one page',
    'show-pagination' => 'show pagination (1\0), if 0 will show all', 
    'show-property-news' => 'Array with codes of news properties which need to be output', 
    'show-in-url-code' => 'Create a url to a detailed page with the news code (1\0)',
    'this-url-dir' => 'site dir news',
    'show-detail-url' => 'show a link to the detailed page of the news as a link with a get parameter (1 \ 0) (+ you need to fill in detail-url-property)', 
    'detail-url-property' => 'parameter names where to indicate the news code (+you need to fill in show-detail-url )',
);