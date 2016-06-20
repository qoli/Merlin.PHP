<?php

/**
 * 格式化字符串到数组
 * @param string $String
 * @return array
 */
function FormatToArray($String) {
    //格式化 XX=YY,ZZ=AA 类型的字符串.返回为数组 Array{XX => YY,ZZ => AA};
    $s = explode(',', $String);
    foreach ($s as $v) {
        $st = explode('=', $v);
        $r[$st[0]] = $st[1];
    }
    return $r;
}

/**
 * 格式化数组到字符村
 * @param array $Array
 * @param bool $WithoutKey
 * @return string
 */
function ArrayToSrting($Array, $WithoutKey = TRUE) {
    //数组转字符串,默认带有 key,输出格式 "1~##~A~$$~2~##~B~$$~"
    $String = '';

    if ($WithoutKey == FALSE) {
        foreach ($Array as $v) {
            $String .= $v . '~$$~';
        }
    } else {
        foreach ($Array as $k => $v) {
            $String .= $k . '~##~' . $v . '~$$~';
        }
    }
    return $String;
}

/**
 * 格式化数组到字符串(只能使用~$$~分割)
 * @param String $String
 * @return array(只能使用~$$~分割)
 */
function StringToArray($String) {
    $ArrayTmp = explode('~$$~', $String);
    foreach ($ArrayTmp as $v) {
        $n = explode('~##~', $v);
        $Array[$n[0]] = $n[1];
    }
    array_pop($Array);
    return $Array;
}

/**
 * 获得现在日期
 * @return date("Y-m-d")
 */
function Get_DateNow($Format = '') {
    if ($Format == '') {
        return date("Y-m-d");
    } else {
        return date($Format);
    }
}

/**
 * 获得现在时间
 * @return date("H:i:s")
 */
function Get_TimeNow($Format = '') {
    if ($Format == '') {
        return date("H:i:s");
    } else {
        return date($Format);
    }
}

/**
 * 跳转
 * @param srting $Url
 */
function _Refresh($Url = "") {
    if ($Url == "") {
        header('Location');
        echo "<script>location.href=location.href;</script>";
    } else {
        header('Location:' . $Url);
        echo "<script>window.location.href='$Url';</script>";
    }
}

function _Refresh_App($param) {
    $u = _URL . '/' . $param;
    _Refresh($u);
}

/**
 * 更改网站标题
 * @param type $Title
 */
function _WebTitle($Title) {
    echo "<script type='text/javascript'>document.title='$Title';</script>";
}

/**
 * JS警告
 * @param String $Text
 */
function _Alert($Text) {
    echo "<script type='text/javascript'>alert('$Text');</script>";
}

/**
 * 判断是否二维数组
 * @param array $array
 * @return bool
 */
function is_ArrayTwo($array) {
    //检查是否二维数组
    if (is_array($array)) {
        foreach ($array as $value) {
            if (is_array($value)) {
                //当存在第三唯时候则返回假
                return FALSE;
            }
        }
        //检查通过返回真
        return TRUE;
    }
    //不是数组也返回假
    return FALSE;
}

/**
 * 模板载入,可以使用对应序列数组初始化
 * @param string $File
 * @param string $Folder
 * @param array $BaseData 传入阵列数组
 * @return type
 */
