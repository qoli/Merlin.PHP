<!doctype html>
<html lang="zh-yue-Hant" class="han-init">
	<head>
		<meta charset="utf-8">
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

		<title>Merlin Tools</title>
		<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
		<link href="//cdn.bootcss.com/animate.css/3.3.0/animate.min.css" rel="stylesheet">
		<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<!-- <link href="//cdn.bootcss.com/Han/3.2.5/han.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" href="assets/style.css">
	</head>
	<body class="body-center" >
		<div id="scrolling" class="animated hide" ></div>

		<?php require 'pages/LeftMenu.php'; ?>

		<div class="pull-left">
			<button id="OpenMenu" type="button" class="animated btn btn-default menu" ><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
		</div>
		<div class="pull-left">
			<h1>梅林路由器拓展實用工具</h1>
			<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">I</b></span>
		</div>
		<div class="clearfix" ></div>
		<hr/>

		<?php require 'pages/ControlPanel.php'; ?>

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
				<div class="col-md-12 text-center over-hidden md-lg visible-lg-block" >
				</div>
				<!-- ⬇️ 大屏幕不可見 -->
				<div class="col-sm-12 text-center over-hidden sm-xs hidden-lg" >
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="footer-container">
				<!-- <hr/> -->
				<p class="text-muted">
					<i id="delay_icon" class="fa fa-circle red" aria-hidden="true"></i> Google：<span id="delay_time">testing</span>
				</p>
			</div>
		</footer>
	</body>
	<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="assets/logs.js"></script>
	<script src="assets/ui.js"></script>
	<script src="assets/app.js"></script>
</html>
