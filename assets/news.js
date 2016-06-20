host = 'http://192.168.1.1:81/';

jQuery(document).ready(function($) {

  $NewsBox = $('#NewsBox');
  update_news('https://raw.githubusercontent.com/qoli/Merlin.PHP/master/article/help.md');

});

function update_news(url) {
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
