<body class="body-center" id="setting" >
	<div id="scrolling" class="animated hide" ></div>
	<?php require 'pages/LeftMenu.php'; ?>
	<div class="pull-left">
		<button id="OpenMenu" type="button" class="animated btn btn-default menu" ><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
	</div>
	<div class="pull-left">
		<h1>設定</h1>
		<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">Setting.php</b></span>
	</div>
	<div class="clearfix" ></div>
	<hr/>
	<div class="animated fadeInLeft">
		<div class="row">
			<div class="col-md-12" >
				<span class="mini-title">ShadowSocks</span>
				<br/>
				<!-- <button class="need-transition btn btn-default active" >標準字體</button> -->
				<button class="need-transition btn btn-default" >重新載入 ShadowSocks 配置</button>
			</div>
		</div>
		<div class="row debug">
			<div class="col-md-12" >
				<span class="mini-title">Debug</span>
				<br/>
				<!-- <button class="need-transition btn btn-default active" >標準字體</button> -->
				<button class="need-transition btn btn-default" >ss_basic</button>
				<button class="need-transition btn btn-default" >ss_config</button>
			</div>
		</div>
	</div>

	<hr/>
	<div class="animated fadeInLeft">
		<div class="row">
			<div class="col-md-12" >
				<div class="contentBox" >
					<div id="MessageDIV" >從上方選擇功能以調整</div>
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
			<div class="col-md-12 text-center over-hidden md-lg visible-lg-block" >
			</div>
			<!-- ⬇️ 大屏幕不可見 -->
			<div class="col-sm-12 text-center over-hidden sm-xs hidden-lg" >
			</div>
		</div>
	</div>
	<?php require 'pages/Footer.php'; ?>
</body>
