<?php
defined('IN_BANGCMS') or exit('No permission resources.');
class index {
	function __construct() {
		$this->db = bc_base::load_model('job_model');
		$this->db2 = bc_base::load_model('job_yingpin_model');
		$this->_userid = param::get_cookie('_userid');
		$this->_username = param::get_cookie('_username');
		$siteid = isset($_GET['siteid']) ? intval($_GET['siteid']) : get_siteid();
  		define("SITEID",$siteid);
	}
	
	//默认操作
	public function init() {
		$SEO = seo(SITEID, '', L('job'), '', '');
		$page = $_GET['page'];
		include template("job","job_list");
	}
	
	//职位详情查看
	public function more(){
		if(!isset($_GET['id']) || empty($_GET['id'])){
			showmessage(L('illegal_action'), HTTP_REFERER);
		}
		//获取模块配置缓存
		$setting = getcache('job', 'commons');
		$set = $setting[SITEID];
		//读取详情数据
		$jobid = intval($_GET['id']);
		$info = $this->db->get_one(array('siteid'=>SITEID,'jobid'=>$jobid));
		extract($info);
		include template('job','job_more');
	}
	
	//应聘操作
	public function yingpin(){
		if(!isset($_GET['jobid']) || empty($_GET['jobid'])) showmessage(L('illegal_action'), HTTP_REFERER);
		if(isset($_POST['dosubmit']) && !empty($_POST['dosubmit'])){
			//添加简历操作
			$_POST['yp']['inputtime'] = $_POST['yp']['updatetime'] = SYS_TIME;
			$_POST['yp']['jobid'] = intval($_GET['jobid']);
			$_POST['yp']['siteid'] = SITEID;
			$_POST['yp']['username'] = $this->_username;
			$_POST['yp']['userid'] = $this->_userid;
			if($this->db2->insert($_POST['yp'],true)){
				//职位简历数量+1
				$this->db->update('`yingpin`=`yingpin`+1', array('jobid'=>$_GET['jobid'], 'siteid'=>SITEID));
				showmessage(L('operation_success'),HTTP_REFERER);
			}else{
				showmessage(L('operation_failure'),HTTP_REFERER);
			}
		}else{
			//获取模块配置缓存
			$setting = getcache('job', 'commons');
			$set = $setting[SITEID];
			pc_base::load_sys_class('form','',0);
			include template('job','job_yingpin');
		}
	}
	
	//检测验证码
	public function code_check() {
		$session_storage = 'session_'.pc_base::load_config('system','session_storage');
		pc_base::load_sys_class($session_storage);
		$code = $_GET['code'];
		if($_SESSION['code'] != strtolower($code)) {
			exit('0');
		} else {
			exit('1');
		}
	}
	
}
?>