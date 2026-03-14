<?php
/**
 * 会员工具类：用于在关闭SSO单独使用会员模块时的用户名、email校验、头像处理等操作
 * @author jiaokun
 * $Date: 2014-12-01 15:17:39 +0800 (Mon, 01 Dec 2014) $
 * $Id: client_member.class.php 177 2014-12-01 07:17:39Z jiaokun $
 */
class client_member {
    /*
     * 上传地址
     */
    private $_upload_url;
    /*
     * member数据库模型
     */
    private $db;
    /*
     * 应用根url
     */
    private $_api_url;
	public function __construct() {
        $this->_upload_url =  bc_base::load_config('system', 'upload_url');
        $this->_api_url =  APP_PATH;
        $this->db = bc_base::load_model('member_model');
	}
    public function get_api_url(){
        return $this->_api_url;
    }
	/**
	 * 删除用户头像
	 * @param int $uid	用户userid
	 * @return int {1:成功;0:失败}
	 */
	public function delete_avatar($uid) {
	    if (empty($uid)) return 0;
		//图片存储文件夹
	    $dir1 = ceil($uid / 10000);
		$dir2 = ceil($uid % 10000 / 1000);
		$avatarfile = bc_base::load_config('system', 'upload_path').'avatar/';
		$dir = $avatarfile.$dir1.'/'.$dir2.'/'.$uid.'/';
		$this->db->update(array('avatar'=>0), array('userid'=>$uid));
		if(file_exists($dir)) {
		    //目录存在：清除
			if($handle = opendir($dir)) {
			    while(false !== ($file = readdir($handle))) {
					if($file !== '.' && $file !== '..') {
						@unlink($dir.$file);
					}
			    }
			    closedir($handle);
			    @rmdir($dir);
			}
		}
		return 1;
	}

    /**
     * 验证用户名是否存在
     * @param string $username
     * @return number
     * =-1 已存在
     * =1 不存在，可以注册
     */
	public function check_name($username) {
	    $username =  trim($username);
	    if (empty($username)) return -1;
	    if ($this->db->get_one(array('username'=>$username))){
	        return -1;
	    }
	    return 1;
	}
	/**
	 * 验证邮箱是否存在
	 * @param string $email
	 * @return number
     * =-1 已存在
     * =1 不存在，可以注册
	 */
	public function check_email($email) {
	    $email =  trim($email);
	    if (empty($email)) return -1;
	    if ($this->db->get_one(array('email'=>$email))){
	        return -1;
	    }
	    return 1;
	}	
	/**
	 * 根据phpsso uid获取头像url
	 * @param int $uid 用户id
	 * @return array 四个尺寸用户头像数组
	 */
	public function get_avatar($uid) {
		$dir1 = ceil($uid / 10000);
		$dir2 = ceil($uid % 10000 / 1000);
		$url = $this->_upload_url.'avatar/'.$dir1.'/'.$dir2.'/'.$uid.'/';
		$avatar = array('180'=>$url.'180x180.jpg', '90'=>$url.'90x90.jpg', '45'=>$url.'45x45.jpg', '30'=>$url.'30x30.jpg');
		return $avatar;
	}

	/**
	 * 获取上传头像flash的html代码
	 * @param int $uid 用户id
	 */
	public function get_avatar_upload_html($uid) {
		$upurl = base64_encode($this->_api_url.'/index.php?m=member&c=index&a=uploadavatar&uid='.$uid);
		$str = <<<EOF
				<div id="phpsso_uploadavatar_flash"></div>
				<script language="javascript" type="text/javascript" src="{$this->_api_url}/statics/js/swfobject.js"></script>
				<script type="text/javascript">
					var flashvars = {
						'upurl':"{$upurl}&callback=return_avatar&"
					}; 
					var params = {
						'align':'middle',
						'play':'true',
						'loop':'false',
						'scale':'showall',
						'wmode':'window',
						'devicefont':'true',
						'id':'Main',
						'bgcolor':'#ffffff',
						'name':'Main',
						'allowscriptaccess':'always'
					}; 
					var attributes = {
						
					}; 
					swfobject.embedSWF("{$this->_api_url}statics/images/main.swf", "phpsso_uploadavatar_flash", "490", "434", "9.0.0","{$this->$this->_api_url}statics/images/expressInstall.swf", flashvars, params, attributes);

					function return_avatar(data) {
						if(data == 1) {
							window.location.reload();
						} else {
							alert('failure');
						}
					}
				</script> 
EOF;
		return $str;
	}

	/**
	* 将数组转换为字符串
	*
	* @param	array	$data		数组
	* @param	bool	$isformdata	如果为0，则不使用new_stripslashes处理，可选参数，默认为1
	* @return	string	返回字符串，如果，data为空，则返回空
	*/
	public function array2string($data, $isformdata = 1) {
		if($data == '') return '';
		if($isformdata) $data = new_stripslashes($data);
		return var_export($data, TRUE);
	}	
}
?>