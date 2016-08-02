<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
require_once 'library/MainFunction.php';
require_once 'Net/SSH2.php';
require_once 'library/Requests.php';
require_once 'library/AppFunction.php';
Requests::register_autoloader();

exec("ls /mnt/",$o);

dump($o);

foreach ($o as $key => $value) {
	exec("ls /mnt/".$value,$k);
	dump($k,$value);
}
