<?php
defined('IN_BANGCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');

$parentid = $menu_db->insert(array('name'=>'products_map', 'parentid'=>29, 'm'=>'products_map', 'c'=>'products_map', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);

$menu_db->insert(array('name'=>'products_list', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'products_map', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'products_add', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'products_map', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'products_update', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'products_map', 'a'=>'update', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'products_delete', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'products_map', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));  


$menu_db->insert(array('name'=>'branch_list', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'image_map', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'branch_add', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'image_map', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'branch_update', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'image_map', 'a'=>'update', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'branch_delete', 'parentid'=>$parentid, 'm'=>'products_map', 'c'=>'image_map', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));   //后台模块菜单不显示，但可用于控制管理员权限


$language = array('products_map'=>'产品地图',
'products_list'=>'产品列表','products_add'=>'添加产品','products_info'=>'查看产品网点','products_update'=>'修改产品信息','products_delete'=>'删除产品',
'branch_list'=>'网点列表','branch_add'=>'添加网点','branch_update'=>'修改网点信息','branch_delete'=>'删除网点');
//如定义的语言与languages下定义的重复，以languages定义的为准
?>