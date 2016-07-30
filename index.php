<?php
require_once 'library/MainFunction.php';
require_once 'library/AppFunction.php';

// GLOBALS 變量
$GLOBALS['lanIP'] = trim(shell_exec("nvram get lan_ipaddr_rt"));
$GLOBALS['version'] = "0.4";

// PATH_INFO 初始化
if (!isset($_SERVER['PATH_INFO']) or $_SERVER['PATH_INFO'] == "") {
    $_SERVER['PATH_INFO'] = 'home';
}
$Param = explode('/', $_SERVER['PATH_INFO']);
if ($Param[0] == 'home') {
    $Param[1] = 'home';
}
$Param[0] = count($Param)-1;

// dump($_SERVER);

if (file_exists('pages/'.$Param[1].'.php')) {
	require 'pages/_head.php';
	require 'pages/_setting-config.php';
	require 'pages/'.$Param[1].'.php';
	require 'pages/_end.php';
}	else {
	require 'pages/_head.php';

echo '
<div style="margin-top: 4em;" ></div>
<div>
<div class="row">
<div class="col-md-8 col-md-push-2 col-xs-10 col-xs-push-1" >
';
	dump('請求目標不存在', '錯誤');
	dump($Param,'提交的參數');
	// dump(getRandOnlyId());
	echo '返回 <a href="/">首頁</a>';

echo "
</div></div></div>
";
}
