<?php 
/**
 *  model.class.php 数据模型基类
 * 此类封装了数据库操作的常用方法，如数据的CRUD操作、分页查询以及统计等
 * @copyright			(C) 2009-2014 BangCMS
 * @license				http://builder.netbang.com.cn/license/
 * @lastmodify			$Date: 2015-01-28 11:51:08 +0800 (三, 28 1月 2015) $
 * $Id: model.class.php 243 2015-01-28 03:51:08Z shidongdong $
 */
defined('IN_BANGCMS') or exit('Access Denied');
bc_base::load_sys_class('db_factory', '', 0);
class model {
	/**
	 * 所有的数据库配置
	 * @var array
	 */
	protected $db_config = '';
	/**
	 * 数据库连接，即model类的实例
	 * @var object
	 */
	protected $db = '';
	/**
	 * 要连接的数据库的配置项，默认default
	 * @var string
	 */
	protected $db_setting = 'default';
	/**
	 * 数据表名
	 * @var string
	 */
	protected $table_name = '';
	/**
	 * 表前缀
	 * @var string
	 */
	public  $db_tablepre = '';
	/**
	 * 构造方法：进行数据库连接
	 */
	public function __construct() {
		if (!isset($this->db_config[$this->db_setting])) {
			$this->db_setting = 'default';
		}
		$this->table_name = $this->db_config[$this->db_setting]['tablepre'].$this->table_name;
		$this->db_tablepre = $this->db_config[$this->db_setting]['tablepre'];
		$this->db = db_factory::get_instance($this->db_config)->get_database($this->db_setting);
	}
	/**
	 * 返回表名
	 * @return string
	 */
    public function get_table_name(){
        return $this->table_name;
    }
    /**
     * 返回当前数据库连接名
     * @return string
     */
    public function get_db_setting(){
        return $this->db_setting;
    }
	/**
	 * 执行sql查询
	 * @param string $where 		查询条件[例`name`='$name']
	 * @param string $data 		需要查询的字段值[例`name`,`gender`,`birthday`]
	 * @param string $limit 		返回结果范围[例：10或10,10 默认为空]
	 * @param string $order 		排序方式	[默认按数据库默认方式排序]
	 * @param string $group 		分组方式	[默认为空]
	 * @param string $key          返回数组按键名排序
	 * @return array		查询结果集数组
	 */
	final public function select($where = '', $data = '*', $limit = '', $order = '', $group = '', $key='') {
		if (is_array($where)) $where = $this->sqls($where);
		return $this->db->select($data, $this->table_name, $where, $limit, $order, $group, $key);
	}
	/**
	 * 查询多条数据并分页
	 * @param string $where 查询条件[例`name`='$name']
	 * @param string $order 排序方式	[默认按数据库默认方式排序]
	 * @param number $page 当前页码
	 * @param number $pagesize 分页大小
	 * @param string $key 返回数组按键名排序
	 * @param number $setpages 输出的页面链接个数
	 * @param string $urlrule URL规则
	 * @param array $array 需要传递的数组，用于增加额外的方法
	 * @param string $data 需要查询的字段值[例`name`,`gender`,`birthday`]
	 * @return array 返回数据列表
	 *     $this->pages=分页HTML代码
	 *     $this->number=总条数
	 */
	final public function listinfo($where = '', $order = '', $page = 1, $pagesize = 20, $key='', $setpages = 10,$urlrule = '',$array = array(), $data = '*') {
		$where = to_sqls($where);
		$this->number = $this->count($where);
		$page = max(intval($page), 1);
		$offset = $pagesize*($page-1);
		$pagefun = $_GET['c'] == 'index' || $_GET['c'] == 'search'?'xwjpages':'pages';
		$this->pages = $pagefun($this->number, $page, $pagesize, $urlrule, $array, $setpages);
		$this->pages2= pages2($this->number, $page, $pagesize, $urlrule, $array, $setpages);
		$array = array();
		if ($this->number > 0) {
			return $this->select($where, $data, "$offset, $pagesize", $order, '', $key);
		} else {
			return array();
		}
	}
	/**
	 * 查询多条数据并分页－含附属表数据
	 * @param string $where 查询条件[例`name`='$name']
	 * @param string $order 排序方式	[默认按数据库默认方式排序]
	 * @param number $page 当前页码
	 * @param number $pagesize 分页大小
	 * @param string $key 返回数组按键名排序
	 * @param number $setpages 输出的页面链接个数
	 * @param string $urlrule URL规则
	 * @param string $data 需要查询的字段值[例`name`,`gender`,`birthday`]
	 * @return array 返回数据列表
	 *     $this->pages=分页HTML代码
	 *     $this->number=总条数
	 */
	final public function listinfoall($where = '', $order = '', $page = 1, $pagesize = 20, $key='', $setpages = 10,$urlrule = '', $data = '*') {
		$where = to_sqls($where);
		$count_sql = 'SELECT COUNT(*) AS num
		FROM `'.$this->table_name.'` AS m
		LEFT JOIN `'.$this->table_name.'_data` AS s ON m.id=s.id
		WHERE '.$where.'
		LIMIT 1';
		$countx = $this->fetch_array( $this->query($count_sql) );
		$this->number = $countx['0']['num'];
		$page = max(intval($page), 1);
		$offset = $pagesize*($page-1);
		$this->pages = pages($this->number, $page, $pagesize, $urlrule, $array, $setpages);
		$where = str_replace('`id`=','`m`.`id`=',$where);
		$sql = 'SELECT *
		FROM `'.$this->table_name.'` AS m
		LEFT JOIN `'.$this->table_name.'_data` AS s ON m.id=s.id
		WHERE '.$where.'
		ORDER BY '.$order.'
		LIMIT '.$offset.','.$pagesize;
		$return = $this->fetch_array( $this->query($sql) );
		return $return; 
	}
	/**
	 * 获取单条记录查询
	 * @param $where 		查询条件
	 * @param $data 		需要查询的字段值[例`name`,`gender`,`birthday`]
	 * @param $order 		排序方式	[默认按数据库默认方式排序]
	 * @param $group 		分组方式	[默认为空]
	 * @return array/null	数据查询结果集,如果不存在，则返回空
	 */
	final public function get_one($where = '', $data = '*', $order = '', $group = '') {
		if (is_array($where)) $where = $this->sqls($where);
		return $this->db->get_one($data, $this->table_name, $where, $order, $group);
	}
	
