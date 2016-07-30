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
        case 'GFW-List':
          RunApp('SwitchMode', 'gfw');
          break;
        case '大陸白名單':
          RunApp('SwitchMode', 'mainland');
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
          break;
        case '線路列表':
          getApp('ss_config', 'Clean');
          break;
        default:
          console.log("nothing");
          break;
      }

    });

    sl = $('#server-list');
    // 獲取可用服務器
    setTimeout(function() {
      $.ajax({
        url: '/app.php?fun=ss_config',
        dataType: "json",
        success: function(data) {
          // console.log(data);
          for (var key in data) {
            // console.log(data[key].working);
            if (data[key].server != undefined) {

              if (data[key].working == 1) {
                status = 'fa-toggle-on green'
              } else {
                status = 'fa-toggle-off gray'
              }

              sl.append('<li><a class="ss-config server-' + key + '" data-server="' + key + '" onclick="event.stopPropagation();" href="javascript: void(0)"><i class="animated need-transition fa ' + status + '" aria-hidden="true"></i> ' + data[key].name + ' <small>(' + data[key].server + ')</small></a></li>');
            }
          };

          $('.ss-config').click(function(event) {
            $sid = $(this).attr('data-server');

            // 設定激活服務器
            $.ajax({
              url: '/app.php?fun=ss_config&q=' + $sid,
              dataType: "json",
              beforeSend: function() {
                $('#server-config i').addClass('fa-spin')
                $('.fa-toggle-on').addClass('fa-toggle-off gray').removeClass('fa-toggle-on green');
              },
              success: function(data) {
                // console.log($('.server-' + $sid));
                // console.log(data);
                $('.server-' + $sid + ' i').addClass('fa-toggle-on green').removeClass('fa-toggle-off gray');
                t = '已選擇「' + data.name + '」等待重開 SS 模式'
                console.log(t);
                tipBox(t, 2800);

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

  }

  // 遠程工具
  if ($("#remote").length > 0) {

    // tipBox('此功能正在開發中');

    sl = $('#server-list');

    $('.btn,.control').click(function(event) {
      e = $(this).text();
      e = e.trim();
      console.log('Click: "' + e + '"');
      switch (e) {
        case '重啟':
          RunApp('remote_command', 'reboot', true, '遠程反饋');
          break;
        case 'ShadowSocks':
          RunApp('remote_command', '/etc/init.d/shadowsocks status', true, '遠程反饋');
          break;
        case 'Game-V2':
          RunApp('remote_command', '/etc/init.d/game-server status', true, '遠程反饋');
          break;

        default:
          console.log("nothing");
          break;
      }
    });

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

    getApp('remote_clist', true, '可用伺服器');
  }

  // 遠程 - 編輯配置檔
  if ($("#remote-edit").length > 0) {

    $('.btn,.control').click(function(event) {
      e = $(this).text();
      e = e.trim();
      console.log('Click: "' + e + '"');
      switch (e) {
        case '測試連線':

          $b = $(this);
          $b.attr('disabled', '');
          $b.text('Testing');

          $.ajax({
              url: '/app.php?fun=remote_connectTest'
            })
            .done(function(data) {
              t = '測試：' + data
              console.log(t);
              tipBox(t, 2800);
              setTimeout(function() {
                $b.text(e);
                $b.removeAttr('disabled');
              }, 800)
            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });



          break;

        default:
          console.log("nothing");
          break;
      }
    });

  }

  // 更新
  if ($("#update").length > 0) {
    iframeBox('/exec.php?command=./bin/autoupdate/check.sh');
    LoadingBox(false);

    $('.btn,.control').click(function(event) {
      e = $(this).text();
      e = e.trim();
      console.log('Click: "' + e + '"');
      switch (e) {
        case '檢查':
          iframeBox('/exec.php?command=./bin/autoupdate/check.sh');
          LoadingBox(false);
          break;

        case '實行更新':
          iframeBox('/exec.php?command=./bin/autoupdate/update.sh');
          LoadingBox(false);
          break;

        case '重新安裝':
          iframeBox('/exec.php?command=./bin/autoupdate/reinstall.sh');
          LoadingBox(false);
          break;

        default:
          console.log("nothing");
          break;
      }
    });
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

  // 設定
  if ($("#setting").length > 0) {

    LoadingBox(false);

    $('.btn,.control').click(function(event) {
      e = $(this).text();
      e = e.trim();
      console.log('Click: "' + e + '"');
      switch (e) {

        case '重新載入 ShadowSocks 配置':
          getApp('ss_rebuild', 'Clean');
          break;

        case '修正輔助腳本的運行權限':
          getApp('ChmodCheck', 'Clean');
          break;

        case 'Remote 功能':
          settingBoolSwtich(this);
          break;

        case 'Debug':
          settingBoolSwtich(this);
          break;

        case '開發版本':
          settingBoolSwtich(this);
          break;

        case 'ss_basic':
          getApp('ss_basic', 'Clean');
          break;

        case 'ss_config':
          getApp('ss_config', 'Clean');
          break;

          // case '標準字體':
          //   getApp('json_update', 'Clean', 'font', 'general');
          //   break;
          // case '標準按鈕':
          //   getApp('json_update', 'Clean', 'button', 'general');
          //   break;
          // case '大字體':
          //   getApp('json_update', 'Clean', 'font', 'bigger');
          //   break;
          // case '大按鈕':
          //   getApp('json_update', 'Clean', 'button', 'bigger');
          //   break;

        default:
          console.log("nothing");
          break;
      }

    });

  }

  // Footer 信息
  if ($("#delay_icon").length > 0) {
    $delay_time = $('#delay_time');
    $delay_icon = $('#delay_icon');
    $netspeed = $('#netspeed');
    update_delay();
    setInterval(update_delay, 2000);
    setInterval(netspeed, 2000);
  }

});

function onBoot(mode) {
  switch (mode) {
    case 'index':
      getApp('BaseInformation', "Clean", '網絡信息');
      getApp('ConnectTest', false, '網絡測試');
      getApp('GetShadowSockConfig', false, 'ShadowSocks 配置信息');
      // RunApp('SystemCommand', 'nvram get wan0_dns', true, 'DNS 設定', '撥號所用 DNS');
      // RunApp('GetExec', 'cat ss-mode', true, 'SS 模式', '模式');
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

function settingBoolSwtich(obj) {

  settingName = $(obj).attr('data-config');

  $.ajax({
      url: '/api.php?class=setting&function=get',
      type: 'POST',
      data: {
        POST: "'" + settingName + "'"
      },
    })
    .done(function(data) {
      if (data == 1) {
        Bool = 0;
      } else {
        Bool = 1;
      }
      dataPOST = {
        name: "'" + settingName + "'",
        value: Bool
      }
      api('setting', 'set', dataPOST, obj, function(e) {
        if (Bool) {
          toggleSetOn(obj);
        } else {
          toggleSetOff(obj);
        }
      });
    })
    .fail(function() {
      console.log("settingBoolSwtich: error");
    })
    .always(function() {
      console.log("settingBoolSwtich: complete");
    });



}

function api(className, functionName, dataPOST, obj, callback) {
  $.ajax({
      url: '/api.php?class=' + className + '&function=' + functionName,
      type: 'POST',
      data: dataPOST
    })
    .done(function(data) {
      console.log("API-"+className+"-"+functionName+": "+data+" + POST ⬇️");
      console.log(dataPOST);
      if (typeof callback === "function") {
        callback(data);
      }
    })
    .fail(function() {
      console.log("api: error");
    })
    .always(function() {
      console.log("api: complete");
    });

}

function update_news(url) {
  uArray = url.split('/');
  $articletitle.text(uArray[uArray.length - 1]);
  // console.log("run");
  $.ajax({
    url: url,
    dataType: "text",
    timeout: 8000,
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
    },
    fail: function(data) {
      LoadingBox(false);
    },
    timeout: function(data) {
      errorMessage = '# 錯誤 \n 遠程內容載入失敗\n\n' +
        '# 目標內容：\n' + url +
        '\n\n# 回報文字：\n' + data.responseText

      $NewsBox.html(markdown.toHTML(errorMessage));
    }
  });
}

function heredoc(fn) {
  return fn.toString().split('\n').slice(1, -1).join('\n') + '\n'
}

function netspeed() {
  $.ajax({
    url: '/app.php?fun=GetExec&q=/opt/share/www/bin/script/netspeed.sh%20eth0',
    dataType: "text",
    success: function(data) {
      $netspeed.text(data)
    },
    error: function() {
      $netspeed.text('netspeed');
    }
  });
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
