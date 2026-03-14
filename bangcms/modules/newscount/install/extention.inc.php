<?php
/**
 * Description:
 * 
 * Project:    BANGCMS
 * Encoding:    utf8
 * Created on:  2013-12-05
 * Author:     上海
 * Email:       hshanghai@qq.com
 */
defined('IN_BANGCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'newscount', 'parentid'=>'821', 'm'=>'newscount', 'c'=>'newscount', 'a'=>'init', 'data'=>'', 'listorder'=>16, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'rolecount', 'parentid'=>$parentid, 'm'=>'newscount', 'c'=>'newscount', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name' =>'columncount', 'parentid' => $parentid, 'm' => 'newscount', 'c' => 'newscount', 'a' => 'columncount', 'data' => '', 'listorder' => 1, 'display' => '1' ) );
$language = array('newscount'=>'投稿统计', 'rolecount'=>'角色统计','columncount'=>'栏目统计');
?>