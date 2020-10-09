<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * это модель класса, тут должны быть функции к которым будет обращаться компонент
 * также подключаться более общие классы (users, БД ... ) 
 * 
 * this is model component, here function for component and include class
 * 
 * TODO может модель сделать универсальной и не писать свою для каждого класса
 *   надо подумать
 */

function model_setAuth($auth){ // test model
    return '(test = ok)';
}