	/**
	 * 直接执行sql查询
	 * @param $sql							查询sql语句
	 * @return	boolean/query resource		如果为查询语句，返回资源句柄，否则返回true/false
	 */
	final public function query($sql) {
		$sql = str_replace('bangcms_', $this->db_tablepre, $sql);
		return $this->db->query($sql);
	}
	final  public function mquery($sql)
	{
		$res=$this->query($sql);
		
		$return=array();
		while($row=mysqli_fetch_array($res))
		{
			$return[]=$row;
		}
		mysqli_free_result($res);
		return $return;
	}
	/**
	 * 执行添加记录操作
	 * @param $data 		要增加的数据，参数为数组。数组key为字段值，数组值为数据取值
	 * @param $return_insert_id 是否返回新建ID号
	 * @param $replace 是否采用 replace into的方式添加数据
	 * @return boolean
	 */
	final public function insert($data, $return_insert_id = false, $replace = false) {
		return $this->db->insert($data, $this->table_name, $return_insert_id, $replace);
	}
	
	/**
	 * 获取最后一次添加记录的主键号
	 * @return int 
	 */
	final public function insert_id() {
		return $this->db->insert_id();
	}
	
	/**
	 * 执行更新记录操作
	 * @param $data 		要更新的数据内容，参数可以为数组也可以为字符串，建议数组。
	 * 						<code>为数组时数组key为字段值，数组值为数据取值
	 * 						为字符串时[例：`name`='bangcms',`hits`=`hits`+1]。
	 *						为数组时[例: array('name'=>'bangcms','password'=>'123456')]
	 *						数组的另一种使用array('name'=>'+=1', 'base'=>'-=1');程序会自动解析为`name` = `name` + 1, `base` = `base` - 1</code>
	 * @param $where 		更新数据时的条件,可为数组或字符串
	 * @return boolean
	 */
	final public function update($data, $where = '') {
		if (is_array($where)) $where = $this->sqls($where);
		return $this->db->update($data, $this->table_name, $where);
	}
	
	/**
	 * 执行删除记录操作
	 * @param $where 		删除数据条件,不充许为空。
	 * @return boolean
	 */
	final public function delete($where) {
		if (is_array($where)) $where = $this->sqls($where);
		return $this->db->delete($this->table_name, $where);
	}
	
	/**
	 * 计算记录数
	 * @param string/array $where 查询条件
	 * @return int
	 */
	final public function count($where = '') {
		$r = $this->get_one($where, "COUNT(*) AS num");
		return $r['num'];
	}
	
	/**
	 * 将条件数组转换为SQL语句
	 * @param array $where 要生成的条件数据数组，格式:key=>value
	 * @param string $font 连接串，默认AND
	 * @return string SQL语句
	 */
	final public function sqls($where, $font = ' AND ') {
		if (is_array($where)) {
			$sql = '';
			foreach ($where as $key=>$val) {
				$sql .= $sql ? " $font `$key` = '$val' " : " `$key` = '$val'";
			}
			return $sql;
		} else {
			return $where;
		}
	}
	
	/**
	 * 获取最后数据库操作影响到的条数
	 * @return int
	 */
	final public function affected_rows() {
		return $this->db->affected_rows();
	}
	
	/**
	 * 获取数据表主键
	 * @return array
	 */
	final public function get_primary() {
		return $this->db->get_primary($this->table_name);
	}
	
	/**
	 * 获取表字段
	 * @param string $table_name    表名
	 * @return array
	 */
	final public function get_fields($table_name = '') {
		if (empty($table_name)) {
			$table_name = $this->table_name;
		} else {
			$table_name = $this->db_tablepre.$table_name;
		}
		return $this->db->get_fields($table_name);
	}
	
	/**
	 * 检查表是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	final public function table_exists($table){
		return $this->db->table_exists($this->db_tablepre.$table);
	}
	
	/**
	 * 检查字段是否存在
	 * @param $field 字段名
	 * @return boolean
	 */
	public function field_exists($field) {
		$fields = $this->db->get_fields($this->table_name);
		return array_key_exists($field, $fields);
	}
	/**
	 * 返回数据表的列表
	 * @return array
	 */
	final public function list_tables() {
		return $this->db->list_tables();
	}
	/**
	 * 返回数据结果集
	 * @param $query （mysql_query返回值）
	 * @return array
	 */
	final public function fetch_array() {
		$data = array();
		while($r = $this->db->fetch_next()) {
			$data[] = $r;		
		}
		return $data;
	}
	/**
	 * 返回数据库版本号
	 * @return string
	 */
	final public function version() {
		return $this->db->version();
	}
}