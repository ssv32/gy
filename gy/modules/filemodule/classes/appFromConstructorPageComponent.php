<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class appFromConstructorPageComponent{
    
    private $allDateIncludeComponents = array();
    private $intKey = 0;
    
    public function component($name, $template, $arParam  ){
        
        $this->allDateIncludeComponents[$this->intKey] = array(
            'name' => $name,
            'template' => $template,
            'arParam' => $arParam
        ); 
         
        $this->intKey++;
    }
    
    public function getAllDataIncludeComponents(){
        return $this->allDateIncludeComponents;
    }
}