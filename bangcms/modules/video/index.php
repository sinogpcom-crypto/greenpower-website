<?php 
defined('IN_BANGCMS') or exit('No permission resources.');

/**
 * 
 * ------------------------------------------
 * index
 * ------------------------------------------
 * @package 	BangCMS
 * @author		
 * @copyright	
 * 
 */

class index{
	public $db;
	public function __construct() { 
		bc_base::load_app_class('ku6api', 'video', 0);
		$this->userid = param::get_cookie('userid');
		$this->setting = getcache('video');
		if(empty($this->setting)) {
			showmessage(L('module_not_exists'));
		}
		$this->ku6api = new ku6api($this->setting['sn'], $this->setting['skey']);
	}
	
	/**
	 * 
	 * 视频列表
	 */
	public function init() {
		 showmessage('正在转向首页...','index.php');
	}
	
	/**
	* 播放清单，播放页
	*/
	public function playlist(){
		bc_base::load_app_func('util','content');
		if(isset($_GET['siteid'])) {
			$siteid = intval($_GET['siteid']);
		} else {
			$siteid = 1;
		}
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');
		$title = strip_tags($_GET['title']);
		$contentid = intval($_GET['contentid']);
		$catid = intval($_GET['catid']);
 		$video_info = get_vid($contentid, $catid, $isspecial = 0);
  		include template('content','show_videolist');
	} 
	
	/**
	* 视频专辑列表页
	* index.php?m=video&c=index&a=album
	*/
	public function album(){
		bc_base::load_app_func('util','content');
		$spid = $_GET['spid'];
		$page = $_GET['page'];
		if(isset($_GET['siteid'])) {
			$siteid = intval($_GET['siteid']);
		} else {
			$siteid = 1;
		}
 		include template('content','video_album');
	}
	
	
	
}

?>