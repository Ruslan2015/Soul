<?php

// Вызываем модуль для разбора URI
requre_once 'modules/surl.php';

// Вызываем модуль, указанный в URI и выполняем указанное действие
// Формируем массив значений $cur_template['vars_templates']

// Вызываем модуль для загрузки шаблона

// Отображаем страницу

/*
* Конфигурация сайта
*/
define('_SITENAME_', 'Soul');
/*
* Конец конфигурации сайта
*/


//Подгружаем шаблон
// Читаем файл в переменную
if(array_key_exists('template', $urls_parts)) {
	$strtpl = file_get_contents('./templates/'.$urls_parts['template'].
		'/'.$urls_parts['template'].'.tpl');	
}
else {
	$strtpl = file_get_contents('./templates/error.tpl');
}

// Парсим шаблон на подключаемые части

var_dump($strtpl);

$matches = array();
$str_reg = 'Начало строки {*HEADER*} конец строки';


//preg_match_all('|{*[A-Z]{1,}*}|', $str_reg, $matches);



var_dump($matches);
