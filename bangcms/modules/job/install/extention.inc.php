<?php
defined('IN_BANGCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'job', 'parentid'=>29, 'm'=>'job', 'c'=>'job', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'add_job', 'parentid'=>$parentid, 'm'=>'job', 'c'=>'job', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'edit_job', 'parentid'=>$parentid, 'm'=>'job', 'c'=>'job', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'delete_job', 'parentid'=>$parentid, 'm'=>'job', 'c'=>'job', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'job_setting', 'parentid'=>$parentid, 'm'=>'job', 'c'=>'job', 'a'=>'setting', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'yingpin', 'parentid'=>$parentid, 'm'=>'job', 'c'=>'job', 'a'=>'yingpin', 'data'=>'', 'listorder'=>0, 'display'=>'1'));

$language = array('job'=>'招聘管理', 'add_job'=>'添加职位','edit_job'=>'编辑职位', 'delete_job'=>'删除职位', 'yingpin'=>'应聘管理', 'job_setting'=>'模块配置');
?>


