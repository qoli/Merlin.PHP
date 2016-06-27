dev = false

jQuery(document).ready(function($) {

  // loading
  if ($("#loadingDIV").length > 0) {
    l = $('#loadingDIV');
    lname = $('#loading-Name');
    m = $('#MessageDIV');
  }

  // 主頁
  if ($("#index").length > 0) {
    onBoot('index');
  }

  // 遠程工具
  if ($("#remote").length > 0) {

    sl = $('#server-list');

    // 獲取可用服務器
    setTimeout(function() {
      $.ajax({
        url: '/app.php?fun=remote_clist',
        dataType: "json",
        success: function(data) {
          // console.log(data);
          for (var key in data) {
            sl.append('<li><a class="server-id server-' + key + '" data-server="' + key + '" onclick="event.stopPropagation();" href="javascript: void(0)"><i class="animated need-transition fa fa-toggle-off gray" aria-hidden="true"></i> ' + data[key] + '</a></li>');
          };

          $('.server-id').click(function(event) {
            $sid = $(this).attr('data-server');

            // 設定激活服務器
            $.ajax({
              url: '/app.php?fun=setActive&q=' + $sid,
              dataType: "json",
              beforeSend: function() {
                $('#server-config i').addClass('fa-spin')
                $('.fa-toggle-on').addClass('fa-toggle-off gray').removeClass('fa-toggle-on green');
              },
              success: function(data) {
                // console.log($('.server-'+$sid));
                $('.server-' + $sid + ' i').addClass('fa-toggle-on green').removeClass('fa-toggle-off gray');
              },
              complete: function(data) {
                $('#server-config i').removeClass('fa-spin')
              }
            });

          });

        },
        complete: function(data) {
          $('#server-config i').removeClass('fa-spin')
        }
      });

    }, 1000);

    // m.append('<h5>HI</h5>')
    // m.append("<span><b>狀態: </b> 開發中</span><br/>");

    getApp('remoteConfig');

    LoadingBox(false);
  }

  // 更新
  if ($("#update").length > 0) {
    iframeBox('/exec.php?command=./bin/autoupdate/check.sh');
    LoadingBox(false);
  }

  // 新聞
  if ($("#article").length > 0) {

    $NewsBox = $('#NewsBox');
    $articletitle = $('.article-title');

    article = getUrlParameter('a');

    if (article) {
      update_news('https://raw.githubusercontent.com/qoli/Merlin.PHP/master/article/' + article + '.md');
    } else {
      url = $NewsBox.attr('data-url');
      update_news(url);
    }

  }

  // Footer 信息
  if ($("#delay_icon").length > 0) {
    $delay_time = $('#delay_time');
    $delay_icon = $('#delay_icon');
    update_delay();
    setInterval(update_delay, 2000);
  }


  $('.btn,.control').click(function(event) {
    e = $(this).text();
    e = e.trim();
    console.log('Click: "' + e + '"');
    switch (e) {
      case 'Network':
        RunApp('SystemNetwork');
        break;
      case 'Web 界面':
        RunApp('SystemCommand', '/opt/etc/init.d/S80lighttpd restart');
        break;
      case 'DNSMASQ':
        RunApp('SystemCommand', 'service restart_dnsmasq');
        break;
      case 'Game-Mode':
        RunApp('SwitchMode', 'game');
        break;
      case 'Game-V2':
        RunApp('SwitchMode', 'v2');
        break;
      case 'STOP':
        RunApp('SystemCommand', '/koolshare/ss/stop.sh');
        // iframeBox('/exec.php?command=/koolshare/ss/stop.sh');
        break;
      case 'ShadowSocks':
        getApp('FastReboot', 'Clean', 'ShadowSocks 快速重啟');
        break;
      case '網路測試':
        onBoot('index');
        // getApp('TEST', false, 'Playstation.com','ps');
        // getApp('TEST', false, 'Baidu via Proxy','baidup');
        break;
      case 'IP':
        getApp('IP', 'Clean');
        break;

      case '檢查':
        iframeBox('/exec.php?command=./bin/autoupdate/check.sh');
        LoadingBox(false);
        break;

      case '實行更新':
        iframeBox('/exec.php?command=./bin/autoupdate/update.sh');
        LoadingBox(false);
        break;

      case '重啟 VPS':

        break;
      case '查詢伺服器狀態':
        RunApp('remote','/etc/init.d/game-server status',true,'遠程反饋');
        break;

      default:
        console.log("nothing");
        break;
    }

  });


});

