<?php
ini_set("display_errors",false);
error_reporting(0);
/**
 *  index.php BangCMS 入口
 *
 * @copyright			(C) 2009-2014 BangCMS
 * @license				http://builder.netbang.com.cn/license/
 * @lastmodify			2010-6-1
 * $Id: index.php 132 2014-11-12 09:11:04Z jiaokun $
 */


//error_reporting(E_ERROR | E_WARNING | E_PARSE);
// ini_set('display_errors',0);


//定义项目根目录BANGCMS_PATH
define('BANGCMS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

include BANGCMS_PATH.'/bangcms/base.php';

bc_base::creat_app();

?>