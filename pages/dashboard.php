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
				<!-- <span class="mini-title"><i class="fa fa-terminal"></i> /</span> -->
				<div class="contentBox" >
					<div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#tab-home" aria-controls="tab-home" role="tab" data-toggle="tab">CPU / RAM</a></li>
							<li role="presentation"><a href="#tab-hdd" aria-controls="tab-hdd" role="tab" data-toggle="tab">硬盤</a></li>
							<li role="presentation"><a href="#tab-network" aria-controls="tab-network" role="tab" data-toggle="tab">客戶端</a></li>
							<li role="presentation"><a href="#tab-info" aria-controls="tab-info" role="tab" data-toggle="tab">摘要</a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="home">
								<div class="Dash-Bar" >
									<h5>CPU / <span id="cpuusage">CPU %</span></h5>
									<div class="wrapper col-md-6 col-xs-8">
										<div class="load-bar">
											<div class="cpu-load-bar-inner load-bar-inner need-transition" data-loading="0"> </div>
										</div>
									</div>
								</div>
								<div class="clearfix" ></div>
								<p><b>開機時間：</b><span id="up-time">TIME</span> ． <b>運作中線程：</b><span id="procs_running">procs</span><br>
								<b>離線迅雷：</b><span id="離線迅雷">迅雷線程數</span> ． <b>花生殼 PID：</b><span id="oraynewph">oraynewph</span>
								</p>
								<label>CPU 溫度 /</label>
								<p><span id="CPU-temperature">TEMPERATURE</span>°</p>
								<label>Load Average /</label>
								<p><span id="Load-Average">0.0</span></p>
								<label>TOP 5 /</label>
								<p><span id="CPU-TOP-5">TOP5</span></p>
								<br>
								<div class="Dash-Bar" >
									<h5>RAM / <span id="ram">RAM %</span></h5>
									<div class="wrapper col-md-6 col-xs-8">
										<div class="load-bar">
											<div class="load-bar-inner ram-load-bar-inner need-transition" data-loading="0"> </div>
										</div>
									</div>
								</div>
								<div class="clearfix" ></div>
								<p><b>總共：</b><span id="MemTotal">Total</span> ． <b>空閒：</b><span id="MemFree">Free</span><br><b>Buffers：</b><span id="Buffers">Buffers</span> ． <b>Cached：</b><span id="Cached">Cached</span><br><b>VmallocTotal：</b><span id="VmallocTotal">VmallocTotal</span></p>
								<br>
							</div>
							<div role="tabpanel" class="tab-pane" id="tab-hdd">
								<div class="Dash-Bar col-md-3 col-xs-6" style="padding-left: 0;padding-right:30px;" >
									<h5>HDD 1 / <span id="hdd1">HDD %</span></h5>
									<div class="wrapper">
										<div class="load-bar">
											<div class="load-bar-inner hdd1-load-bar-inner need-transition" data-loading="0"> </div>
										</div>
									</div>
									<p><b>總計：</b><span id="sda1-Total">Total</span><br><b>已用：</b><span id="sda1-Used">Used</span><br><b>空閒：</b><span id="sda1-Available">Available</span></p>
								</div>
								<div class="Dash-Bar col-md-3 col-xs-6" style="padding-left: 30px;padding-right:0px;" >
									<h5>HDD 2 / <span id="hdd2">HDD %</span></h5>
									<div class="wrapper">
										<div class="load-bar">
											<div class="load-bar-inner hdd2-load-bar-inner need-transition" data-loading="0"> </div>
										</div>
									</div>
									<p><b>總計：</b><span id="sdb1-Total">Total</span><br><b>已用：</b><span id="sdb1-Used">Used</span><br><b>空閒：</b><span id="sdb1-Available">Available</span></p>
								</div>
								<div class="clearfix" ></div>
							</div>
							<div role="tabpanel" class="tab-pane" id="tab-network">
							<div id="Clients" >
								<h5>Network map</h5>
								<ul class="list">
									<li>網絡下的客戶端</li>
								</ul>
							</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="tab-info">
								<div id="MessageDIV" ></div>
							</div>
						</div>
					</div>
					<br>
					<h5 class="mini-title">刷新時間 / <span id="UPDATE-TIME">TIME</span></h5>
					<hr/>
					<div id="loadingDIV" class="animated animated2 infinite fadeIn" data-isOPEN="true">
						<h5 id="loading-Name">載入中</h5>
						<div class="" >
							<p><span style="margin-top: -5px;" id="loading" class="rotating glyphicon glyphicon-refresh" aria-hidden="true"></span></p>
						</div>
					</div>
				</div>
				<br/>
			</div>
		</div>
	</div>
	<?php require 'pages/Footer.php'; ?>
</body>