function Templet_Load($File, $Folder, $BaseData = '') {
    try {
        $error = file_exists(_ROOT . _APP . 'View/' . $Folder . '/' . $File . EXT);
        if (!$error) {
            throw new ExceptionEx($error);
        } else {
            $Loop = array();
            $return = file_get_contents(_ROOT . _APP . 'View/' . $Folder . '/' . $File . EXT, 'rb');
            $Templet = $return;
            preg_match_all("{<\?=(\s?)View\(['|\"](.*)['|\"]\)(\s?);?\?>}", $return, $MatchViews);

            //检查是否引用了第三维数组
            $o = preg_match_all("{ <\?=\s?TempletLoad\(['|\"](.*)['|\"],\s?['|\"](.*)['|\"],\s?['|\"](.*)['|\"]\);?\s?\?>}", $return, $MatchTemplet);

            if (count($MatchTemplet[0]) == 0) {
                $isTemlet = 0;
            } else {
                //存在第三维数组
                $isTemlet = 1;
            }

            if ($BaseData != '') {
                //循环模板赋值
                $k = 0;
                foreach ($BaseData as $BaseArray) { //次数循环
                    $i = 0;
                    $return = $Templet;

                    foreach ($MatchViews[2] as $ViewName) {

                        if (isset($BaseArray[$ViewName])) {
                            $ViewValue = $BaseArray[$ViewName];
                        } else {
                            $ViewValue = View($ViewName);
                        }

                        $return = str_replace($MatchViews[0][$i], $ViewValue, $return);
                        $i++;
                    }

                    if ($isTemlet == 1) {
                        //第三维数组赋值
                        $l = 0;
                        while ($l < count($MatchTemplet[0])) {
                            if (isset($BaseArray[$MatchTemplet[3][$l]])) {
                                $TLD = Templet_Load($MatchTemplet[1][$l], 'View/' . $MatchTemplet[2][$l], $BaseArray[$MatchTemplet[3][$l]]);
                            } else {
                                $TLD = Templet_Load($MatchTemplet[1][$l], 'View/' . $MatchTemplet[2][$l], '');
                            }
                            $return = str_replace(print_r($MatchTemplet[0][$l], 1), $TLD, $return);
                            $l++;
                        }
                    }

                    $Loop[$k] = $return;
                    $k++;
                }

                $return = '';
                foreach ($Loop as $v) {
                    $return = $return . $v;
                }
            } else {
                //单次赋值
                $i = 0;
                foreach ($MatchViews[2] as $ViewName) {
                    $ViewValue = View($ViewName);
                    $return = str_replace($MatchViews[0][$i], $ViewValue, $return);
                    $i++;
                }
                $return = str_replace("View", '$replace', $return);
            }
            return $return;
        }
    } catch (ExceptionEx $exc) {
        $param = array(
            'file' => $File . EXT,
            'folder' => '/View/' . $Folder,
            'base' => _ROOT . _APP
        );
        echo $exc->Msg($param);
    }
}

/**
 * 模板内的子模板载入
 * @param type $File 文件
 * @param type $Folder 目录
 * @param type $Data 循环数组
 */
function TempletLoad($File, $Folder, $Data) {
    //空白 - 见 Templet_Load
}

/**
 * 装载文件函数
 * @param 文件名 $File
 * @param 所在目录 $Folder
 */
function Load($File, $Folder) {

    if ($Folder == 'Plus') {
        $f = _ROOT . 'System/Plus/' . $File . EXT;
    } else {
        $f = _ROOT . _APP . $Folder . '/' . $File . EXT;
    }
    $error = file_exists($f);
    try {
        if (!$error) {
            throw new ExceptionEx($error);
        } else {
            require_once $f;
        }
    } catch (ExceptionEx $exc) {
        $param = array(
            'file' => $File . EXT,
            'folder' => $Folder,
            'base' => _ROOT . _APP
        );
        echo $exc->Msg($param);
    }
}

/**
 * 视图变量过度
 * @param 传递名称 $v
 * @param 值 $data
 * @return 取得传递值
 */
function View($v, $data = FALSE, $defData = '_UnSet') {
    if ($data == FALSE) { //读取
        if (isset($GLOBALS['View'][$v])) {
            $view = $GLOBALS['View'][$v];
            return $view;
        } else {
            return $defData;
        }
    } else { //写入
        if (!isset($data) or $data == FALSE) {
            $GLOBALS['View'][$v] = $defData;
        } else {
            $GLOBALS['View'][$v] = $data;
        }
    }
}

