<?php
require_once 'library/MainFunction.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
// require_once 'library/MainFunction.php';
require_once 'library/AppFunction.php';
require_once 'Net/SSH2.php';

$remote = new remote();
@$o = $remote->test(1);
echo $o;
