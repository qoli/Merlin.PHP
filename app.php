<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
require_once 'library/MainFunction.php';
require_once 'Net/SSH2.php';
require_once 'library/Requests.php';
require_once 'library/AppFunction.php';
Requests::register_autoloader();

$merlin_php = new merlin_php();
// remote();
// exit;

$o = _GET("fun",'unknow');
$q = _GET('q','unknow');


if ($o == 'unknow') {
	// 無輸入，退出
	$merlin_php -> _review("no input");
	exit;
}

if ($q == 'unknow') {
	$o();
} else {
	$o($q);
}

// ChmodCheck();
