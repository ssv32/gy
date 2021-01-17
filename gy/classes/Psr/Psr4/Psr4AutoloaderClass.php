<?php

namespace Psr\Psr4;

/**
 * Psr4AutoloaderClass
 *  - книверсальная реализация Psr4
 */
class Psr4AutoloaderClass
{

    // массив соотнощения пространств имён/префиксов и реальных путей на диске
    protected $arPrefixes = array();

    /**
     * register()
     *  - регистрирует авто загрузчик
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * addNamespace()
     *   -  добавляет префикс пространства имён и реальный ауть в $arPrefixes
     *
     * @param string $prefixName - префикс пространства имён
     * @param string $prefixDir - директория на сервере
     * @param bool $flagFirstAddPrefix - флаг покажит что префикс надо добавить вначало
     */
    public function addNamespace($prefixName, $prefixDir, $flagFirstAddPrefix = false)
    {
        $prefixName = trim($prefixName, '\\') . '\\';
        $prefixDir = rtrim($prefixDir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        if (isset($this->arPrefixes[$prefixName]) === false) {
            $this->arPrefixes[$prefixName] = array();
        }
        if ($flagFirstAddPrefix) {
            array_unshift($this->arPrefixes[$prefixName], $prefixDir);
        } else {
            array_push($this->arPrefixes[$prefixName], $prefixDir);
        }
    }

    /**
     * loadClass()
     *   - загружает файл класса
     *
     * @param string $className - имя класса
     * @return string/false
     */
    public function loadClass($className)
    {
        $prefixName = $className;
        while (false !== $posStr = strrpos($prefixName, '\\')) {
            
            $prefixName = substr($className, 0, $posStr + 1);
            $relativeСlass = substr($className, $posStr + 1);
            $mappedFile = $this->loadMappedFile($prefixName, $relativeСlass);
            if ($mappedFile) {
                return $mappedFile;
            }
            $prefixName = rtrim($prefixName, '\\');   
        }
        return false;
    }
    
    /**
     * loadMappedFile 
     *   - загружает файл в зависимости от префикса и имени класса
     * 
     * @param string $prefixName - имё префикса
     * @param string $relativeClass - относительное имя класса
     * @return string/false
     */
    protected function loadMappedFile($prefixName, $relativeClass)
    {
        if (isset($this->arPrefixes[$prefixName]) === false) {
            return false;
        }  
        foreach ($this->arPrefixes[$prefixName] as $prefixDir) {
            $urlFileClass = $prefixDir.str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass).'.php';
            if ($this->requireFile($urlFileClass)) {
                return $urlFileClass;
            }
        }
        return false;
    }
    
    /**
     * requireFile()
     *   - загружеаем файл класса если он есть
     * 
     * @param string $urlFileClass - путь к файлу класса
     * @return bool
     */
    protected function requireFile($urlFileClass)
    {
        if (file_exists($urlFileClass)) {
            require_once $urlFileClass;
            return true;
        }
        return false;
    }
}