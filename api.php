<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
require_once 'library/MainFunction.php';
require_once 'Net/SSH2.php';
require_once 'library/Requests.php';
require_once 'library/AppFunction.php';
Requests::register_autoloader();

$merlin_php = new merlin_php();

if (!isset($_POST)) {
	$merlin_php -> _export("no input");
	exit;
}

$o = _GET("class",'unknow');
$f = _GET('function','unknow');

if ($o == 'unknow') {
	$merlin_php -> _export("no input");
	exit;
}

if ($f == 'unknow') {
	$merlin_php -> _export("function?!");
	exit;
}

if (!class_exists($o)) {
	$merlin_php -> _export("class is none");
	exit;
}

$c = new $o();

$agrs = implode(',',$_POST);

// echo '$c->'."$f($agrs);";

eval('$j = $c->'."$f($agrs);");

echo json_encode($j);
