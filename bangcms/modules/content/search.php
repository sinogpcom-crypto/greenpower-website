<?php
defined('IN_BANGCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);

bc_base::load_app_func('util','content');
class search {
	private $db;
	function __construct() {
		$this->db = bc_base::load_model('content_model');
	}
	/**
	 * 按照模型搜索
	 */
	public function init() {
		$page = intval($_GET['page'])?$_GET['page']:1;
		$key = htmlspecialchars($_GET['q']);
		//-----------
		if(isset($_GET['q'])) {
			$pagesize = 4;
			$offset = intval($pagesize*($page-1));
			$where = "where title like '%".$key."%' or description like '%".$key."%'";
			$field = "id,title,thumb,url,description,listorder,updatetime";
			$sql = "select ".$field." from bc_news ".$where." union all select ".$field." from bc_partybuilding ".$where."  union all select ".$field." from bc_enterprise ".$where;
			$this->db->query($sql);
			$total = $this->db->fetch_array();
			$total = count($total);
			if($total!=0) {
				$order = 'listorder desc,id desc';
				$sql .= ' ORDER BY '.$order;
				$sql .= " LIMIT $offset,$pagesize";
				$this->db->query($sql);
				$datas = $this->db->fetch_array();
				$pages = xwjpages($total, $page, $pagesize);
			} else {
				$datas = array();
				$pages = '';
			}
		}
		$SEO = seo(1);
		$SEO['site_title'] = '搜索结果 - '.$SEO['site_title'];
		include template('content','search');
	}
}
?>