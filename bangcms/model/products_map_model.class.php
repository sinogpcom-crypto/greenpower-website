<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_sys_class('model', '', 0);
class products_map_model extends model {
	function __construct() {
		$this->db_config = bc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'products_map';
		$this->_username = param::get_cookie('_username');
		$this->_userid = param::get_cookie('_userid');
		parent::__construct();
	}
	/**
	 * 
	 * 添加产品
	 */	
	public function add_product($product,$company,$address,$tel,$fax,$main_products,$siteid) {
			if(empty($product)){
				showmessage('产品名不能为空！',HTTP_REFERER);
			}
			$data = array ();
			$data['product'] = $product;
			$data['company'] = $company;
			$data['address'] = $address;
			$data['tel'] = $tel;
			$data['fax'] = $fax;
			$data['main_products'] = $main_products;
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