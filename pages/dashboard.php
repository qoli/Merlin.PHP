<body class="body-center" id="dashboard" >
	<div id="scrolling" class="animated hide" ></div>
	<?php require 'pages/LeftMenu.php'; ?>
	<div class="pull-left">
		<button id="OpenMenu" type="button" class="animated btn btn-default menu" ><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
	</div>
	<div class="pull-left">
		<h1>Dashboard</h1>
		<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn">Dashboard.php</b></span>
	</div>
	<div class="clearfix" ></div>
	<hr/>
	<div>
		<div class="row">
			<div class="col-md-12" >
				<span class="mini-title"><i class="fa fa-terminal"></i> /</span>
				<div class="contentBox" >
					<div class="Dash-Bar" >
						<h5>CPU / <span id="cpuusage">CPU %</span></h5>
						<div class="wrapper col-md-6 col-xs-8">
							<div class="load-bar">
								<div class="cpu-load-bar-inner load-bar-inner need-transition" data-loading="0"> </div>
							</div>
						</div>
					</div>
					<div class="clearfix" ></div>
					<div class="Dash-Bar" >
						<h5>RAM / <span id="ram">RAM %</span></h5>
						<div class="wrapper col-md-6 col-xs-8">
							<div class="load-bar">
								<div class="load-bar-inner ram-load-bar-inner need-transition" data-loading="0"> </div>
							</div>
						</div>
					</div>
					<div class="clearfix" ></div>
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
