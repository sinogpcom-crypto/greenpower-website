<?php
/**
 * 管理员后台会员模块设置
 */

defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin', 'admin', 0);
bc_base::load_sys_class('format', '', 0);

class member_setting extends admin {
	
	private $db;
	const UC_CONFIG_KEY = 'UC_CONFIG';
	function __construct() {
		parent::__construct();
		$this->db = bc_base::load_model('module_model');	
	}

	/**
	 * member list
	 */
	function manage() {
		if(isset($_POST['dosubmit'])) {
			$member_setting = array2string($_POST['info']);
			
			$this->db->update(array('module'=>'member', 'setting'=>$member_setting), array('module'=>'member'));
			setcache('member_setting', $_POST['info']);
			showmessage(L('operation_success'), HTTP_REFERER);
		} else {
			$show_scroll = true;
			$member_setting = $this->db->get_one(array('module'=>'member'), 'setting');
			$member_setting = string2array($member_setting['setting']);
			
			$email_config = getcache('common', 'commons');
			$this->sms_setting_arr = getcache('sms','sms');
			$siteid = get_siteid();
			
			if(empty($email_config['mail_user']) || empty($email_config['mail_password'])) {
				$mail_disabled = 1;
			}
			
			if(!empty($this->sms_setting_arr[$siteid])) {
 				$this->sms_setting = $this->sms_setting_arr[$siteid];
				if($this->sms_setting['sms_enable']=='0'){
					$sms_disabled = 1;
				}else{
					if(empty($this->sms_setting['userid']) || empty($this->sms_setting['productid']) || empty($this->sms_setting['sms_key'])){
					$sms_disabled = 1;
					}
				}
 			} else {
				$sms_disabled = 1;
			}
 			
			include $this->admin_tpl('member_setting');
		}

	}
    /**
     * Ucenter配置管理
     */
	public function uc() {
	    if (isset($_POST['dosubmit'])) {
	        $data = isset($_POST['data']) ? $_POST['data'] : '';
	        $data['ucuse'] = isset($_POST['ucuse']) && intval($_POST['ucuse']) ? intval($_POST['ucuse']) : 0;
	        $filepath = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.'system.php';
	        $config = include $filepath;
	        $uc_config = '<?php '."\ndefine('UC_CONNECT', 'mysql');\n";
	        foreach ($data as $k => $v) {
	            $old[] = "'$k'=>'".(isset($config[$k]) ? $config[$k] : $v)."',";
	            $new[] = "'$k'=>'$v',";
	            $uc_config .= "define('".strtoupper($k)."', '$v');\n";
	        }
	        $html = file_get_contents($filepath);
	        $html = str_replace($old, $new, $html);
	        $uc_config_filepath = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.'uc_config.php';
	        @file_put_contents($uc_config_filepath, $uc_config);
	        @file_put_contents($filepath, $html);
	        //$this->db->insert(array('name'=>'ucenter', 'data'=>array2string($data)), 1,1);
	        set_extend_setting(self::UC_CONFIG_KEY,$data);
	        showmessage(L('operation_success'), HTTP_REFERER);
	    }
	    $data = array();
	    $data = get_extend_setting(self::UC_CONFIG_KEY);
	    include $this->admin_tpl('member_uc');
	}
	/**
	 * 数据库连接测试
	 */
	public function myqsl_test() {
	    $host = isset($_GET['host']) && trim($_GET['host']) ? trim($_GET['host']) : exit('0');
	    $password = isset($_GET['password']) && trim($_GET['password']) ? trim($_GET['password']) : exit('0');
	    $username = isset($_GET['username']) && trim($_GET['username']) ? trim($_GET['username']) : exit('0');
	    if (@mysql_connect($host, $username, $password)) {
	        exit('1');
	    } else {
	        exit('0');
	    }
	}
}
?>