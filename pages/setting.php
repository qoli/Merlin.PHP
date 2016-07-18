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
				<span class="mini-title">字體</span>
				<br/>
				<button class="need-transition btn btn-default active" >標準字體</button>
				<button class="need-transition btn btn-default" >大字體</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" >
				<span class="mini-title">按鈕</span>
				<br/>
				<button class="need-transition btn btn-default active" >標準按鈕</button>
				<button class="need-transition btn btn-default" >大按鈕</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" >
				<span class="mini-title">開發中功能</span>
				<br/>
				<button class="need-transition btn btn-default" >隱藏</button>
				<button class="need-transition need-transition btn btn-default active" >顯示</button>
			</div>
		</div>
	</div>
	<?php require 'pages/Footer.php'; ?>
</body>
