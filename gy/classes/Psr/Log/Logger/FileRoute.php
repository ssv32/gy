<?php

namespace Psr\Log\Logger;

use Psr\Log\Logger\Route;

/**
 * Class FileRoute - роут который будет писать логи в файл
 */
class FileRoute extends Route
{
    public $filePath; // путь к файлу

    // шаблон сообщения
    public $template = "{date} {level} {message} {context}";

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        if (!file_exists($this->filePath))
        {
            touch($this->filePath);
        }
    }

    public function log($level, $message, array $context = array())
    {
        file_put_contents(
            $this->filePath, 
            trim(
                strtr(
                    $this->template, 
                    array(
                        '{date}' => $this->getDate(),
                        '{level}' => $level,
                        '{message}' => $message,
                        '{context}' => $this->contextStringify($context),
                    )
                )
            ).PHP_EOL, 
            FILE_APPEND
        );
    }
}