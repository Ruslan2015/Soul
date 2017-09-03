<?php

class ConctructorUrl {
	public $module;
	public $action;
	public $params = array();

	public function __construct($module, $action, $params) {
		$this->$module = $module;
		$this->$action = $action;
		$this->$params = $params;
	}
}

$params = array(
	key_1 => 'num_1',
	key_2 => 'num_2');
$constrUrl = new ConctructorUrl('module_1', 'action_1', $params);


echo '<a href=http://soul?'.http_build_query($constrUrl).'>Press!</a>';

var_dump($_SERVER);
$cur_url = $_SERVER['QUERY_STRING'];

var_dump($cur_url);

echo 'Git';