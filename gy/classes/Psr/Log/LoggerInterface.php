<?php

namespace Psr\Log;

/**
 * LoggerInterface - описывает экземпляр логгера
 */
interface LoggerInterface
{
    /**
     * Система не работает
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function emergency($message, array $context = array());

    /**
     * Требуется немедленные действия
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function alert($message, array $context = array());

    /**
     * Критическая ситуация.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function critical($message, array $context = array());

    /**
     * Ошибка на стадии выполнения, не требующая немедленных действий,
     * но требующая быть залогированной и дальнейшего изучения
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function error($message, array $context = array());

    /**
     * Исключительные случаи, которые не являются ошибками

     * @param string $message
     * @param array $context
     * @return void
     */
    public function warning($message, array $context = array());

    /**
     * Нормальные события в работе приложения, но значимые и требуют логирования
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function notice($message, array $context = array());

    /**
     * Полезные значимые события
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function info($message, array $context = array());

    /**
     * Подробная отладочная информация
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public function debug($message, array $context = array());

    /**
     * Логи с произвольным уровнем
     *   В переменную $log передается нужный уровень логирования
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = array());
}
