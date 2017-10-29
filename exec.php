<?php

require 'library/MainFunction.php';

echo '<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">';
echo '<link rel="stylesheet" href="assets/style.css">';
echo '<div class="contentBox">';
set_time_limit(0);

$c = _GET('command','unknow');

if ($c == 'unknow') {
	echo '';
	exit;
}

$handle = popen($c, "r");

if (ob_get_level() == 0)
ob_start();

while(!feof($handle)) {

	$buffer = fgets($handle);
	$buffer = trim(htmlspecialchars($buffer));

	echo $buffer . "<br />";
	echo str_pad('', 4096);

	ob_flush();
	flush();
	sleep(0.001);
}

pclose($handle);
ob_end_flush();
echo '</div>';
