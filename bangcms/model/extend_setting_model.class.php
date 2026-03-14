<?php
/**
 * 扩展配置模型类: 自定义扩展配置数据的保存、读取和清除，配置数据支持数组、字符串等任意类型
 * 数据保存在表extend_setting里和缓存里，优先读取缓存
 * 可直接使用以下全局函数：
 * 1、读取：get_extend_setting($key)
 * 2、保存：set_extend_setting($key,$data)
 * 3、删除：clear_extend_setting($key)
 * 
 * @author $Author: jiaokun $
 * @since $Date: 2014-12-17 17:56:10 +0800 (Wed, 17 Dec 2014) $
 * $Id: extend_setting_model.class.php 192 2014-12-17 09:56:10Z jiaokun $
 */
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_sys_class('model', '', 0);
class extend_setting_model extends model {
    /*
     * 是否使用缓存开关
     */
    private static $_use_cache = true;
    /*
     * 缓存：KEY前缀
     */
    private static $_cache_key_prefix = 'ES_';
    /*
     * 缓存：保存路径名
     */
    private static $_cache_pathname = 'esetting';
    
	public function __construct() {
		$this->db_config = bc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'extend_setting';
		parent::__construct();
	}
	/**
	 * get data
	 * @param string $key
	 * @return boolean|mixed
	 */
	public function get($key){
	    if (empty($key)) return false;
	    $key = self::_get_key($key);
	    $data = false;
	    //read cache first
	    if (self::$_use_cache){
	        $data = getcache($key, self::$_cache_pathname);
	    }
	    if (empty($data)){
	        $re = $this->get_one(array('key'=>$key),'data');
	        if (!empty($re) && isset($re['data'])) $data = self::_decode_data($re['data']);
	    }
	    return $data;
	}
	/**
	 * set setting data
	 * @param string $key 配置键值，不能超过25个字符
	 * @param mixed $data 配置数据
	 * @return boolean
	 */
	public function set($key,$data){
	    if (empty($key) || empty($data)) return false;
	    $key = self::_get_key($key);
	    $re = $this->get_one(array('key'=>$key),'id');
	    $data_db = array(
	        'key'=>$key,
            'data'=>self::_encode_data($data),
	    );
	    //save to db
	    if (empty($re)){ //insert
	        $this->insert($data_db);
	    }else{ //update
	        $this->update($data_db,array('id'=>$re['id']));
	    }
	    //update cache
	    if (self::$_use_cache){
	        setcache($key, $data, self::$_cache_pathname);
	    }
	    
	    return true;
	}
	/**
	 * clear data by key
	 * @param string $key
	 * @return boolean
	 */
	public function clear($key){
	    if (empty($key)) return false;
	    $key = self::_get_key($key);
	    //clear db
	    $this->delete(array('key'=>$key));
	    //clear cache
        if (self::$_use_cache){
	        delcache($key, self::$_cache_pathname);
	    }
	    return true;
	}
	/*
	 * 返回保存时实际使用的key
	 */
	private static function _get_key($key){
	    return self::$_cache_key_prefix.$key;
	}
    /*
     * 数据编码
     */
	private static function _encode_data($data){
	    return serialize($data);
	}
	/*
	 * 数据解码
	 */
	private static function _decode_data($data){
	    return unserialize($data);
	}
}
?>