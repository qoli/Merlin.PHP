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

  }

  // https://raw.githubusercontent.com/qoli/Merlin.PHP/master/article/help.md

});

function update_news(url) {

  uArray = url.split( '/' );
  $articletitle.text(uArray[uArray.length -1]);
  console.log("run");
  $.ajax({
    url: url,
    dataType: "text",
    beforeSend: function(){
      LoadingBox(true,'處理中：');
    },
    success: function(data) {
      console.log(data);
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
