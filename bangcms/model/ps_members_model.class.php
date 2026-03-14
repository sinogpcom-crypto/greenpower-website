<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_sys_class('model', '', 0);
class ps_members_model extends model {
	public function __construct() {
		$this->db_config = bc_base::load_config('database');
		$this->db_setting = 'phpsso';
		$this->table_name = 'members';
		parent::__construct();
	}
}
?>