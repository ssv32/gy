<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

/**
 * SitePages - класс для работы со страницами сайта
 */
class SitePages
{

    /**
     * разделы в которых нельзя редактировать страницы
     * @var array
     */
    private $notEditPages = array(
        '/gy/',
        '/customDir/'
    );

    /**
     * имя файла страницы сайта
     * @var string 
     */
    private $nameFilePageSite = 'index.php';

    /**
     * путь до проекта
     * @var string/false (false - пока не определён)
     */
    private $urlProject = false;

    /**
     * - текст ошибки
     * @var false/string - (false - нет ошибок, или текст ошибки)
     */
    public $err = false;

    public function __construct($urlProject)
    {
        if (file_exists($urlProject)) {
            $this->urlProject = $urlProject;
            return true;
        } else {
            return false;
        }
    }

    /**
     * createSitePage
     *  - создать страницу сайта (пустую)
     * 
     * @param string $urlPage - путь к файлу (до раздела без index.php)
     * @return boolean
     */
    public function createSitePage($urlPage)
    {
        if (($this->urlProject !== false) && $this->checkUrl('/'.$urlPage.'/')) {
            // если нет директории создать её
            if (file_exists($this->urlProject.$urlPage.'/') === false) { // TODO вынести в класс files
                mkdir($this->urlProject.$urlPage.'/', 0755, true);
            }            
            return Files::createFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite);
        } else {
            return false;
        }
    }

    /**
     * deleteSitePage
     *  - удалить страницу сайта
     * 
     * @param string $urlPage - путь к файлу (до раздела без index.php)
     * @return boolean
     */
    public function deleteSitePage($urlPage)
    {
        if (($this->urlProject !== false) && $this->checkUrl('/'.$urlPage.'/')) {
            $res = Files::deleteFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite);

            // если файлов не осталось удалить директорию // TODO вынести в класс files
            if ($res !== false) {
                if (count(scandir($this->urlProject.$urlPage.'/')) == 2) {  // 2ва т.е. . и .. в разделе всегда есть
                    rmdir( $this->urlProject.$urlPage.'/' );
                }
            }

            return $res;
        } else {
            return false;
        }
    }

    /**
     * getContextPage 
     *  - получить содержимое страницы, просто в виде текста
     * 
     * @param string $urlPage - путь к файлу (до раздела без index.php)
     * @return false/string
     */
    public function getContextPage($urlPage)
    {
        if (($this->urlProject !== false) &&  $this->checkUrl('/'.$urlPage.'/')) {
            return Files::getContentFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite);
        } else {
            return false;
        }
    }

    /**
     * putContextPage 
     *  - сохранить на страницу текст
     * 
     * @param string $urlPage - путь к файлу (до раздела без index.php)
     * @param string $date - содержимое страницы
     * @return boolean
     */
    public function putContextPage($urlPage, $date)
    {
        if (($this->urlProject !== false) && $this->checkUrl('/'.$urlPage.'/')) {
            return Files::saveFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite, $date);
        } else {
            return false;
        }
    }

    /**
     * checkUrl
     *  - проверит можно ли работать с урлом
     * 
     * @param string $url
     * @return boolean
     */
    private function checkUrl($url)
    {
        $result = true;
        foreach ($this->notEditPages as $value) {
            if (strripos($url, $value) !== false) {
                $result = false;
            }
        }
        return $result;
    }

}