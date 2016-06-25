<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
require 'library/MainFunction.php';
require 'Net/SSH2.php';

$ssh = new Net_SSH2('119.28.53.62');
if (!$ssh->login('root', '123')) {
    exit('Login Failed');
}

dump($ssh->exec('ls -l'));
dump('重啟.');
// dump($ssh->exec('/etc/init.d/game-server status'),'當前 Game-V2 狀態');
// dump($ssh->exec('/etc/init.d/game-server restart'));
// dump($ssh->exec('/etc/init.d/game-server status'));
// dump($ssh->exec('reboot'));
// /etc/init.d/game-server restart
// dump($ssh->exec('cat shadowsocks.log'));
