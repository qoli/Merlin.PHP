<?php
require 'library/MainFunction.php';

//PATH_INFO 初始化
if (!isset($_SERVER['PATH_INFO']) or $_SERVER['PATH_INFO'] == "") {
    $_SERVER['PATH_INFO'] = 'home';
}
$Param = explode('/', $_SERVER['PATH_INFO']);
if ($Param[0] == 'home') {
    $Param[1] = 'home';
}
$Param[0] = count($Param);

// dump($_SERVER);

if (file_exists('pages/'.$Param[1].'.php')) {
	require 'pages/_head.php';
	require 'pages/'.$Param[1].'.php';
	require 'pages/_end.php';
}	else {
	dump('請求目標不存在', '錯誤');
}
