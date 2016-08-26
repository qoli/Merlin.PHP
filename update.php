<!doctype html>
<html lang="zh-yue-Hant" class="han-init">
	<head>
		<meta charset="utf-8">
		<!-- baee path -->
		<base href="http://<?=$_SERVER['HTTP_HOST'];?>/">
		<!-- mobile web app - start -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="white">
		<meta name="apple-mobile-web-app-title" content="Merlin.PHP">
		<link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="images/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="images/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="images/manifest.json">
		<link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="images/mstile-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<!-- mobile web app - end -->
		<title>Merlin Tools</title>
		<link href="assets/bootstrap.min.css" rel="stylesheet">
		<link href="assets/animate.min.css" rel="stylesheet">
		<link href="assets/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/style.css">
		<?php
		require_once 'library/AppFunction.php';
		require 'pages/_setting-config.php';
		?>
	</head>
	<body class="body-center" id="update" >
		<div id="scrolling" class="animated hide" ></div>
		<div class="pull-left">
			<a id="OpenMenu" type="button" class="animated btn btn-default menu" href="/" ><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
		</div>
		<div class="pull-left">
			<h1>在線更新</h1>
			<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">update.php</b></span>
		</div>
		<div class="clearfix" ></div>
		<hr/>
		<div id="ControlPanel" class="animated fadeInLeft ControlPanel">
			<div class="row">
				<div class="col-md-12" >
					<span class="mini-title">更新</span>
					<br/>
					<button class="btn btn-default" >檢查</button>
					<button class="btn btn-default" >實行更新</button>
				</div>
				<div class="col-md-12 setting-dev" >
					<span class="mini-title">更新</span>
					<br/>
					<button class="btn btn-default" >檢查（開發）</button>
					<button class="btn btn-default" >實行更新（開發）</button>
				</div>
				<div class="col-md-12" >
					<span class="mini-title">安裝</span>
					<br/>
					<button class="btn btn-default" >重新安裝</button>
					<p class="help-block">在重新安裝中刷新頁面將可能損壞程式。</p>
					<button class="btn btn-default" >重置 ShadowSocks</button>
					<p class="help-block">將小寶固件的 SS 還原到 1.5.7 版本。</p>
				</div>
			</div>
			<div class="clearfix" ></div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-md-12" >
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
		</div>
	</body>
	<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
	<script src="assets/jquery.min.js"></script>
	<script src="assets/bootstrap.min.js"></script>
	<script src="assets/underscore-min.js"></script>
	<script src="assets/logs.js"></script>
	<script src="assets/ui.js"></script>
	<script src="assets/app.js"></script>
	<script src="assets/standalone.js"></script>
	<script>if (window.module) module = window.module;</script>
	<script type="text/javascript">

	$(window).load(function(){
		setInterval(function(){
			var $contents = $('#iframeBox').contents();
			$contents.scrollTop($contents.height());
		}, 1200);
	});

	</script>
</html>