/**
 * 控制跨页面变量传递
 * @param 传递名称 $v
 * @param 值 $data
 * @return 取得传递值
 */
function Control($v, $data = '_UnSet') {
    if ($data == '_UnSet') {

        if (isset($GLOBALS['Control'][$v])) {
            return $GLOBALS['Control'][$v];
        } else {
            return "'$v' 没有设定";
        }
    } else {
        $GLOBALS['Control'][$v] = $data;
    }
}

/**
 * 获得URL PATH 指定位置的值
 * @param int $Num
 * @return text
 */
function Param($Num) {
    return $GLOBALS['Param'][$Num];
}

/**
 * 显示信息
 * @param var $var
 */
function _echo($var) {
    if (is_array($var)) {
        dump($var);
    }
    if ($var == FALSE) {
        echo 'FALSE or NULL';
    }
    if (is_string($var)) {
        echo $var;
    }
}

/**
 * 除错变量
 * @param var $vars 除错目标
 * @param str $label 标题头
 * @param bool $return 返回值而不输出
 */
function dump($vars, $label = '', $return = false) {
    if (is_bool($vars)) {
        var_dump($vars);
    } else {
        if (ini_get('html_errors')) {
            $content = "<pre>\n";
            if ($label != '') {
                $content .= "<strong>{$label} :</strong>\n";
            }
            $content .= htmlspecialchars(print_r($vars, true));
            $content .= "\n</pre>\n";
        } else {
            $content = $label . " :\n" . print_r($vars, true);
        }
        if ($return) {
            return $content;
        }
        echo $content;
    }
    return null;
}

/**
 * 对汉字进行Unicode编码 （#21704;&#21704;）
 * @param $str 汉字字符串
 * @param $code 汉字字符串的编码，默认utf-8
 */
function uni_encode($str, $code = 'utf-8') {
    if ($code != 'utf-8') {
        $str = iconv($code, 'utf-8', $str);
    }
    $str = json_encode($str);
    $str = preg_replace_callback('/\\\\u(\w{4})/', create_function('$hex', 'return \'&#\'.hexdec($hex[1]).\';\';'), substr($str, 1, strlen($str) - 2));
    return $str;
}

/**
 * 对Unicode编码进行解码
 * @param $str Unicode编码的字符串
 * @param $code 返回汉字字符串的编码，默认utf-8
 */
function uni_decode($str, $code = 'utf-8') {
    $str = json_decode(preg_replace_callback('/&#(\d{5});/', create_function('$dec', 'return \'\\u\'.dechex($dec[1]);'), '"' . $str . '"'));
    if ($code != 'utf-8') {
        $str = iconv('utf-8', $code, $str);
    }
    return $str;
}

/**
 * 使用文件记录
 * @param any $String 一切变量
 * @return bool 返回写入结果
 */
function _MarkLog($String, $Folder = '') {
    $h = fopen('Logs.txt', 'ab');
    $o = fwrite($h, $String . "\n");
    return $o;
}

/**
 * 删除非空目录
 * @param type $dirname
 * @return type
 */
function d_rmdir($dirname) {
    if (!is_dir($dirname)) {
        return false;
    }
    $handle = @opendir($dirname);
    while (($file = @readdir($handle)) !== false) {
        if ($file != '.' && $file != '..') {
            $dir = $dirname . '/' . $file;
            is_dir($dir) ? d_rmdir($dir) : @unlink($dir);
        }
    }
    closedir($handle);
    return rmdir($dirname);
}

/**
 * 建立多级目录
 * @param string $path 路径
 */
function d_mkdir($path) {
    if (!file_exists($path)) {
        d_mkdir(dirname($path));

        mkdir($path, 0777);
    }
}

/**
 * 图像大小调整
 * @param string $f 图片来源
 * @param string $t 图片输出位置
 * @param int $tw 宽度
 * @param int $th 高度
 * @param int $isCentre 是否居中处理
 * @return bool
 */
