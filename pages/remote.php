<body class="body-center" id="remote" >
	<div id="scrolling" class="animated hide" ></div>
	<?php require 'pages/LeftMenu.php'; ?>
	<div class="pull-left">
		<button id="OpenMenu" type="button" class="animated btn btn-default menu" ><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
	</div>
	<div class="pull-left">
		<h1>遠程控制</h1>
		<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">Remote.php</b></span>
	</div>
	<div class="clearfix" ></div>
	<hr/>
	<div id="ControlPanel" class="animated fadeInLeft ControlPanel">
		<div class="row">
			<div class="col-md-3" >
				<span class="mini-title">VPS</span>
				<br/>
				<a class="btn btn-default" href="/index.php/remote-edit">伺服器配置檔</a>
				<!-- <button class="btn btn-default" ><i class="fa fa-cog" aria-hidden="true"></i> 遠程設定</button> -->
			</div>
			<div class="col-md-9" >
				<span class="mini-title">指令和查詢</span>
				<br/>
				<button class="btn btn-default" >重啟</button>
				<button class="btn btn-default" >ShadowSocks</button>
				<button class="btn btn-default" >Game-V2</button>
			</div>
			<!-- 			<div class="col-md-3 hide" >
					<span class="mini-title">操作</span>
					<br/>
					<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-server" aria-hidden="true"></i> 伺服器
							<span class="caret"></span>
							</button>
							<ul id="server-list" class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a id="server-config" class="server-config" href="/index.php/remote-edit"><i class="fa fa-cog fa-spin" aria-hidden="true"></i> 編輯伺服器列表</a></li>
									<li role="separator" class="divider"></li>
							</ul>
					</div>
			</div> -->
		</div>
		<div class="clearfix" ></div>
	</div>
	<hr/>
	<div class="animated fadeInLeft">
		<div class="row">
			<div class="col-md-12" >
				<span class="mini-title"><i class="fa fa-terminal"></i> / merlin.php / </span>
				<div class="contentBox" >
					<div id="MessageDIV" ></div>
					<div id="loadingDIV" class="animated animated2 infinite fadeIn" data-isOPEN="true">
						<h5 id="loading-Name">載入中</h5>
						<div class="" >
							<p><span style="margin-top: -5px;" id="loading" class="rotating glyphicon glyphicon-refresh" aria-hidden="true"></span></p>
						</div>
					</div>
				</div>
				<br/>
			</div>
			<!-- ⬇️ 小屏幕不可見 -->
			<div class="col-md-12 md-lg visible-lg-block visible-md-block contentBox" >
				<h5>指令和查詢說明</h5>
				<p><b>重啟</b><br>reboot</p>
				<p><b>ShadowSocks</b><br>/etc/init.d/game-server</p>
				<p><b>Game-V2</b><br>/etc/init.d/game-server status</p>
			</div>
			<!-- ⬇️ 大屏幕不可見 -->
			<div class="col-sm-12 over-hidden sm-xs hidden-lg" >
			</div>
		</div>
	</div>
	<?php require 'pages/Footer.php'; ?>
</body>
