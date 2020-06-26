<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/**
 * classsitePages - класс для работы со страницами сайта
 */
class sitePages{
    
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

    public function __construct($urlProject){
        if(file_exists($urlProject)){
            $this->urlProject = $urlProject;
            return true;
        }else{
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
    public function createSitePage($urlPage){
        if($this->urlProject !== false){
            // если нет директории создать её
            if(file_exists($this->urlProject.$urlPage.'/') === false){ // TODO вынести в класс files
                mkdir($this->urlProject.$urlPage.'/', 0755, true);   
            }            
            return files::createFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite);
        }else{
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
    public function deleteSitePage($urlPage){
        if($this->urlProject !== false){
            $res = files::deleteFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite);
            
            // если файлов не осталось удалить директорию // TODO вынести в класс files
            if($res !== false){
                if( count(scandir($this->urlProject.$urlPage.'/')) == 2 ){  // 2ва т.е. . и .. в разделе всегда есть
                    rmdir( $this->urlProject.$urlPage.'/' );
                }
            }
            
            return $res;
        }else{
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
    public function getContextPage($urlPage){
        if($this->urlProject !== false){
            return files::getContentFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite);
        }else{
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
    public function putContextPage($urlPage, $date){
        if($this->urlProject !== false){
            return files::saveFile($this->urlProject.$urlPage.'/'.$this->nameFilePageSite, $date);
        }else{
            return false;
        }
    }
    
}