host = 'http://192.168.1.1:81/';
dev = false;

jQuery(document).ready(function($) {

  if ($("#NewsBox").length > 0){
    $NewsBox = $('#NewsBox');
    $articletitle = $('.article-title');
    url = $NewsBox.attr('data-url');

    if (!dev) {
      update_news('https://raw.githubusercontent.com/qoli/Merlin.PHP/master/'+url);
    } else {
      update_news(url);
    }

    console.log(getUrlParameter('a'));

  }

  // https://raw.githubusercontent.com/qoli/Merlin.PHP/master/article/help.md

});

  var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
    }
  };

function update_news(url) {

  uArray = url.split( '/' );
  $articletitle.text(uArray[uArray.length -1]);
  // console.log("run");
  $.ajax({
    url: url,
    dataType: "text",
    beforeSend: function(){
      LoadingBox(true,'加載內容……');
    },
    success: function(data) {
      // console.log(data);
      $NewsBox.html(markdown.toHTML(data));
    },
    error: function() {
      console.log("News error");
      LoadingBox(false);
    },
    complete: function(data) {
      LoadingBox(false);
    }
  });
}
