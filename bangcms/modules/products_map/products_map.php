<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin','admin',0);
class products_map extends admin {
	function __construct() {
		parent::__construct();
		$this->db = bc_base::load_model('products_map_model');
		$this->image_db = bc_base::load_model('image_map_model');
		$this->_username = param::get_cookie('admin_username');
		$this->_userid = param::get_cookie('userid');
		bc_base::load_sys_class('form');
 		foreach(L('select') as $key=>$value) {
			$trade_status[$key] = $value;
		}
		$this->trade_status = $trade_status;
	} 
	/**
	* 后台 m=imageMap&c=productsMap&a=init  ,产品列表
	*/
	public function init() {
		
		if(isset($_POST['dosubmit'])){
			//搜索
				$siteid = isset($_POST['siteid']) ? intval($_POST['siteid']) : get_siteid();
				$where = 'siteid = '.$siteid;
				extract($_POST['search']);
				$where .= " AND product like '%$product%' AND company like '%$company%' ";
				if($start_time && $end_time) {
					$start = strtotime($start_time);
					$end = strtotime($end_time);
					$where .= " AND `inserttime` >= '$start' AND `inserttime` <= '$end' " ;
				}
  		}else{
			$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
			$where = 'siteid = '.$siteid;
		}
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
 		$infos = $this->db->listinfo($where,$order = 'listorder DESC,id DESC',$page, $pages = '12');
 		$pages = $this->db->pages;
		$trade_status = $this->trade_status;
			$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=products_map&c=products_map&a=add\', title:\''.L('add_product').'\', width:\'550\', height:\'350\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_product'));
		include $this->admin_tpl('products_list');
	}
	/**
	 * 添加产品 
	 */
	public function add() {
			
			if(isset($_POST['dosubmit'])) {
				$product =$_POST['info']['product'];
				$company = $_POST['info']['company'];
				$address = $_POST['info']['address'];
				$tel =$_POST['info']['tel'];
				$fax = $_POST['info']['fax'];
				$main_products =$_POST['info']['main_products'];
				$siteid =  get_siteid();
				$this->db->add_product($product,$company,$address,$tel,$fax,$main_products,$siteid);
				
				showmessage(L('operation_success'),'?m=products_map&c=products_map','','add');
			} else {
				$show_validator = $show_scroll =  true;
			
				include $this->admin_tpl('product');
			}
	}
	
	/**
	 * 删除产品
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
					$this->image_db->delete(array('parentid'=>$id_arr));
				}
				showmessage(L('operation_success'),'?m=products_map&c=products_map');
			}else{
				$id = intval($_GET['id']);
				if($id < 1) return false;
				//删除
				$result = $this->db->delete(array('id'=>$id));
				$result = $this->image_db->delete(array('parentid'=>$id));
				if($result)
				{
					showmessage(L('operation_success'),'?m=products_map&c=products_map');
				}else {
					showmessage(L("operation_failure"),'?m=products_map&c=products_map');
				}
			}
			showmessage(L('operation_success'), HTTP_REFERER);
		}
	}
	
	/**
	 * 修改产品信息
	 * @param	intval	$sid	ID
	 */
	public function update() {
		$id = intval($_GET['id'])?intval($_GET['id']):intval($_POST['id']);
		$siteid =  get_siteid();
		if(isset($_POST['dosubmit'])){
			if($id < 1) return false;
			$this->db->update($_POST['info'],array('id'=>$id));
			showmessage(L('operation_success'),'?m=products_map&c=products_map','','update');
			
		}else{
 			$show_validator = $show_scroll = $show_header = true;
			bc_base::load_sys_class('form', '', 0);
			
			//内容
			$info = $this->db->get_one(array('id'=>$id,'siteid'=>$siteid));
			extract($info); 
 			include $this->admin_tpl('product');
		}
	}
}
?>