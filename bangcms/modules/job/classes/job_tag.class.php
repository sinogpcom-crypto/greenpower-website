<?php 
defined('IN_BANGCMS') or exit('No permission resources.');
class job_tag {
 	private $db,$db2,$siteid;
	
	public function __construct() {
		$this->db = bc_base::load_model('job_model');
		$this->db2 = bc_base::load_model('job_yingpin_model');
		$this->siteid = get_siteid();
 	}
	
	public function count($data) {
		if($data['action'] == 'lists') {
			$siteid = $data['siteid']?$data['siteid']:$this->siteid;
			$sql = "passed=1 and siteid=".$siteid." and enddate>'".date('Y-m-d H:i:s',SYS_TIME)."'";
 			return $this->db->count($sql); 
		}
	}
	
	/**
	 * 获取职位信息
	 * @param  $data 
	 */
	public function lists($data) {
		$siteid = $data['siteid'];
		if (empty($siteid)){ 
			$siteid = $this->siteid;
		}
 		$where = "passed=1 and siteid=".$this->siteid." and enddate>'".date('Y-m-d H:i:s',SYS_TIME)."'";
  		$r = $this->db->select($where, '*', $data['limit'], $data['order']);
		return new_html_special_chars($r);
	}

}
?>