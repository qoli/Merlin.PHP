<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'library/phpseclib');
// require_once 'library/MainFunction.php';
require_once 'library/AppFunction.php';
require_once 'Net/SSH2.php';

$remote = new remote();

if ($_POST) {
	// dump($_POST,'POST');
	$remote->saveConfig(1,$_POST);
}

$vps1 = $remote->getConfig(1);
// dump($vps1);

?>
<body class="body-center" id="remote-edit" >
	<div id="scrolling" class="animated hide" ></div>
	<?php require 'pages/LeftMenu.php'; ?>
	<div class="pull-left">
		<a type="button" class="animated btn btn-default menu" href="/index.php/remote" ><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
	</div>
	<div class="pull-left">
		<h1>遠程控制（編輯配置檔）</h1>
		<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">remote-edit.php</b></span>
	</div>
	<div class="clearfix" ></div>
	<hr/>
	<div class="animated fadeInLeft">
		<div class="row">
			<div class="col-md-6" >
				<div class="contentBox" >
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#vps1" aria-controls="vps1" role="tab" data-toggle="tab">VPS 1</a></li>
						<!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">VPS 2</a></li> -->
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="vps1">
							<form action="" method="post">
								<br/>
								<!--
								<hr> -->
								<div class="form-group">
									<label for="ip">伺服器 IP</label>
									<input type="text" class="form-control" name="ip" id="ip" placeholder="x.x.x.x" value="<?=$vps1->server?>">
								</div>
								<div class="form-group">
									<label for="user">用戶名（管理員）</label>
									<input type="text" class="form-control" name="user" id="user" placeholder="root" value="<?=$vps1->name?>">
									<p class="help-block">建議使用 root。如果非 root，部份操作可能無法提權。</p>
								</div>
								<div class="form-group">
									<label for="pass">密碼</label>
									<input type="text" class="form-control" name="pass" id="pass" placeholder="password" value="<?=$vps1->pass?>">
								</div>
								<button type="submit" class="btn btn-default">保存</button>
								<hr>
								<button type="button" class="btn btn-default">測試連線</button>
								<p class="help-block">請先保存再使用「測試連線」功能。</p>
								<hr>
								<button type="button" class="btn btn-default" disabled="">添加</button>
								<button type="button" class="btn btn-default" disabled="">刪除 - VPS 1</button>
							</form>
						</div>
						<div role="tabpanel" class="tab-pane" id="profile">...</div>
					</div>
				</div>
				<br/>
			</div>
			<!-- ⬇️ 小屏幕不可見 -->
			<div class="col-md-12 text-center over-hidden md-lg visible-lg-block" >
			</div>
			<!-- ⬇️ 大屏幕不可見 -->
			<div class="col-sm-12 text-center over-hidden sm-xs hidden-lg" >
			</div>
		</div>
	</div>
	<?php require 'pages/Footer.php'; ?>
</body>
