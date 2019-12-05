jQuery(document).ready(function($) {

	CM = $("#CloseMenu");
	OM = $('#OpenMenu');
	LM = $('#leftMenu');
	$window = $(window);
	body = $('body');

	lmn = 1;
	bodyn = 0;

	//Close Menu
	CM.click(function() {
		ui_closemenu();
	})

	//open Menu
	OM.click(function() {
		ui_openmenu();
	})

	$('body').click(function(e) {
		// console.log('ui.js: ' + e.target.id);
	})

	$('#OpenMenu').animateCss('fadeInLeft');
	$window.on('scroll', check_if_in_view);

	if ($(".DriveBySettingConfig").length > 0) {
		$(".DriveBySettingConfig").each(function(index, el) {
			val = $(this).attr('data-config');
			DriveBySettingConfig(this, val);
		});
	}

	if ($(".DriveBynvramConfig").length > 0) {
		$(".DriveBynvramConfig").each(function(index, el) {
			val = $(this).attr('data-config');
			DriveBynvramConfig(this, val);
		});
	}

});

function formatFloat(num, pos) {
	var size = Math.pow(10, pos);
	return Math.round(num * size) / size;
}

function ui_MiniNumber(number, mini_desktop, mini_mobile) {

	var u = navigator.userAgent;
	var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
	var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

	m = mini_desktop;

	if (isAndroid || isiOS) {
		m = mini_mobile;
	};

	if (number <= m) {
		return m;
	} else {
		return number;
	}
}

function DriveBySettingConfig(obj, getValue) {

	$.ajax({
			url: '/api.php?class=setting&function=get',
			type: 'POST',
			data: {
				POST: "'" + getValue + "'"
			},
		})
		.done(function(data) {
			if (data == 1) {
				toggleSetOn(obj)
			} else {
				toggleSetOff(obj)
			}
		})
		.fail(function() {
			tipBox('DriveBySettingConfig Failed')
		})

}

function DriveBynvramConfig(obj, getValue) {

	$.ajax({
			url: '/api.php?class=setting&function=getBynvram',
			type: 'POST',
			data: {
				POST: "'" + getValue + "'"
			},
		})
		.done(function(data) {
			data = data.replace(/[^0-9]/ig,"")
			console.log("DriveBynvramConfig -  " + getValue + ": " + data);
			if (data == 1) {
				toggleSetOn(obj)
			} else {
				toggleSetOff(obj)
			}
		})
		.fail(function() {
			tipBox('DriveBySettingConfig Failed')
		})

}

function toggleSetOff(obj) {
	$(obj).children('i').addClass('fa-toggle-off gray').removeClass('fa-toggle-on green');
}

function toggleSetOn(obj) {
	$(obj).children('i').addClass('fa-toggle-on green').removeClass('fa-toggle-off gray');
}

function tipBox(name, delay) {
	name = name || '載入中';
	delay = delay || 2400;
	tip = $('#tips');
	tip.text(name);
	tip.removeClass('hide')
	$('#tips').fadeIn();
	setTimeout(function() {
		$('#tips').fadeOut();
	}, delay)
}

function ui_openmenu() {
	LM.removeClass('fadeOutLeft hide');
	LM.addClass('fadeInLeftBig');
	OM.animateCss('bounceOutRight');
	OM.addClass('leftMenu_Left');
	body.addClass('openmenu').removeClass('closemenu');
}

function ui_closemenu() {
	LM.removeClass('fadeInLeftBig');
	LM.addClass('fadeOutLeft');
	OM.removeClass('leftMenu_Left');
	OM.animateCss('fadeInLeft');
	body.addClass('closemenu').removeClass('openmenu');
	ifClose = 1;
}

function check_if_in_view() {
	var window_top_position = $window.scrollTop();

	if (window_top_position > 20) {
		$('#scrolling').addClass('fadeInDown');
		$('#scrolling').removeClass('fadeOutUp hide');
	} else {
		$('#scrolling').addClass('fadeOutUp');
		$('#scrolling').removeClass('fadeInDown');
	}

}

$.fn.extend({
	animateCss: function(animationName) {
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		$(this).addClass('animated ' + animationName).one(animationEnd, function() {
			$(this).removeClass('animated ' + animationName);
		});
	}
});
