jQuery(document).ready(function($) {

	CM = $("#CloseMenu");
	OM = $('#OpenMenu');
	LM = $('#leftMenu');
	$window = $(window);

	//Close Menu
	CM.click(function(){
		ui_closemenu();
	})

	//open Menu
	OM.click(function(){
		ui_openmenu();
	})

	$('#OpenMenu').animateCss('fadeInLeft');
	$window.on('scroll', check_if_in_view);


});

function ui_openmenu() {
	LM.removeClass('fadeOutLeft hide');
	LM.addClass('fadeInLeftBig');
	OM.animateCss('bounceOutRight');
	OM.addClass('leftMenu_Left');
}

function ui_closemenu() {
		LM.removeClass('fadeInLeftBig');
		LM.addClass('fadeOutLeft');
		OM.removeClass('leftMenu_Left');
		OM.animateCss('fadeInLeft');
}

function check_if_in_view() {
  var window_top_position = $window.scrollTop();

  if (window_top_position > 20) {
  	$('#scrolling').addClass('fadeInDown');
  	$('#scrolling').removeClass('fadeOutUp hide');
  } else{
  	$('#scrolling').addClass('fadeOutUp');
  	$('#scrolling').removeClass('fadeInDown');
  }

}

$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
