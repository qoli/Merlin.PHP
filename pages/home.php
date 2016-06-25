
	<body class="body-center" id="index" >
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

		<div id="ControlPanel" class="animated fadeInLeft command">
			<div class="row">
				<div class="col-md-2" >
					<span class="mini-title">重啟服務</span>
					<br/>
					<button class="btn btn-default" >Network</button>
					<button class="btn btn-default" >ShadowSocks</button>
				</div>
				<div class="col-md-2" >
					<span class="mini-title">操作</span>
					<br/>
					<button class="btn btn-default" >網路測試</button>
				</div>
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
				<div class="col-md-12 text-center over-hidden md-lg visible-lg-block" >
				</div>
				<!-- ⬇️ 大屏幕不可見 -->
				<div class="col-sm-12 text-center over-hidden sm-xs hidden-lg" >
				</div>
			</div>
		</div>

		<?php require 'pages/Footer.php'; ?>

	</body>

