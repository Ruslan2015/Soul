<?php
if(!defined('_PLUGSECURE_')) {
	die('Прямой вызов модуля MainWindow запрещен!');
}

/**
 * Класс MainWindow
 * 
 * Класс предназначен для хранения данных, которые определяют отображение формируемой страницы
 */

class MainWindow {

	/**
	 * @var $data array() Место хранения перегружаемых данных
	 * 
	 * Используемые ключи:
	 * 'module' - наименование вызываемого модуля
	 * 'action' - вызываемый метод модуля
	 * 'template' - используемый шаблон
	 * 'params' - массив с параметрами	 * 
	 */
	private $data = array();

	/**
	 * public function __set()
	 * 
	 * используется для записи параметров в массив хранения
	 */
	public function __set($name, $value) {
		$this->data[$name] = $value;
	}

	/**
	 * public function __get()
	 * 
	 * Используется для чтения параметров из массива хранения
	 */
	public function __get($name) {
		if(array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		$trace = debug_backtrace();
		trigger_error(
			'Неопределенное свойство в __get(): ' . $name .
			' в файле ' . $trace[0]['file'] .
			' на строке ' . $trace[0]['line'],
			E_USER_NOTICE);
		return null;
	}

}