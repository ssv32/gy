<?php
 
namespace Psr\Log\Logger;

use SplObjectStorage;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Logger - базовый класс Logger
 */
class Logger extends AbstractLogger implements LoggerInterface
{

    public $routes; // список роутов (обьектов класса Route)

    public function __construct()
    {
        $this->routes = new SplObjectStorage();
    }

    public function log($level, $message, array $context = array())
    {
        foreach ($this->routes as $route) {
            if (($route instanceof Route) && $route->isEnable) {
                $route->log($level, $message, $context);
            }            
        }
    }
}