<?php
/**
 * Description:
 * 
 * Project:    BANGCMS
 * Encoding:    utf8
 * Created on:  2021-2-05
 * Author:     上海
 * Email:      
 */

defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin', 'admin', 0);
bc_base::load_sys_class('form', '', 0);
class newscount extends admin {

	function __construct() {
		parent::__construct();
		$this->siteid = $this->get_siteid();
		$this->config = getcache('newscount', 'commons');
		$this->db = bc_base::load_model('admin_model');
		$this->role_db = bc_base::load_model('admin_role_model');
	}
	
	public function init() {
		$where = '';
		$start_addtime=$_POST['start_addtime'];
		$end_addtime=$_POST['end_addtime'];
		if($start_addtime && $end_addtime) {
				$start = strtotime($start_addtime.' 00:00:00');
				$end = strtotime($end_addtime.' 23:59:59');
				$where .= "AND `inputtime` >= '$start' AND `inputtime` <= '$end'";	
				$sql .= "AND b.inputtime >= '$start' AND  b.inputtime <= '$end'";		
		}
		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->db->listinfo('',$order = 'userid DESC',$page, $pages = '50');
		$pages = $this->db->pages;
		$roles = getcache('role','commons');
		$this->content_check_db = bc_base::load_model('content_check_model');
		$this->content_db = bc_base::load_model('content_model');
		$modelid = 1;
		$this->content_db->set_model($modelid);
		include $this->admin_tpl('newscount_list');

	}
	public function columncount(){
		
		$admin_user=$this->db->select("",$data="userid,username,realname");
		foreach($admin_user as $y){
			$a_u[$y['userid']]=$y['realname'];
		}

		$where="";
		$timewhere="";
		if($_POST['dosubmit']){
			extract($_POST['info']);
			if($a_user)$where.="userid=$a_user and ";
			if($column)$where.="c.catname='$column' and ";
			if($start_addtime && $end_addtime){
				$start = strtotime($start_addtime.' 00:00:00');
				$end = strtotime($end_addtime.' 23:59:59');
				$where .= "`inputtime` >= '$start' AND `inputtime` <= '$end' and ";
				$timewhere .= " AND `inputtime` >= '$start' AND `inputtime` <= '$end'";

			}
				
		}
		$this->content_check_db = bc_base::load_model('content_check_model');
		$this->content_db = bc_base::load_model("content_model");
		$modelid=1;
		$this->content_db->set_model($modelid);
		//$this->content_check_db->count("`status`= 0  AND `username` = 'bangcms' AND `catid` = '55' $timewhere");exit;
		/*$sql="SELECT a.userid,a.username,a.realname,c.catname,bz.catid,count(1) as counts FROM bc_news bz, bc_category c, bc_admin a WHERE ".$where." bz.islink = 0 AND bz.status = 99 AND bz.catid = c.catid AND bz.username = a.username GROUP BY bz.username, bz.catid";*/
		$sql="SELECT a.userid,a.username,a.realname,c.catname,bz.catid,count(1) as counts FROM bc_news bz, bc_category c, bc_admin a WHERE ".$where." bz.islink = 0  AND bz.catid = c.catid AND bz.username = a.username GROUP BY bz.username, bz.catid";

		$result=$this->content_db->query($sql);

		$re=array();
		while($row=mysql_fetch_array($result)){
			//p($row);exit;
			$re[]=$row;
		};
//p($re);exit;
		include $this->admin_tpl('columncount_list');
	}
	
}
?>