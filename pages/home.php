<body class="body-center" id="index" >
	<div id="scrolling" class="animated hide" ></div>
	<?php require 'pages/LeftMenu.php'; ?>
	<div class="pull-left">
		<button id="OpenMenu" type="button" class="animated btn btn-default menu" ><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
	</div>
	<div class="pull-left">
		<h1>梅林路由器拓展實用工具</h1>
		<span class="desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">I</b></span>
	</div>
	<div class="clearfix" ></div>
	<hr/>
	<div id="ControlPanel" class="animated fadeInLeft command ControlPanel">
		<div class="row">
			<div class="col-md-3" >
				<span class="mini-title">重啟服務</span>
				<br/>
				<button class="btn btn-default" >Network</button>
				<button class="btn btn-default" >ShadowSocks</button>
				<button id="CloseTerminal" class="hide btn btn-default" >關閉日誌</button>
			</div>
			<div class="col-md-9" >
				<span class="mini-title">操作</span>
				<br/>
				<button class="btn btn-default" >網路測試</button>
				<div class="dropdown need-transition">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdowndns" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> DNS 設定 <span class="caret"></span> </button>
					<ul id="dns-list" class="dropdown-menu" aria-labelledby="dropdowndns">
						<li role="presentation" class="dropdown-header">自動設定</li>
						<li> <a class="DriveBynvramConfig control" data-config="wan_dnsenable_x" href="javascript: void(0)"><i class="fa fa-toggle-off gray" aria-hidden="true"></i> 運營商 DNS</a></li>
						<li role="separator" class="divider"></li>
						<li role="presentation" class="dropdown-header">手動設定</li>
						<li> <a class="control" href="javascript: void(0)"><b>114</b> <small>114.114.114.114 114.114.115.115</small></a> </li>
						<li> <a class="control" href="javascript: void(0)"><b>Google</b> <small>8.8.8.8 8.8.4.4</small></a> </li>
						<li> <a class="control" href="javascript: void(0)"><b>阿里云</b> <small>223.5.5.5 223.6.6.6</small></a> </li>
						<li> <a class="control" href="javascript: void(0)"><b>腾讯云</b> <small>119.29.29.29 182.254.116.116</small></a> </li>
					</ul>
				</div>
				<div class="dropdown need-transition">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 模式 <span class="caret"></span> </button>
					<ul id="server-list" class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li role="presentation" class="dropdown-header">SS 模式</li>
						<li> <a class="control" href="javascript: void(0)"><i class="fa fa-arrow-right" aria-hidden="true"></i> GFW-List</a> </li>
						<li> <a class="control" href="javascript: void(0)"><i class="fa fa-arrow-right" aria-hidden="true"></i> 大陸白名單</a> </li>
						<li> <a class="control" href="javascript: void(0)"><i class="fa fa-arrow-right" aria-hidden="true"></i> Game-Mode</a> </li>
						<!-- <li> <a class="control" href="javascript: void(0)"><i class="fa fa-arrow-right" aria-hidden="true"></i> Game-V2</a> </li> -->
						<li role="separator" class="divider"></li>
						<li role="presentation" class="dropdown-header">停止運作</li>
						<li> <a class="control" href="javascript: void(0)"><i class="fa fa-stop" aria-hidden="true"></i> STOP</a> </li>
						<li role="separator" class="divider"></li>
						<li role="presentation" class="dropdown-header">切換線路</li>
						<li><a id="server-config" class="control server-config" href="javascript: void(0)"><i class="fa fa-cog fa-spin" aria-hidden="true"></i> 線路列表</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="clearfix" ></div>
	</div>
	<hr/>
	<div>
		<span class="mini-title"><i class="fa fa-terminal"></i> / merlin.php / </span>
		<div class="contentBox" >
			<iframe id="iframeBox" class="iframe hide" src="/exec.php" frameborder="0" allowfullscreen></iframe>
			<div id="MessageDIV" ></div>
			<div id="loadingDIV" class="animated animated2 infinite fadeIn" data-isOPEN="true">
				<h5 id="loading-Name">載入中</h5>
				<div><p><span style="margin-top: -5px;" id="loading" class="rotating glyphicon glyphicon-refresh" aria-hidden="true"></span></p></div>
			</div>
		</div>
	</div>


	<?php require 'pages/Footer.php'; ?>
</body>
