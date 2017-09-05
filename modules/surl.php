<?php
if(!defined('_PLUGSECURE_')) {
	die('Вызов модуля, напрямую, запрещен!');
}

class Surl {

	private $cur_url = '';

	public function __construct($url) {
		$cur_url = $url;
	}

	// В функцию необходимо передать параметр $_SERVER
	public function parseUrl () {
		$query_string = $cur_url['QUERY_STRING'];
		// Убираем часть заголовка если идет отладка
		$query_string = str_replace('XDEBUG_SESSION_START=sublime.xdebug', '', $query_string);
		$query = rawurldecode($query_string);
		//разбираем запрос
		if($query != ''){			
			$prev_url_parts = explode('&', $query);
			foreach ($prev_url_parts as $key => $part) {				
				$items = explode('=', $part);				
				if ($items[0] == 'module') {
					$urls_parts['module'] = $items[1];
				}
				else if ($items[0] == 'action') {
					$urls_parts['action'] = $items[1];
				}
				else if ($items[0] == 'template') {
					$urls_parts['template'] = $items[1];
				}
				else {
					$urls_parts[$items[0]] = $items[1];
				}
			}
		}
	}
/*
$urls_parts = array(
	'module' => 'module_name',
	'action' => 'action_name',
	'params' => array(
		'param_1' => 'par1',
		'param_2' => 'par2'),
	'template' => 'easy');

$cur_url = http_build_query($urls_parts);

echo '<a href=http://soul?'.$cur_url.'>Нажми сюда</a>';

$urls_parts = array();
var_dump($urls_parts);
*/

	
}
