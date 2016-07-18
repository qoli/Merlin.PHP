<style name="ui-config" type="text/css">
<?php

$ui = json_decode(file_get_contents("config/ui.json"));

if ($ui->font == "bigger") {
echo 'body {font-size: 1.8em; }';
}

if ($ui->button == "bigger") {
echo '.btn {padding: 0.8em 2em; }';
}

?>

</style>