function image_resize($f, $t, $tw = 0, $th = 0, $isCentre = 0) {

    $temp = array(1 => 'gif', 2 => 'jpeg', 3 => 'png');

    list($fw, $fh, $tmp) = getimagesize($f);

    if ($tw == 0) {
        $tw = $fw / ($fh / $th);
    }
    if ($th == 0) {
        $th = $fh / ($fw / $tw);
    }

    if (!$temp[$tmp]) {
        return false;
    }
    $tmp = $temp[$tmp];
    $infunc = "imagecreatefrom$tmp";
    $outfunc = "image$tmp";

    $fimg = $infunc($f);

    $offset_x = 0;
    $offset_y = 0;


    if ($fw / $tw > $fh / $th) {

        if ($isCentre) {
            $offset_x = ($fw - $fh) / 2;
        }

        $fw = $tw * ($fh / $th);
    } else {

        if ($isCentre) {
            $offset_y = ($fh - $fw) / 2;
        }

        $fh = $th * ($fw / $tw);
    }


    $timg = imagecreatetruecolor($tw, $th);
    imagecopyresampled($timg, $fimg, 0, 0, $offset_x, $offset_y, $tw, $th, $fw, $fh); //TODO 修改为居中支持
    if ($tmp == 'jpeg') {
        $o = $outfunc($timg, $t,100);
    } else {
        $o = $outfunc($timg, $t);
    }

    if ($o) {
        return true;
    } else {
        return false;
    }
}


/**
 * 远程文件下载
 * @param type $url
 * @param string $Folder
 * @param type $FileName
 * @return boolean
 */
function FileDownload($url, $Folder, $FileName = '') {

    if (substr($Folder, -1) != '/') {
        $Folder = $Folder . '/';
    }

    if ($FileName == '') {
        $newfname = $Folder . basename($url);
    } else {
        $newfname = $Folder . $FileName;
    }
    $file = fopen($url, "rb");
    if ($file) {
        $newf = fopen($newfname, "wb");
        if ($newf)
            while (!feof($file)) {
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
        return TRUE;
    } else {
        return FALSE;
    }
}

/*
  Utf-8、gb2312都支持的汉字截取函数
  cut_str(字符串, 截取长度, 开始长度, 编码);
  编码默认为 utf-8
  开始长度默认为 0
 */

function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
    if ($code == 'UTF-8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if (count($t_string[0]) - $start > $sublen)
            return join('', array_slice($t_string[0], $start, $sublen)) . "";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else {
        $start = $start * 2;
        $sublen = $sublen * 2;
        $strlen = strlen($string);
        $tmpstr = '';

        for ($i = 0; $i < $strlen; $i++) {
            if ($i >= $start && $i < ($start + $sublen)) {
                if (ord(substr($string, $i, 1)) > 129) {
                    $tmpstr.= substr($string, $i, 2);
                } else {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if (ord(substr($string, $i, 1)) > 129)
                $i++;
        }
        if (strlen($tmpstr) < $strlen)
            $tmpstr.= "";
        return $tmpstr;
    }
}

/**
 * GET 的取代写法
 * @param type $GET GET 的值
 * @param type $Def 默认值
 * @return type 返回
 */
function _GET($GET, $Def) {
    if (isset($_GET[$GET])) {
        return $_GET[$GET];
    } else {
        return $Def;
    }
}

/**
 * 返回错误报告
 * @param type $Text
 */
function errorShow($Text) {
    die($Text);
}


/**
 * 生成 6 位隨機 ID
 */
function getRandOnlyId() {
    //新时间截定义,基于世界未日2012-12-21的时间戳。
    $endtime=1356019200;//2012-12-21时间戳
    $curtime=time();//当前时间戳
    $newtime=$curtime-$endtime;//新时间戳
    $rand=rand(0,99);//两位随机
    $all=$rand.$newtime;
    $onlyid=base_convert($all,10,36);//把10进制转为36进制的唯一ID
    return $onlyid;
}

