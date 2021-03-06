<?php 

namespace Gy\Core;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

/**
 * class Capcha - для работы с капчей
 */
class Capcha
{

    // символы которые будут в капче
    //private static $letters = 'abcdefghijklmnopqrstuvwxyzABCDRFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //  убрал ноль и буквы о, что бы не было путаниц
    private static $letters = 'aAbBcCdDeEfFgG1hHiI2jJkK3lLm4MnN5p6PqQr7RsSt8TuUv9VwWxXyYzZ';
    
    private $count = 5; // количество символов
    private $code = 5; // код капчи
    private $urlFonts; // путь до шрифта (шрифт нужен что бы поворачивать буквы)
    public static $defaultUrlFonts = "/fonts/18018.otf"; //
    
    public function __construct($urlFonts = false)
    {
        $this->urlFonts = $urlFonts;

        $oldCodeCapcha = self::getCapchaValue();
        if (!empty($oldCodeCapcha)) {
            $this->code = $oldCodeCapcha;
        } else {
            $this->setCapchaValue( self::getRandLetters($this->count) );
        }
        
    }

    /**
     * createNewCapchaData
     *  - сгенерирует новые символы и сохранит
     * 
     */
    public function createNewCapchaData()
    {
        $this->setCapchaValue( self::getRandLetters($this->count) );
    }
    
    /**
     * clearCapcha - очистить текущий код капчи
     */
    public static function clearCapcha()
    {
        unset($_SESSION['capcha']);
    }

    /**
     * chackCapcha - проверить код с установленным кодом в капче
     * @param string $code
     * @return boolean
     */
    public function chackCapcha( $code)
    {       
        $arResult = false;
        // проверит код с капчи
        // всё приводится к верхнему регистру что бы пользователю проще 
        //     было угадать капчу
        
        if ($_SESSION['capcha'] == mb_strtoupper($code)) { 
            $arResult = true;
        }
        self::clearCapcha();
        
        if ($arResult === false) {
            // если проверка капчи не прошла то сгенерить новый код капчи
            $this->createNewCapchaData();
        }
        
        return $arResult;
    }

    /**
     * setCapchaValue - установить код капчи
     * @param type $value
     */
    private function setCapchaValue($value)
    {       
        // задать код в классе
        $this->code = $value;

        // записать в сессию значение
        $_SESSION['capcha'] = mb_strtoupper($this->code);
        
    }

    /**
     * getCapchaValue
     *  - получить код капчи из сессии 
     * 
     * @return string
     */
    private function getCapchaValue()
    {
        return $_SESSION['capcha']; 
    }
    
    /**
     * getImageCapcha - вызовет createImageCapcha с нужным кодом
     * это всё чтобы нарисовать картинку капчи
     */
    public function getImageCapcha()
    {
        // задаст стандартные настройки и вызовет createImageCapcha для определённого кода
        $this->createImageCapcha($this->code);
    }

    /**
     * createImageCapcha - нарисовать картинку капчи по заданному коду
     * @param string $code
     */
    private function createImageCapcha($code)
    {

        // постоянные ширина и высота
        $gX = 100;
        $gY = 50;

        ob_clean(); // очистить вывод до этого момента
        header ("Content-type: image/png");
        $img = imagecreatetruecolor($gX, $gY);

        // определяем белый цвет
        $white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);

        // делаем фон белым
        imagefill($img, 1, 1, $white);

        // нарисовать шум (рендомной длинны в рендомные стороны)
        $j = rand(5, 10);
        for ($i = 0; $i < $j; $i++) {
            
            // произвольно задать цвет
            $r = rand(50, 230);
            $g = rand(50, 230);
            $b = rand(50, 230);
            $textColor = imagecolorallocate($img, $r, $g, $b);
            
            // Рисуем линию
            $x1 = rand(0, $gX);
            $x2 = rand(0, $gX);
            $y1 = rand(0, $gY);
            $y2 = rand(0, $gY);
            
            imageline($img, $x1, $y1, $x2, $y2, $textColor);
        }

        // рисуется код капчи
        for ($i = 0; $i < strlen($code); $i++) {
            
            // произвольно задать цвет
            $r = rand(50, 230);
            $g = rand(50, 230);
            $b = rand(50, 230);
            $textColor = imagecolorallocate($img, $r, $g, $b);

            $font = rand(5, 7); // размер шрифта

            $j = rand(0,1);
            if ($j == 0) {
                $y = sin($i)*10;
            } else {
                $y = cos($i)*10;
            }

            $x = rand(3, 10);

            if ($this->urlFonts == false) {
                // если не задан шрифт то будет штатным рисоваться но без поворота букв
                imagestring($img, $font, $x+($i*20), 10+$y,  $code[$i], $textColor);
                imagestring($img, $font, $x+1+($i*20), 11+$y,  $code[$i], $textColor);
            } else {
                // иначе заданным шрифтом рисует с поворотом букв
                $a = 30 - rand(0, 60); // угол от -30 до 30
                imagettftext($img, $font*3, $a, $x+($i*20), 30+$y, $textColor, $this->urlFonts, $code[$i]);
                imagettftext($img, $font*3, $a, $x+1+($i*20), 31+$y, $textColor, $this->urlFonts, $code[$i]);
            }
        }

        imagepng($img);
        imagedestroy($img);
        die(); // что бы не было вывода после
    }

    /**
     * getRandLetters - получить рендомный набор символов, указанной длинны
     * @param int $count
     * @return string
     */
    public function getRandLetters($count)
    {
        $randLetters = '';
        for ($i = 0; $i < $count; $i++) {
            $randLetters .= self::getRandLetter();
        }
        return $randLetters;
    }

    /**
     * getRandLetter - получить произвольный символ из заданного набора символов self::$arrayLetters
     * @return type
     */
    private function getRandLetter()
    {
        $countLetters = strlen(self::$letters);
        $randLetter = rand(0, ($countLetters-1) );
        return substr(self::$letters, $randLetter, 1);
    }

}