<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin','admin',0);
class job extends admin {
	public $siteid,$username,$job_num,$yingpin_num_unpass,$yingpin_num;
	function __construct() {
		parent::__construct();
		//$this->M = new_html_special_chars(getcache('link', 'commons'));
		$this->db = bc_base::load_model('job_model');
		$this->db2 = bc_base::load_model('job_yingpin_model');
		$this->siteid = $this->get_siteid();
		$this->username = param::get_cookie('admin_username');
		//统计职位 和应聘者数量
		$this->yingpin_num = $this->db2->count(array('siteid'=>$this->siteid));
		$this->yingpin_num_unpass = $this->db2->count(array('passed'=>0,'siteid'=>$this->siteid));
		$this->job_num = $this->db->count();
		$now = date('Y-m-d H:i:s',SYS_TIME);
		$this->job_num_online = $this->db->count("passed=1 and enddate>'".$now."' and siteid=".$this->siteid);
	}

	public function init() {
		$where = array('siteid'=>$this->siteid);
 		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->db->listinfo($where,$order = 'listorder DESC,jobid DESC',$page, $pages = '9');
		$pages = $this->db->pages;
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=job&c=job&a=add\', title:\''.L('add_job').'\', width:\'700\', height:\'450\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_job'));
		include $this->admin_tpl('job_list');
	}

	//添加职位
	public function add(){
		if(isset($_POST['dosubmit'])){
			//完善 post
			$_POST['job']['inputtime'] = $_POST['job']['updatetime'] = SYS_TIME;
			$_POST['job']['siteid'] = $this->siteid;
			$_POST['job']['username'] = $this->username;
			//判断提交是否完整
			if(empty($_POST['job']['zhiwei'])) {
				showmessage(L('zhiwei').L('noempty'),HTTP_REFERER);
			}
/* 		if(empty($_POST['job']['renshu'])) {
				showmessage(L('renshu').L('noempty'),HTTP_REFERER);
			}  */
		if(empty($_POST['job']['diqu'])) {
				showmessage(L('diqu').L('noempty'),HTTP_REFERER);
			} 
			if(empty($_POST['job']['content'])) {
				showmessage(L('content').L('noempty'),HTTP_REFERER);
			}
			/*
			if(empty($_POST['job']['lianxiren'])) {
				showmessage(L('lianxiren').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['tel'])) {
				showmessage(L('tel').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['email'])) {
				showmessage(L('email').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['address'])) {
				showmessage(L('address').L('noempty'),HTTP_REFERER);
			} 
			*/
 			if($this->db->insert($_POST['job'],true)){
				showmessage(L('operation_success'),HTTP_REFERER,'', 'add');
			}else{
				showmessage(L('operation_failure'),HTTP_REFERER);
			} 
			
		}else{
			$show_validator = $show_scroll = $show_header = true;
			bc_base::load_sys_class('form', '', 0);
			include $this->admin_tpl('job_add');
		}
	}
	
	//编辑职位
	public function edit(){
		$_GET['jobid'] = intval($_GET['jobid']);
		if (!$_GET['jobid']) showmessage(L('illegal_action'), HTTP_REFERER);	
		if(isset($_POST['dosubmit'])){
			//完善 post
			$_POST['job']['updatetime'] = SYS_TIME;
			//判断提交是否完整
			if(empty($_POST['job']['zhiwei'])) {
				showmessage(L('zhiwei').L('noempty'),HTTP_REFERER);
			}
/* 			 if(empty($_POST['job']['renshu'])) {
				showmessage(L('renshu').L('noempty'),HTTP_REFERER);
			}  */
			if(empty($_POST['job']['diqu'])) {
				showmessage(L('diqu').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['content'])) {
				showmessage(L('content').L('noempty'),HTTP_REFERER);
			}
			/* if(empty($_POST['job']['lianxiren'])) {
				showmessage(L('lianxiren').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['tel'])) {
				showmessage(L('tel').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['email'])) {
				showmessage(L('email').L('noempty'),HTTP_REFERER);
			}
			if(empty($_POST['job']['address'])) {
				showmessage(L('address').L('noempty'),HTTP_REFERER);
			} */
			
			if($this->db->update($_POST['job'], array('jobid'=>$_GET['jobid'], 'siteid'=>$this->siteid))){
				showmessage(L('operation_failure'),HTTP_REFERER,'', 'edit');
			}else{
				showmessage(L('operation_success'),HTTP_REFERER);
			}
			
		}else{
			if( !isset($_GET['jobid']) || empty($_GET['jobid']) ) {
				showmessage(L('illegal_parameters'), HTTP_REFERER);
			} else { 
				$jobid = intval($_GET['jobid']);
				$info = $this->db->get_one(array('jobid'=>$jobid));
				if(!$info) showmessage(L('zhiwei').L('noexit'));;
				extract($info); 
				$show_validator = $show_scroll = $show_header = true;
				bc_base::load_sys_class('form', '', 0);
				include $this->admin_tpl('job_edit');
			}
		}
	}
	
	//单个审核
 	public function check(){
		if( !isset($_GET['jobid']) || empty($_GET['jobid']) || !isset($_GET['pass']) ) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else { 
			$jobid = intval($_GET['jobid']);
			$pass = intval($_GET['pass']);
			if($jobid < 1) return false;
			//更新状态
			$result = $this->db->update(array('passed'=>$pass),array('jobid'=>$jobid),array('siteid'=>$this->siteid));
			if($result){
				showmessage(L('operation_success'),'?m=job&c=job');
			}else {
				showmessage(L("operation_failure"),'?m=job&c=job');
			}
			 
		}
	}

	//更新排序
 	public function listorder() {
		if(isset($_POST['dosubmit'])) {
			foreach($_POST['listorders'] as $jobid => $listorder) {
				$this->db->update(array('listorder'=>$listorder),array('jobid'=>$jobid));
			}
			showmessage(L('operation_success'),HTTP_REFERER);
		} 
	}
	
	/**
	 * 删除
	 * @param	intval	$sid	友情链接ID，递归删除
	 */
	public function delete() {
  		if((!isset($_GET['jobid']) || empty($_GET['jobid'])) && (!isset($_POST['jobid']) || empty($_POST['jobid']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
			if(is_array($_POST['jobid'])){
				foreach($_POST['jobid'] as $jobid_arr) {
 					//批量删除友情链接
					$this->db->delete(array('jobid'=>$jobid_arr));
				}
				showmessage(L('operation_success'),'?m=job&c=job');
			}else{
				$jobid = intval($_GET['jobid']);
				if($jobid < 1) return false;
				//删除友情链接
				$result = $this->db->delete(array('jobid'=>$jobid));
				if($result){
					showmessage(L('operation_success'),'?m=job&c=job');
				}else {
					showmessage(L("operation_failure"),'?m=job&c=job');
				}
			}
			showmessage(L('operation_success'), HTTP_REFERER);
		}
	}
	
	
	/*
	 * 应聘者管理
	 */
	public function yingpin(){
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=job&c=job&a=add\', title:\''.L('add_job').'\', width:\'700\', height:\'450\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_job'));
		$show_validator = $show_scroll = 1;
		//获取所有简历
		if(isset($_GET['jobid']) && !empty($_GET['jobid'])){
			$jobid = intval($_GET['jobid']);
			$where = array('siteid'=>$this->siteid,'jobid'=>$jobid);
		}elseif(isset($_GET['pass']) && !empty($_GET['pass'])){
			$pass = intval($_GET['pass']);
			$where = array('siteid'=>$this->siteid,'pass'=>$pass);
		}else{
			$where = array('siteid'=>$this->siteid);
		}
 		$page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
		$infos = $this->db2->listinfo($where,$order = 'listorder DESC,ypid DESC',$page, $pages = '9');
		$pages = $this->db2->pages;
		include $this->admin_tpl('job_yingpin');
	}
	
	//应聘者更新排序
 	public function yp_listorder() {
		if(isset($_POST['dosubmit'])) {
			foreach($_POST['listorders'] as $id => $listorder) {
				$this->db2->update(array('listorder'=>$listorder),array('ypid'=>$id));
			}
			showmessage(L('operation_success'),HTTP_REFERER);
		} 
	}
	
	public function yp_more(){
		if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
			exit();
		}
		if(isset($_POST['dosubmit'])){
			$_POST['yp']['updatetime'] = SYS_TIME;
			if($this->db2->update($_POST['yp'],array('ypid'=>intval($_GET['id']),'siteid'=>$this->siteid))){
				showmessage(L('operation_success'),HTTP_REFERER,'', 'more');
			}else{
				showmessage(L('operation_failure'),HTTP_REFERER);
			}
		}else {
			$show_validator = $show_scroll = $show_header = true;
			$ypid = intval($_GET['id']);
			$info = $this->db2->get_one(array('ypid'=>$ypid,'siteid'=>$this->siteid));
			extract($info);
			include $this->admin_tpl('job_yingpin_more');
		}		
	}
	
	/**
	 * 删除
	 * @param	intval	$sid	友情链接ID，递归删除
	 */
	public function yp_delete() {
  		if((!isset($_GET['ypid']) || empty($_GET['ypid'])) && (!isset($_POST['ypid']) || empty($_POST['ypid']))) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else {
			if(is_array($_POST['ypid'])){
				foreach($_POST['ypid'] as $ypid_arr) {
 					//批量删除
					$this->db2->delete(array('ypid'=>$ypid_arr));
				}
				showmessage(L('operation_success'),HTTP_REFERER);
			}else{
				$ypid = intval($_GET['ypid']);
				if($ypid < 1) return false;
				//删除
				$result = $this->db2->delete(array('ypid'=>$ypid));
				if($result){
					showmessage(L('operation_success'),HTTP_REFERER);
				}else {
					showmessage(L("operation_failure"),HTTP_REFERER);
				}
			}
			showmessage(L('operation_success'), HTTP_REFERER);
		}
	}
	
	//简历审核
 	public function yp_check(){
		if( !isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['pass']) ) {
			showmessage(L('illegal_parameters'), HTTP_REFERER);
		} else { 
			$id = intval($_GET['id']);
			$pass = intval($_GET['pass']);
			if($id < 1) return false;
			//更新状态
			$result = $this->db2->update(array('passed'=>$pass),array('ypid'=>$id),array('siteid'=>$this->siteid));
			if($result){
				showmessage(L('operation_success'),HTTP_REFERER);
			}else {
				showmessage(L("operation_failure"),HTTP_REFERER);
			}
			 
		}
	}
	
	/*
	 *判断标题重复和验证 
	 */
	public function public_check_zhiwei() {
		$zhiwei_title = isset($_GET['zhiwei']) && trim($_GET['zhiwei']) ? (bc_base::load_config('system', 'charset') == 'gbk' ? iconv('utf-8', 'gbk', trim($_GET['zhiwei'])) : trim($_GET['zhiwei'])) : exit('0');
		$jobid = isset($_GET['jobid']) && intval($_GET['jobid']) ? intval($_GET['jobid']) : '';
		$data = array();
		if ($jobid) {
			$data = $this->db->get_one(array('jobid'=>$jobid), 'zhiwei');
			if (!empty($data) && $data['zhiwei'] == $zhiwei_title) {
				exit('1');
			}
		}
		if ($this->db->get_one(array('zhiwei'=>$zhiwei_title), 'jobid')) {
			exit('0');
		} else {
			exit('1');
		}
	}
	
	/*
	 * 模块设置
	 */
	public function setting() {
		//读取配置文件
		$data = array();
 		$siteid = $this->siteid;//当前站点 
		//更新模型数据库,重设setting 数据. 
		$m_db = bc_base::load_model('module_model');
		$data = $m_db->select(array('module'=>'job'));
		$setting = string2array($data[0]['setting']);
		$now_seting = $setting[$siteid]; //当前站点配置
		if(isset($_POST['dosubmit'])) {
			//多站点存储配置文件
 			$setting[$siteid] = $_POST['setting'];
  			setcache('job', $setting, 'commons');  
			//更新模型数据库,重设setting 数据. 
  			$m_db = bc_base::load_model('module_model'); //调用模块数据模型
			$set = array2string($setting);
			$m_db->update(array('setting'=>$set), array('module'=>ROUTE_M));
			showmessage(L('setting_updates_successful'), '?m=job&c=job&a=init');
		} else {
			@extract($now_seting);
			$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=job&c=job&a=add\', title:\''.L('add_job').'\', width:\'700\', height:\'450\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_job'));
 			include $this->admin_tpl('setting');
		}
	}
}
?>