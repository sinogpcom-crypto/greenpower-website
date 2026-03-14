<?php
/**
 *  extention.func.php 用户自定义函数库
 * $Date: 2014-11-24 09:14:56 +0800 (Mon, 24 Nov 2014) $
 * $Id: extention.func.php 152 2014-11-24 01:14:56Z jiaokun $
 *
 * @copyright			(C) 2009-2014 BangCMS
 * @license				http://builder.netbang.com.cn/license/
 * @package libs\functions\extention.func.php
 * @package extention.func.php
 */

   function isMobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
}

function p($data)
{
    echo '<pre>' . print_r($data, true) . '<pre>';
}


/**
     * 数组按照指定数量分块*/

 function splits( $data, $num = 5 )
    {
        
        $arrRet = array();
        if( !isset( $data ) || empty( $data ) )
        {
            return $arrRet;
        }
        
        $iCount = count( $data )/$num;
        if( !is_int( $iCount ) )
        {
            $iCount = ceil( $iCount );
        }
        else
        {
            $iCount += 1;
        }
        for( $i=0; $i<$iCount;++$i )
        {
            $arrInfos = array_slice( $data, $i*$num, $num );
            if( empty( $arrInfos ) )
            {
                continue;
            }
            $arrRet[] = $arrInfos;
            unset( $arrInfos );
        }
        
        return $arrRet;
        
    }

/**
 * 分页函数
 *
 * @param $num 信息总数
 * @param $curr_page 当前分页
 * @param $perpage 每页显示数
 * @param $urlrule URL规则
 * @param $array 需要传递的数组，用于增加额外的方法
 * @return string 分页html代码
 */
