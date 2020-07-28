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
    
    /**
     * getCodeIncludeComponent
     *  - сделать php код вызова коппонента из переданных параметров
     * 
     * @param string $componentName
     * @param string $templateName
     * @param array $arParams
     * @return string
     */
    public static function getCodeIncludeComponent($componentName, $templateName, $arParams){
        
        $codeIncludeComponent = "\n".'$app->component('."\n";
        $codeIncludeComponent .= "   '".$componentName."',"."\n";
        $codeIncludeComponent .= "   '".$templateName."',"."\n";
        $codeIncludeComponent .= '   array('."\n";
        foreach ($arParams as $key => $value) {
            if(!is_numeric($value)){
                $codeIncludeComponent .= "     '".$key."' => '".$value."',"."\n";
            }else{
                $codeIncludeComponent .= "     '".$key."' => ".$value.",\n";
            }
        }
        $codeIncludeComponent .= '   )'."\n";
        
        $codeIncludeComponent .= ');'."\n";
        
        return $codeIncludeComponent;
    }
    
}