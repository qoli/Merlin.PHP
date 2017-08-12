<script src="assets/jquery.min.js"></script>
<script src="assets/bootstrap.min.js"></script>
<script src="assets/underscore-min.js"></script>
<script src="assets/logs.js"></script>
<script src="assets/ui.js"></script>
<script src="assets/app.js?1"></script>
<script src="assets/standalone.js"></script>

<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
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