function pages2($num, $curr_page, $perpage = 20, $urlrule = '', $array = array(),$setpages = 5) {
    if(defined('URLRULE') && $urlrule == '') {
        $urlrule = URLRULE;
        $array = $GLOBALS['URL_ARRAY'];
    } elseif($urlrule == '') {
        $urlrule = url_par2('page={$page}');
    }

    $siteids = getcache('category_content','commons');  
    $siteid = $siteids[$array['catid']];
    if (!$siteid) $siteid = 1;
    // if ($siteid==1) {
    //     $home_name = '首页';
    //     $prev_name = '上一页';
    //     $next_name = '下一页';
    //     $last_name = '尾页';
    // }else{
        $home_name = 'home';
        $prev_name = 'previous page';
        $next_name = 'next page';
        $last_name = 'last page';
    // }



    $multipage = '';
    if($num > $perpage) {
        $page = $setpages+1;
        $offset = ceil($setpages/2-1);
        $pages = ceil($num / $perpage);
        if (defined('IN_ADMIN') && !defined('PAGES')) define('PAGES', $pages);
        $from = $curr_page - $offset;
        $to = $curr_page + $offset;
        $more = 0;
        if($page >= $pages) {
            $from = 2;
            $to = $pages-1;
        } else {
            if($from <= 1) {
                $to = $page-1;
                $from = 2;
            }  elseif($to >= $pages) {
                $from = $pages-($page-2);
                $to = $pages-1;
            }
            $more = 1;
        }
        /*$multipage .= '<a class="a1">'.$num.L('page_item').'</a>';*/
        $multipage .= ' <div class="sk_page">';
        if($curr_page>0) {
            $multipage .= ' <a href="'.pageurl2($urlrule, $curr_page-1, $array).'" >'.$prev_name.'</a>';

            if($curr_page==1) {
                $multipage .= ' <a href="javascript:;" class="current_page">1</a>';
            } elseif($curr_page>6 && $more) {
                $multipage .= ' <a href="'.pageurl2($urlrule, 1, $array).'">1</a>..';
            } else {
                $multipage .= ' <a href="'.pageurl2($urlrule, 1, $array).'">1</a>';
            }
        }
        for($i = $from; $i <= $to; $i++) {
            if($i != $curr_page) {
                $multipage .= ' <a href="'.pageurl2($urlrule, $i, $array).'">'.$i.'</a>';
            } else {
                $multipage .= ' <a href="javascript:;" class="current_page">'.$i.'</a>';
            }
        }
        if($curr_page<$pages) {
            if($curr_page<$pages-5 && $more) {
                $multipage .= ' ..<a href="'.pageurl2($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.pageurl2($urlrule, $curr_page+1, $array).'" >'.$next_name.'</a>';
            } else {
                $multipage .= ' <a href="'.pageurl2($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.pageurl2($urlrule, $curr_page+1, $array).'" >'.$next_name.'</a>';
            }
        } elseif($curr_page==$pages) {
            $multipage .= ' <a href="javascript:;" class="current_page">'.$pages.'</a> <a href="'.pageurl2($urlrule, $curr_page, $array).'" >'.$next_name.'</a>';
        } else {
            $multipage .= ' <a href="'.pageurl2($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.pageurl2($urlrule, $curr_page+1, $array).'">'.$next_name.'</a>';
        }
        $multipage .= ' </div>';
    }
    return $multipage;
}

/**
 * 返回分页路径
 *
 * @param $urlrule 分页规则
 * @param $page 当前页
 * @param $array 需要传递的数组，用于增加额外的方法
 * @return string 完整的URL路径
 */
/*function pageurl2($urlrule, $page, $array = array()) {
    if(strpos($urlrule, '~')) {
        $urlrules = explode('~', $urlrule);
        $urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
    }
    $findme = array('{$page}');
    $replaceme = array($page);
    if (is_array($array)) foreach ($array as $k=>$v) {
        $findme[] = '{$'.$k.'}';
        $replaceme[] = $v;
    }
    $url = str_replace($findme, $replaceme, $urlrule);
    $url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);
    return $url;
}*/
function pageurl2($urlrule, $page, $array = array()) {
    if(strpos($urlrule, '~')) {
        $urlrules = explode('~', $urlrule);
        $urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
    }
    $findme = array('{$page}');
    $replaceme = array($page);
    if (is_array($array)) foreach ($array as $k=>$v) {
        $findme[] = '{$'.$k.'}';
        $replaceme[] = $v;
    }
    
    $data = array();
  $pos = strpos($_SERVER["REQUEST_URI"],'?');
  if ($pos) {
      $parameter = explode('&',end(explode('?',$_SERVER["REQUEST_URI"])));
      //p($parameter);
      foreach($parameter as $val){
          $tmp = explode('=',$val);
          $data[$tmp[0]] = $tmp[1];
      }
      
      if (count($data)>0) {
        $i=1;
        foreach ($data as $key => $value) {
          if ($i==1) {
            $urlrule=$urlrule.'?'.$key.'='.$value;
          }else{
            $urlrule=$urlrule.'&'.$key.'='.$value;
          }
          
          $i++;
        }
      }
  }
    
    //&& $page>1  
    //党团建设文章
    /*if(strstr($_SERVER["REQUEST_URI"], 'list-198') || strstr($_SERVER["REQUEST_URI"], 'list-199')){
    $urlrule.="#maodian";
  }
    */
    $url = str_replace($findme, $replaceme, $urlrule);
    $url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);
    return $url;
}

/**
 * pages函数的辅助函数：生成URL地址
 *
 * @param string $par 传入需要解析的变量 默认为，page={$page}
 * @param string $url URL地址
 * @return string URL
 */
function url_par2($par, $url = '') {
    if($url == '') $url = get_url();
    $pos = strpos($url, '?');
    if($pos === false) {
        $url .= '?'.$par;
    } else {
        $querystring = substr(strstr($url, '?'), 1);
        parse_str($querystring, $pars);
        $query_array = array();
        foreach($pars as $k=>$v) {
            if($k != 'page') $query_array[$k] = $v;
        }
        $querystring = http_build_query($query_array).'&'.$par;
        $url = substr($url, 0, $pos).'?'.$querystring;
    }
    return $url;
}

/*获取顶级栏目id*/
    function get_topid($CATEGORYS,$catid){
        foreach ($CATEGORYS as $key => $value) {
            if ($value['parentid']==0) {
                if (in_array($catid, explode(",", $value['arrchildid']))) {
                   return $value['catid'];
                }
               
            }
        }
    }

 //登录  php解密代码
function decode1($str){
        $staticchars = "PXhw7UT1B0a9kQDKZsjIASmOezxYG4CHo5Jyfg2b8FLpEvRr3WtVnlqMidu6cN";
        $decodechars = "";
        for($i=1;$i<strlen($str);){
            $num0 = strpos($staticchars, $str[$i]);
            if($num0 !== false){
                $num1 = ($num0+59)%62;
                $code = $staticchars[$num1];
            }else{
                $code = $str[$i];
            }
            $decodechars .= $code;
            $i+=3;
        }
        return $decodechars;
    }
/**
 * 返回指定栏目路径层级，即生产栏目的面包屑导航
 * @param $catid 栏目id
 * @param $symbol 栏目间隔符
 * @return string HTML
 */
 function catpos2($catid, $symbol=' > '){ 
    $category_arr = array();  
    $siteids = getcache('category_content','commons');  
    $siteid = $siteids[$catid];   
    $category_arr = array();  
    $siteids = getcache('category_content','commons');  
    $siteid = $siteids[$catid];  
    $category_arr = getcache('category_content_'.$siteid,'commons');  
    if(!isset($category_arr[$catid])) return '';  
    $pos = '';  
    $siteurl = siteurl($category_arr[$catid]['siteid']);  
    $arrparentid = array_filter(explode(',', $category_arr[$catid]['arrparentid'].','.$catid));
     //p($category_arr);exit;  
    foreach($arrparentid as $catid) {  
        if ($category_arr[$catid]['ismenu']==1) {
            $url = $category_arr[$catid]['url'];  
       
        if ($category_arr[$catid]['child']==1) {
            $child_arrary=explode(',',$category_arr[$catid]['arrchildid']);
            //p($child_arrary);exit;
            if($category_arr[$child_arrary[1]]['ismenu']==1) { 
                if($category_arr[$child_arrary[1]]['child']==1){
                    $child_arrary2=explode(',',$category_arr[$child_arrary[1]]['arrchildid']);
                    if($category_arr[$child_arrary2[1]]['ismenu']==1) {
                        
                        $url =$category_arr[$child_arrary2[1]]['url'];

                    }

                }else{
                    $url =$category_arr[$child_arrary[1]]['url'];
                }  
                
             }  
        }
        if(strpos($url, '://') === false) $url = $siteurl.$url;  
        $pos .= '<a href="'.$url.'">'.$category_arr[$catid]['catname'].'</a>'.$symbol; 
        }
         
    }  
    //TMCODE 去最后的分隔符  
    if ($siteid==1) {
        $pos = '<a href="/" >Home</a>'.$symbol.substr($pos,0,-1*strlen($symbol));  
    }else{
        $pos = '<a href="/?siteid=2" >Home</a>'.$symbol.substr($pos,0,-1*strlen($symbol));  
    }
    
    return $pos;  
} 

function format_textarea($string)   
{   
   return nl2br(str_replace(' ', ' ', htmlspecialchars($string)));   
}

// 获取远程文件大小
function remote_filesize($url, $user = "", $pw = "")
{
    ob_start();
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
 
    if(!empty($user) && !empty($pw))
    {
        $headers = array('Authorization: Basic ' .  base64_encode("$user:$pw"));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
 
    $ok = curl_exec($ch);
    curl_close($ch);
    $head = ob_get_contents();
    ob_end_clean();
 
    $regex = '/Content-Length:\s([0-9].+?)\s/';
    $count = preg_match($regex, $head, $matches);
 
    return isset($matches[1]) ? $matches[1] . " 字节" : "unknown";
}

// 获取文件大小
function getfilesize($name){
    $content = file_get_contents($name);
    $size = strlen($content);
    return $size;
}

?>
