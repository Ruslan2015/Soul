<?php
if(!defined('_PLUGSECURE_')) {
	die('Вызов модуля, напрямую, запрещен!');
}

class ConstructorUrl {
	public $module;
	public $action;
	public $params = array();

	public function __construct($module, $action, $params) {
		$this->module = $module;
		$this->action = $action;
		$this->params = $params:
	}
}

class WorkingUrl {

	private $urls_parts = array();

	public function returnUrl($object) {
		return http_build_query($object);
	}

	public function parseUrl($url) {
		$urls_parts = parse_url($url);
		return $urls_parts;
	}

}