<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin','admin',0);
class custom_map extends admin {
	function __construct() {
		parent::__construct();
		$this->db = bc_base::load_model('custom_map_model');
		$this->_username = param::get_cookie('admin_username');
		$this->_userid = param::get_cookie('userid');
		bc_base::load_sys_class('form');
 		foreach(L('select') as $key=>$value) {
			$trade_status[$key] = $value;
		}
		$this->trade_status = $trade_status;
	} 
	/**
	* 后台
	*/
	public function init() {
			$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
			
			$where = 'siteid = '.$siteid;
			if(isset($_POST['dosubmit'])){
			//搜索
				extract($_POST['search']);
				$where .= " AND name like '%$name%' ";
				if($start_time && $end_time) {
					$start = strtotime($start_time);
					$end = strtotime($end_time);
					$where .= " AND `inserttime` >= '$start' AND `inserttime` <= '$end' " ;
				}
  			}
			$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
 			$infos = $this->db->listinfo($where,$order = 'id DESC',$page, $pages = '12');
 			$pages = $this->db->pages;
 			$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=custom_map&c=custom_map&a=add&\', title:\''.L('add_branch').'\', width:\'850\', height:\'550\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_branch'));
			include $this->admin_tpl('branch_list');
	}
	/**
	 * 添加 
	 */
	public function add() {
			
			if(isset($_POST['dosubmit'])) {
				$name =$_POST['info']['name'];
				$x = $_POST['info']['x'];
				$y = $_POST['info']['y'];
				$siteid =  get_siteid();
				$this->db->add_branch($name,$x,$y,$siteid);
				
				showmessage(L('operation_success'),'?m=custom_map&c=custom_map','','add');
			} else {
				$show_validator = $show_scroll =  true;
			
				include $this->admin_tpl('branch');
			}
	}
	
	/**
	 * 删除
	 * @param	intval	$sid	ID，递归删除
	 */
	public function delete() {
		
		if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
				
			if(is_array($_POST['id'])){
				foreach($_POST['id'] as $id_arr) {
					//批量删除
					$this->db->delete(array('id'=>$id_arr));
				}
				showmessage(L('operation_success'),'?m=custom_map&c=custom_map');
			}else{
				$id = intval($_GET['id']);
				if($id < 1) return false;
				//删除
				$result = $this->db->delete(array('id'=>$id));
				if($result)
				{
					showmessage(L('operation_success'),'?m=custom_map&c=custom_map');
				}else {
					showmessage(L("operation_failure"),'?m=custom_map&c=custom_map');
				}
			}
			showmessage(L('operation_success'), HTTP_REFERER);
		}
	}
	/**
	 * 修改
	 * @param	intval	$sid	ID
	 */
	public function update() {
		$id = intval($_GET['id'])?intval($_GET['id']):intval($_POST['id']);
		if(isset($_POST['dosubmit'])){
			if($id < 1) return false;
			$this->db->update($_POST['info'],array('id'=>$id));
			showmessage(L('operation_success'),'?m=custom_map&c=custom_map','','update');
			
		}else{
 			$show_validator = $show_scroll = $show_header = true;
			bc_base::load_sys_class('form', '', 0);
			
			//内容
			$info = $this->db->get_one(array('id'=>$id));
			extract($info); 
 			include $this->admin_tpl('branch');
		}
	}
	
}
?>