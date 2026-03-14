<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_sys_class('model', '', 0);
class comment_model extends model {
	public $table_name;
	public $old_table_name;
	public function __construct() {
		$this->db_config = bc_base::load_config('database');
		$this->db_setting = 'comment';
		$this->table_name = $this->old_table_name = 'comment';
		parent::__construct();
	}
}
?>