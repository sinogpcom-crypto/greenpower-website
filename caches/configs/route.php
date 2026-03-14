<?php
/**
 * 路由配置文件
 * 默认配置为default如下：
 * 'default'=>array(
 * 	'm'=>'bangcms', 
 * 	'c'=>'index', 
 * 	'a'=>'init', 
 * 	'data'=>array(
 * 		'POST'=>array(
 * 			'catid'=>1
 * 		),
 * 		'GET'=>array(
 * 			'contentid'=>1
 * 		)
 * 	)
 * )
 * 基中“m”为模型,“c”为控制器，“a”为事件，“data”为其他附加参数。
 * data为一个二维数组，可设置POST和GET的默认参数。POST和GET分别对应PHP中的$_POST和$_GET两个超全局变量。在程序中您可以使用$_POST['catid']来得到data下面POST中的数组的值。
 * data中的所设置的参数等级比较低。如果外部程序有提交相同的名字的变量，将会覆盖配置文件中所设置的值。如：
 * 外部程序POST了一个变量catid=2那么你在程序中使用$_POST取到的值是2，而不是配置文件中所设置的1。
 */
return array(
	'default'=>array('m'=>'content', 'c'=>'index', 'a'=>'init'),
     /*
      * 自定义域名路由：
      * 当SITE_URL等于sub.domain.com时，则路由到指定的m-c-a里。此配置优先级高于default配置
      */
    //'sub.domain.com'=>array('m'=>'test', 'c'=>'index', 'a'=>'init'),
);