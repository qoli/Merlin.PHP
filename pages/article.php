<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/Han/3.3.0/han.min.css" rel="stylesheet"> -->
<body class="body-center" id="article" >
	<div id="scrolling" class="animated hide" ></div>
	<div class="pull-left">
		<a id="OpenMenu" type="button" class="animated btn btn-default menu" href="/" ><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
	</div>
	<div class="pull-left">
		<h1 class="article-title">article</h1>
		<span class="model desc"><i class="fa fa-terminal"></i>  / merlin.php /  <b class="animated animated2 infinite fadeIn article-title">article</b></span>
	</div>
	<div class="clearfix" ></div>
	<hr/>
	<div class="animated fadeInLeft">
		<div class="row">
			<div class="col-md-12" >
				<div class="contentBox" >
					<!-- ⬇️ 正文 -->
					<article id="NewsBox" data-url="article/error.md" ></article>
					<!-- ⬆️ 正文 END -->
					<div id="loadingDIV" class="animated animated2 infinite fadeIn" data-isOPEN="true">
						<h5 id="loading-Name">載入中</h5>
						<div class="" >
							<p><span style="margin-top: -5px;" id="loading" class="rotating glyphicon glyphicon-refresh" aria-hidden="true"></span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require 'pages/Footer.php'; ?>
</body>
<script src="assets/markdown.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/Han/3.3.0/han.min.js"></script> -->
