<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin','admin',0);

class phpsso extends admin {
	function __construct() {
		parent::__construct();
	}
	
	function menu() {
	}
	
	
	function public_menu_left() {
		$setting = bc_base::load_config('system');

		include $this->admin_tpl('phpsso');
	}
}
?>