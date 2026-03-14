<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_sys_class('model', '', 0);
class image_map_model extends model {
	function __construct() {
		$this->db_config = bc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'image_map';
		$this->_username = param::get_cookie('_username');
		$this->_userid = param::get_cookie('_userid');
		parent::__construct();
	}
	/**
	 * 
	 * 添加
	 */	
	public function add_branch($name,$x,$y,$pid,$siteid) {
			if(empty($name)){
				showmessage('网点名不能为空！',HTTP_REFERER);
			}
			$data = array ();
			$data['name'] = $name;
			$data['x'] = $x;
			$data['y'] = $y;
			$data['parentid'] = $pid;
			$data['inserttime'] = time();
			$data['siteid'] = $siteid;

			$id = $this->insert($data,true);
			if(!$id){
				return FALSE;
			}else {
				return true;
			}
	}
}
?>