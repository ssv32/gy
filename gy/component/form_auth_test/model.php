<? 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/**
 * это модель класса, тут должны быть функции к которым будет обращаться компонент
 * также подключаться более общие классы (users, БД ... ) 
 * 
 * this is model component, here function for component and include class
 * 
 * TODO может можель сделать универсальной и не писать свою для каждого класса
 * 		надо подумать
 */

function model_setAuth($auth){ // test model
	return '(test = ok)';
}

