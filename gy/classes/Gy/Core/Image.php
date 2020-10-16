<?php

namespace Gy\Core;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

/* Image class work with image // wrapper class php GD
 * Image класс для работы с изображениями // обёртка класса php GD
 */
class Image
{

    /** 
     * imageResized function compression image (jpeg)
     * imageResized - сжимает изображения (поддерживает пока jpeg)
     * @param string $urlImgIn - ссылка на изображение которое нужно сжать // url input image
     * @param string $urlImageOut - ссылка куда сохранить изображение // url save image
     * @param int $compression - сжатие (0-100) 100 - это наилучшее качество // compression (0-100) 100 max quality
     * @return bool true or false
     */
    public static function imageResized($urlImgIn, $urlImageOut, $compression)
    {
        $result = false;
        $arImg = getimagesize($urlImgIn);
        if ($arImg[2] == 2) {// jpeg ли это ? // if jpeg image
            $img = imageCreateFromJpeg($urlImgIn);// загрузить изображение сжимаемое // loading Image
            $img2 = imageCreateTrueColor($arImg[0], $arImg[1] ); // создать изображение для сохранение с тем же разрешением // create out image 
            imageCopyResampled($img2, $img, 0, 0, 0, 0, $arImg[0], $arImg[1], $arImg[0], $arImg[1]); 
            imageJpeg($img2, $urlImageOut, $compression); // сохраняем // save out image
            imageDestroy($img2); // очищаем память // clear memory
            $result = true;
        }
        return $result;
    }

}
