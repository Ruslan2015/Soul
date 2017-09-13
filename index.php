<?php
define('_PLUGSECURE_', true);

require_once 'vendor/autoload.php';

require_once 'config.php';
require_once 'modules/mainwindow.php';
require_once 'modules/surl.php';

// Создаем хранилище данных
$MainWindow = new MainWindow;

// Создаем объект для работы с URL и в конструкторе разбираем полученный URL
$Surl = new Surl;

// Сохраняем данные из URL в хранилище
$MainWindow->module = $Surl->params_url['module'];
$MainWindow->action = $Surl->params_url['action'];
$MainWindow->template = $Surl->params_url['template'];
$MainWindow->params = $Surl->params_url['params'];

// Определяем какой модуль вызывать и вызываем его
if ($MainWindow->module == '') {
    $MainWindow->module = 'MainPage';
    $MainWindow->action = 'ShowPage';
    $MainWindow->template = $cfg_template;
}
else {
    if ($MainWindow->template == '') { // если в заголовке шаблон не определен
        $MainWindow->template = $cfg_template; // используем шаблон из cfg
    }
}

$vars_template = array(); /* массив для хранения переменных, передаваемых в
                             в шаблон */
// Подключаем требуемый модуль
require_once 'modules/soft/'.$MainWindow->module.'/'.$MainWindow->module.'.php';

// TODO: придумать как передавать данные в модуль и возвращать их оттуда

// Устанавливаем какой шаблон вызывать и устанвливаем директорию с файлами
$loader = new Twig_Loader_Filesystem('templates/'.$MainWindow->template);
$twig = new Twig_Environment($loader);

// Вызываем основной файл шаблона
$template = $twig->load('index.html.twig');

// Выводим шаблон
echo $template->render($MainWindow->params);
