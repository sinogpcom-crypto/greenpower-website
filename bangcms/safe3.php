<?php
//Code By Safe3 
//Add HTTP_REFERER by D.
$referer=empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
function customError($errno, $errstr, $errfile, $errline){ 
 echo "<b>Error number:</b> [$errno],error on line $errline in $errfile<br />";
 die();
}

set_error_handler("customError",E_ERROR);
$getfilter="'|\\b(and|or)\\b.+?(>|<|=|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){
	
	//----------peng's code for adminer.php------------//
	if (preg_match("/^\/adminer\/adminer\.php$/i", $_SERVER["PHP_SELF"]) ==1) return;
	if (preg_match("/^\/index\.php\?m=content&c=create_html/i", $_SERVER["REQUEST_URI"]) ==1) return;
	//-----------2016/11/27 17:58:15-------------//
	
	$StrFiltValue=arr_foreach($StrFiltValue);
	if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){   
	  $r=slog("<br><br>操作IP: ".$_SERVER["REMOTE_ADDR"]."<br>操作时间: ".strftime("%Y-%m-%d %H:%M:%S")."<br>操作页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."<br>提交参数: ".$StrFiltKey."<br>提交数据: ".$StrFiltValue);
	  msg("<div style=\"position:fixed;top:0px;width:100%;height:100%;background-color:white;color:green;font-weight:bold;border-bottom:5px solid #999;\"><br>您的提交带有不合法参数!".($r?" #":"x")."</div>");
	}
	if (preg_match("/".$ArrFiltReq."/is",$StrFiltKey)==1){   
		$r=slog("<br><br>操作IP: ".$_SERVER["REMOTE_ADDR"]."<br>操作时间: ".strftime("%Y-%m-%d %H:%M:%S")."<br>操作页面:".$_SERVER["PHP_SELF"]."<br>提交方式: ".$_SERVER["REQUEST_METHOD"]."<br>提交参数: ".$StrFiltKey."<br>提交数据: ".$StrFiltValue);
		msg( "<div style=\"position:fixed;top:0px;width:100%;height:100%;background-color:white;color:green;font-weight:bold;border-bottom:5px solid #999;\"><br>您的提交带有不合法参数! </div>");
	}
}

//$ArrPGC=array_merge($_GET,$_POST,$_COOKIE);
foreach($_GET as $key=>$value){ 
	StopAttack($key,$value,$getfilter);
}

foreach($_POST as $key=>$value){ 
	StopAttack($key,$value,$postfilter);
}

foreach($_COOKIE as $key=>$value){ 
	StopAttack($key,$value,$cookiefilter);
}

foreach($referer as $key=>$value){ 
  StopAttack($key,$value,$getfilter);
}

if (file_exists('update360.php')) {
	msg( "请重命名文件update360.php，防止黑客利用<br/>");
}

function slog($logs){
  $toppath=$_SERVER["DOCUMENT_ROOT"]."/caches/log.htm";
  //$toppath="/var/www/360safe.log";
  
  if($Ts=fopen($toppath,"a+")){
  	$r=fputs($Ts,$logs."\r\n");
  	fclose($Ts);
  	return $r;
  }
  return $r;
}

function arr_foreach($arr) {
  static $str;
  if (!is_array($arr)) {
  return $arr;
  }
  foreach ($arr as $key => $val ) {

    if (is_array($val)) {

        arr_foreach($val);
    } else {

      $str[] = $val;
    }
  }
  return implode($str);
}

//code by pengjinzhu 2016/11/23 22:43:21
function msg($str){
	header('Content-Type:text/html; charset=gb2312');
	exit($str);
}
?>