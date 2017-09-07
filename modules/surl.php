<?php
if(!defined('_PLUGSECURE_')) {
	die('Вызов модуля Surl запрещен!');
}

/**
 * class Surl 
 * 
 * Предназначен для разбора переданного URL
 */
class Surl {

	/**
	 * @var $cur_url array - url страницы
	 */
	private $cur_url = array();	

	/**
	 * @var $params_url - параметры url
	 */
	private $params_url = array(
		'module' => '',
		'action' => '',
		'template' => '',
		'params' => array());

	/**
	 * @var $gen_url string - созданный url для передачи в ссылки href
	 */
	private $gen_params_url;

	public function __construct() {
		$this->cur_url['HTTP_HOST'] = $_SERVER['HTTP_HOST'];
		$this->cur_url['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
		$this->cur_url['QUERY_STRING'] = $_SERVER['QUERY_STRING'];
		if(!$this->parse_params_url()) {
			die('Подмена URL! Программа остановлена');
		}
		
	}

	private function parse_params_url() {		
		// Убираем часть заголовка если идет отладка
		$this->cur_url['QUERY_STRING'] = str_replace('XDEBUG_SESSION_START=sublime.xdebug', '', $this->cur_url['QUERY_STRING']);
                $this->cur_url['QUERY_STRING'] = str_replace('XDEBUG_SESSION_START=netbeans-xdebug', '', $this->cur_url['QUERY_STRING']);
		$query = rawurldecode($this->cur_url['QUERY_STRING']);
		//разбираем запрос
		if($query != ''){			
			$prev_url_parts = explode('&', $query);
			foreach ($prev_url_parts as $value) {
				$keyval = explode('=', $value);
				if($keyval[0] == 'module'){
					$this->params_url['module'] = $keyval[1];	
				}
				else if($keyval[0] == 'action') {
					$this->params_url['action'] = $keyval[1];
				}
				else if($keyval[0] == 'template') {
					$this->params_url['template'] = $keyval[1];
				}
				else if($keyval[0] == 'params') {
                                    // TODO: обработать параметры
                                    echo 'jjjj';
				}
				else {
					$trace = debug_backtrace();
					trigger_error(
						'Неправильный URL: ' . $_SERVER['HTTP_HOST'] . ' ' .
						$_SERVER['QUERY_STRING'] .
						' в файле ' . $trace[0]['file'] .
						' на строке ' . $trace[0]['line'],
						E_USER_NOTICE);
					$this->params_url = array();
					return null;
				}
			}
		}
		return true;
	}

	public function gen_params_url($module, $action, $template, $params = array()) {
		$this->params_url['module'] = $module;
		$this->params_url['action'] = $action;
		$this->params_url['template'] = $template;
		foreach ($params as $key => $value) {
			$this->params_url['params'][$key] = $value;
		}
		$this->gen_params_url = http_build_query($this->params_url);
				
		return $this->gen_params_url;
	}

	public function __get($name) {
		if($name == 'cur_url') {
			return $this->cur_url;
		}
		else if($name == 'params_url') {
			return $this->params_url;
		}
		else if($name == 'gen_params_url') {
			return $this->gen_params_url;
		}
		else {
			$trace = debug_backtrace();
			trigger_error(
				'Неопределенное свойство в __get(): ' . $name .
				' в файле ' . $trace[0]['file'] .
				' на строке ' . $trace[0]['line'],
				E_USER_NOTICE);
			return null;
		}
	}
}
	