function onBoot(mode) {
  switch (mode) {
    case 'index':
      RunApp('GetExec', 'cat ss-mode', true, 'SS 模式', '模式');
      getApp('SSConfig', 'Clean', 'SS 配置');
      getApp('ConnectTest', false, 'Baidu', 'baidu');
      getApp('ConnectTest', false, 'Google', 'google');
      break;

    default:
      console.log("nothing");
      break;
  }
}

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
  uArray = url.split('/');
  $articletitle.text(uArray[uArray.length - 1]);
  // console.log("run");
  $.ajax({
    url: url,
    dataType: "text",
    beforeSend: function() {
      LoadingBox(true, '加載內容……');
    },
    success: function(data) {
      // console.log(data);
      $NewsBox.html(markdown.toHTML(data));
    },
    error: function(data) {
      console.log(data);
      console.log("News error");
      LoadingBox(false);

      errorMessage = '# 錯誤 \n 遠程內容載入失敗\n\n' +
        '# 目標內容：\n' + url +
        '\n\n# 回報文字：\n' + data.responseText

      $NewsBox.html(markdown.toHTML(errorMessage));
    },
    complete: function(data) {
      LoadingBox(false);
    }
  });
}

function heredoc(fn) {
  return fn.toString().split('\n').slice(1, -1).join('\n') + '\n'
}

function update_delay() {
  $.ajax({
    url: '/app.php?fun=ConnectTest&q=google',
    dataType: "json",
    success: function(data) {
      // console.log("延遲："+data.延遲);
      if (data.延遲 < 0.01) {
        $delay_time.text('timeout');
        $delay_icon.addClass('red');
      } else {
        $delay_time.text(data.延遲 + 's');
        $delay_icon.removeClass('red');
      }
    },
    error: function() {
      $delay_time.text('error');
    }
  });
}

function iframeBox(url) {
  url = url || false;
  i = $('#iframeBox');

  if (url == false) {
    i.hide();
  } else {
    i.show();
    i.removeClass('hide');
    i.attr('src', url);
  }
}

function LoadingBox(isShow, name) {
  isShow = isShow || false;
  name = name || '載入中';
  lname.text(name);
  if (isShow === true) {
    l.fadeIn();
  }
  if (isShow === false) {
    l.fadeOut();
  }
}

function RunApp(f, q, isAdd, isTitle, isDesc) {
  isAdd = isAdd || false;
  isTitle = isTitle || f;
  isDesc = isDesc || q;
  LoadingBox(true, '處理中：' + isTitle);
  m.html('');
  $.get('/app.php', {
    'fun': f,
    'q': q
  }, function(success) {
    if (isAdd) {
      m.append('<h5>' + isTitle + '</h5>')
      m.append("<span><b>" + isDesc + ": </b> " + success + "</span><br/>");
    } else {
      m.html(success);
    }
    m.append('<br/>');
    LoadingBox(false);
  })

}

function getApp(f, isClear, isTitle, q) {
  isClear = isClear || false;
  isTitle = isTitle || f;
  q = q || "";
  if (isClear) {
    m.html('');
  };

  $.ajax({
    url: '/app.php?fun=' + f + '&q=' + q,
    dataType: "json",
    beforeSend: function() {
      LoadingBox(true, '處理中：' + f);
    },
    success: function(data) {
      if (isTitle != 'no') {
        m.append('<h5>' + isTitle + '</h5>');
      };
      for (var k in data) {
        if (!_.isObject(data[k])) {
          m.append("<span><b>" + k + ":</b> " + data[k] + "</span><br/>");
        } else {
          m.append("<span><b>" + k + ":</b></span><br/>");
          for (var i in data[k]) {
            m.append("<span>　<b>" + i + ":</b> " + data[k][i] + "</span><br/>");
          };
        }
      }
      m.append('<br/>');
    },
    complete: function(data) {
      LoadingBox(false);
    }
  });
}


function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1);
  var sURLVariables = sPageURL.split('&');
  for (var i = 0; i < sURLVariables.length; i++) {
    var sParameterName = sURLVariables[i].split('=');
    if (sParameterName[0] == sParam) {
      return sParameterName[1];
    }
  }
}

function show() {
  var items = $('.urls');

  // Animate each line individually
  for (var i = 0; i < items.length; i++) {
    var item = items[i]
      // Define initial properties
    dynamics.css(item, {
      opacity: 0,
      translateY: 20
    })

    // Animate to final properties
    dynamics.animate(item, {
      opacity: 1,
      translateY: 0
    }, {
      type: dynamics.spring,
      frequency: 300,
      friction: 435,
      duration: 1000,
      delay: 100 + i * 40
    })
  }

}
