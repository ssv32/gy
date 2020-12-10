<?php

namespace Psr\Log\Logger;

use DateTime;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Route - базовый класс роута
 */
abstract class Route extends AbstractLogger implements LoggerInterface
{
    public $isEnable = true; // включен ли роут
    public $dateFormat = DateTime::RFC2822; // Формат даты логов

    public function __construct(array $attributes = array())
    {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    /**
     * getDate()
     *   - текущая дата
     *
     * @return string
     */
    public function getDate()
    {
        return (new DateTime())->format($this->dateFormat);
    }

    /**
     * contextStringify()
     *   - преобразование $context в строку
     *
     * @param array $context
     * @return string
     */
    public function contextStringify(array $context = array())
    {
        return !empty($context) ? json_encode($context) : null;
    }
}