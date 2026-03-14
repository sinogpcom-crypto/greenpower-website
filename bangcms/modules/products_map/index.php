<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_sys_class('form', '', 0);
//bc_base::load_app_class('foreground','member');//加载foreground 应用类. 自动判断是否登陆.
//bc_base::load_sys_class('format', '', 0);

class index {
	function __construct() {
		$this->imageMap_db = bc_base::load_model('imageMAp_model');
		//$this->_username = param::get_cookie('_username');
		//$this->_userid = param::get_cookie('_userid');
		//$this->_groupid = get_memberinfo($this->_userid,'groupid');
		bc_base::load_app_func('global');
		//定义站点ID常量，选择模版使用
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
  		define("SITEID",$siteid);
  	}
	
	/**
	 * 留言列表
	 * 前台URL访问 m=words&c=index&a=init
	 */
	public function init() {
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
		$where = 'siteid = '.$siteid;
 		$infos = $this->words_db->listinfo($where,$order = 'id DESC',$page, 10);
 		$infos = new_html_special_chars($infos);
 		$pages = $this->words_db->pages;
		include template('words', 'list');  //前台调用list模板
	}
	
	/**
	 * 发送消息 
	 */
	public function send() {
			$name = new_html_special_chars($_POST['info']['name']);
			$content = new_html_special_chars($_POST['info']['content']);
			$contact = new_html_special_chars($_POST['info']['contact']);
			$siteid = new_html_special_chars($_POST['info']['siteid']);
			$this->words_db->add_words($name,$content,$contact,$siteid);
			showmessage(L('operation_success'),HTTP_REFERER);
			
	}
		
	/**
	 * 发消息表单
	 */
	public function sendform() { 
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
		include template('words', 'send');
	}
	
}	
?>	