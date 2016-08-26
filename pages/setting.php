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
	<div class="animated fadeInLeft ControlPanel">
		<div class="row">
			<div class="col-md-12" >
				<span class="mini-title">Merlin.PHP</span>
				<br/>
				<!-- 				<button class="DriveBySettingConfig setting-dashboard_index-value need-transition btn btn-default" data-config="dashboard_index" ><i class="fa fa-toggle-off gray" aria-hidden="true"></i> 以 Dashboard 為首頁</button>
				<p class="help-block"><b>「以 Dashboard 為首頁」</b>激活后將以 Dashboard 作為首頁，否則以 ShadowSocks 作為進入首頁。</p>
				<hr class="division" > -->
				<button class="DriveBySettingConfig setting-dashboard-value need-transition btn btn-default" data-config="dashboard" ><i class="fa fa-toggle-off gray" aria-hidden="true"></i> Dashboard 功能</button>
				<p class="help-block"><b>「Dashboard 功能」</b>向你提供路由器的摘要信息。</p>
				<hr class="division" >
				<button class="DriveBySettingConfig setting-remote-value need-transition btn btn-default" data-config="remote" ><i class="fa fa-toggle-off gray" aria-hidden="true"></i> Remote 功能</button>
				<p class="help-block"><b>「Remote 功能」</b>是一個管理遠程伺服器（VPS）的功能，提供一些簡單的指令以查詢伺服器狀態。</p>
				<hr class="division" >
				<button class="DriveBySettingConfig need-transition btn btn-default" data-config="debug" ><i class="fa fa-toggle-off gray" aria-hidden="true"></i> Debug</button>
				<p class="help-block"><b>「Debug」</b>顯示 Debug 相關輸出和功能。</p>
			</div>
		</div>
		<hr/>
		<div class="animated fadeInLeft ControlPanel">
			<div class="row">
				<div class="col-md-12" >
					<span class="mini-title">ShadowSocks</span>
					<br/>
					<!-- <button class="need-transition btn btn-default active" >標準字體</button> -->
					<button class="need-transition btn btn-default" >重新載入 ShadowSocks 配置</button>
					<p class="help-block"><b>「重新載入 ShadowSocks 配置」</b>在線路選擇界面遇到激活多個線路的情況，或者信息不準確的情況，請使用此功能修正。</p>
					<hr class="division" >
					<button class="need-transition btn btn-default" >修正輔助腳本的運行權限</button>
					<p class="help-block"><b>「修正輔助腳本的運行權限」</b>遇到報告腳本無法運行的錯誤時候或網速無法顯示，請使用此功能修正。</p>
					<hr class="division" >
					<button class="need-transition btn btn-default" >重建設定配置檔</button>
					<p class="help-block"><b>「重建設定配置檔」</b>當設定部份內容不能正常工作時候，請使用此功能。</p>
				</div>
			</div>
		</div>
		<div class="row setting-debug">
			<hr/>
			<div class="col-md-4" >
				<span class="mini-title">Debug</span>
				<br/>
				<!-- <button class="need-transition btn btn-default active" >標準字體</button> -->
				<button class="need-transition btn btn-default" >ss_basic</button>
				<button class="need-transition btn btn-default" >ss_config</button>
			</div>
			<div class="col-md-4" >
				<span class="mini-title">路由器（重新啟動）</span>
				<br/>
				<button class="need-transition btn btn-default" >重新啟動</button>
				<button class="need-transition btn btn-default" >Web 界面</button>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-md-12" >
			<!-- <button class="need-transition btn btn-default active" >標準字體</button> -->
			<a href="/index.php/setting" class="need-transition btn btn-default" >確定</a>
		</div>
	</div>
</div>
<hr/>
<div>
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
