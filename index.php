<?php
define('_PLUGSECURE_', true);

require_once ('modules/mainwindow.php');
require_once ('modules/surl.php');

$MainWindow = new MainWindow;
$Surl = new Surl;

$MainWindow->module = $Surl->params_url['module'];
$MainWindow->action = $Surl->params_url['action'];
$MainWindow->template = $Surl->params_url['template'];
$MainWindow->params = $Surl->params_url['params'];

echo $MainWindow->module . '<br>';
echo $MainWindow->action . '<br>';
echo $MainWindow->template . '<br>';

foreach($MainWindow->params as $key => $value) {
	echo $key . ' => ' . $value . '<br>';
}

$params = array(
	'par1' => 'p1',
	'par2' => 'p2');

$cur_url = $Surl->gen_params_url('m_name', 'm_action', 'm_template', $params);
echo '<a href=http://soul/index.php?'.$cur_url.'>Нажми</a>';



