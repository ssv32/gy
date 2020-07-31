<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/** 
 * security - класс с методами для обеспечения безопасности gy framework
 * class work security 
 */

class security{
    
    /**
     * filterInputData 
     *  - фильтр входных данных, в присланных данных уберёт лишнее
     * 
     * @param array/string $data - потенциально с вредоносом
     * @return array/string - с большей частью вырезанным вредоносом
     */
    public static function filterInputData($data){
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $data[$key] = self::filterInputData($value);
            }
        }else{
            return self::clearValue($data);
        }
        return $data;
    }
    
    
    /**
     * clearValue 
     *  - обработать одно значение, что бы лишнее не прошло
     *  (если передадут случайно массив то тоже отработает)
     * 
     * @param string $value
     * @return string
     */
    private static function clearValue($value){
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);   
        return $value;
    }

    
}
    

