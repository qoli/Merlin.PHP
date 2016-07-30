<?php

$s = new setting();
$o = $s->getAll();

function display($v = '') {
	if ($v or $v != '') {
		return 'block';
	} else {
		return 'none';
	}
}

?>
<style name="setting-config" type="text/css">

.setting-remote {
	display: <?=display($o->remote);?>
}

.setting-debug {
	display: <?=display($o->debug);?>
}

.setting-dev {
	display: <?=display($o->dev);?>
}

</style>
