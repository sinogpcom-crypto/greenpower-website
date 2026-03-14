<?php
defined('IN_BANGCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');

$parentid = $menu_db->insert(array('name'=>'custom_map', 'parentid'=>29, 'm'=>'custom_map', 'c'=>'custom_map', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);

$menu_db->insert(array('name'=>'branch_list', 'parentid'=>$parentid, 'm'=>'custom_map', 'c'=>'custom_map', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'branch_add', 'parentid'=>$parentid, 'm'=>'custom_map', 'c'=>'custom_map', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'branch_update', 'parentid'=>$parentid, 'm'=>'custom_map', 'c'=>'custom_map', 'a'=>'update', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'branch_delete', 'parentid'=>$parentid, 'm'=>'custom_map', 'c'=>'custom_map', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));  


$language = array('custom_map'=>'自定义地图','branch_list'=>'网点列表','branch_add'=>'添加网点','branch_update'=>'修改网点信息','branch_delete'=>'删除网点');

?>