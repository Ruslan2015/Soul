<?php
// Массив для хранения информации о вызове текущего шаблона
global $_CUR_TEMPLATE_ = array(
	'main_vars' => array(),			// Название сайта и др.
	'main_template' => array(),		// Имя используемого шаблона
	'sub_templates' => array(),		// Подключаемые шаблоны (большие блоки)
	'vars_templates' => array());	// Заменяемые переменные

// Переменная в которую размещается текст страницы перед отображением
global $_SHOW_PAGE_ = '';

// Массив для хранения информации о URI, вызвавшем страницу
global $_URI_PARTS_ = array(
	'module' => '',
	'action' => '',
	'params' => array(),
	'template' => '');