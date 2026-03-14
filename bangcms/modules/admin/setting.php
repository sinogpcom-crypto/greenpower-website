<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin','admin',0);
class setting extends admin {
	private $db;
	function __construct() {
		parent::__construct();
		$this->db = bc_base::load_model('module_model');
		bc_base::load_app_func('global');
	}
	
	/**
	 * 配置信息-基本配置
	 */
	public function basic_init() {
		$show_validator = true;
		$setconfig = bc_base::load_config('system');	
		extract($setconfig);
		if(!function_exists('ob_gzhandler')) $gzip = 0;
		$info = $this->db->get_one(array('module'=>'admin'));
		extract(string2array($info['setting']));
		$show_header = true;
		$show_validator = 1;
		
		include $this->admin_tpl('setting');
	}
	
	/**
	 * 配置信息-单点登录
	 */
	public function sso_init() {
		$show_validator = true;
		$setconfig = bc_base::load_config('system');
		extract($setconfig);
		if(!function_exists('ob_gzhandler')) $gzip = 0;
		$info = $this->db->get_one(array('module'=>'admin'));
		extract(string2array($info['setting']));
		$show_header = true;
		$show_validator = 1;
	
		include $this->admin_tpl('setting_sso');
	}
	
	/**
	 * 配置信息-第三方登录
	 */
	public function con_init() {
		$show_validator = true;
		$setconfig = bc_base::load_config('system');
		extract($setconfig);
		if(!function_exists('ob_gzhandler')) $gzip = 0;
		$info = $this->db->get_one(array('module'=>'admin'));
		extract(string2array($info['setting']));
		$show_header = true;
		$show_validator = 1;
	
		include $this->admin_tpl('setting_con');
	}
	
	/**
	 * 配置信息-邮箱配置
	 */
	public function email_init() {
		$show_validator = true;
		$setconfig = bc_base::load_config('system');
		extract($setconfig);
		if(!function_exists('ob_gzhandler')) $gzip = 0;
		$info = $this->db->get_one(array('module'=>'admin'));
		extract(string2array($info['setting']));
		$show_header = true;
		$show_validator = 1;
	
		include $this->admin_tpl('setting_email');
	}
	
	/**
	 * 配置信息-安全设置
	 */
	public function safe_init() {
		$show_validator = true;
		$setconfig = bc_base::load_config('system');
		extract($setconfig);
		if(!function_exists('ob_gzhandler')) $gzip = 0;
		$info = $this->db->get_one(array('module'=>'admin'));
		extract(string2array($info['setting']));
		$show_header = true;
		$show_validator = 1;
	
		include $this->admin_tpl('setting_safe');
	}
	
	/**
	 * 保存配置信息
	 */
	public function save() {
		$setting_indb = false;
		$setting_flag = $_POST['setting_flag'];
		
		//取出需要存入admin模块setting字段的配置
		if ( in_array($setting_flag, array('basic_init', 'safe_init', 'email_init')) ) {
			$info = $this->db->get_one(array('module'=>'admin'));
			$setting = string2array($info['setting']);
			$setting_indb = true;
		}
		
		switch ( $setting_flag ) {
			case 'basic_init':
				//1  setting  setconfig
				$setting['admin_email'] = is_email($_POST['setting']['admin_email']) ? trim($_POST['setting']['admin_email']) : showmessage(L('email_illegal'),HTTP_REFERER);
				$setting['category_ajax'] = intval(abs($_POST['setting']['category_ajax']));
				break;
			case 'safe_init':
				//2  setconfig  setting
				$setting['errorlog_size'] = trim($_POST['setting']['errorlog_size']);
				$setting['maxloginfailedtimes'] = intval($_POST['setting']['maxloginfailedtimes']);
				$setting['minrefreshtime'] = intval($_POST['setting']['minrefreshtime']);
				break;
			case 'email_init':
				//3  setting 
				$setting['mail_type'] = intval($_POST['setting']['mail_type']);
				$setting['mail_server'] = trim($_POST['setting']['mail_server']);
				$setting['mail_port'] = intval($_POST['setting']['mail_port']);
				$setting['mail_user'] = trim($_POST['setting']['mail_user']);
				$setting['mail_auth'] = intval($_POST['setting']['mail_auth']);
				$setting['mail_from'] = trim($_POST['setting']['mail_from']);
				$setting['mail_password'] = trim($_POST['setting']['mail_password']);
				break;
			case 'con_init':
				//4  setconfig
				$snda_error = '';
				//如果开始盛大通行证接入，判断服务器是否支持curl				
				if($_POST['setconfig']['snda_akey'] || $_POST['setconfig']['snda_skey']) {
					if(function_exists('curl_init') == FALSE) {
						$snda_error = L('snda_need_curl_init');
						$_POST['setconfig']['snda_enable'] = 0;
					}
				}
				break;
			case 'sso_init':
				//5  setconfig
				break;
			default:break;
		}
		
		if ( $setting_indb ) {
			$setting = array2string($setting);
			$this->db->update(array('setting'=>$setting), array('module'=>'admin')); //存入admin模块setting字段
		}
		
		if ( $setting_flag != 'email_init' ) {
			set_config($_POST['setconfig']); //保存进config文件
		}
		
		$this->setcache();
		showmessage(L('setting_succ').$snda_error, HTTP_REFERER);
	}
	
	/*
	 * 测试邮件配置
	 */
	public function public_test_mail() {
		bc_base::load_sys_func('mail');
		$subject = 'bangcms test mail';
		$message = 'this is a test mail from bangcms team';
		$mail= Array (
			'mailsend' => 2,
			'maildelimiter' => 1,
			'mailusername' => 1,
			'server' => $_POST['mail_server'],
			'port' => intval($_POST['mail_port']),
			'mail_type' => intval($_POST['mail_type']),
			'auth' => intval($_POST['mail_auth']),
			'from' => $_POST['mail_from'],
			'auth_username' => $_POST['mail_user'],
			'auth_password' => $_POST['mail_password']
		);	
		
		if(sendmail($_GET['mail_to'],$subject,$message,$_POST['mail_from'],$mail)) {
			echo L('test_email_succ').$_GET['mail_to'];
		} else {
			echo L('test_email_faild');
		}	
	}
	
	/**
	 * 设置缓存
	 * Enter description here ...
	 */
	private function setcache() {
		$result = $this->db->get_one(array('module'=>'admin'));
		$setting = string2array($result['setting']);
		setcache('common', $setting,'commons');
	}
}
?>