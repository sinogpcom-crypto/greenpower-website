<?php
defined('IN_BANGCMS') or exit('No permission resources.');

bc_base::load_app_class('admin','admin',0);
bc_base::load_sys_class('push_factory', '', 0);
//权限判断，根据栏目里面的权限设置检查	
if((isset($_GET['catid']) || isset($_POST['catid'])) && $_SESSION['roleid'] != 1) {
	$catid = isset($_GET['catid']) ? intval($_GET['catid']) : intval($_POST['catid']);
	$this->priv_db = bc_base::load_model('category_priv_model');
	$priv_datas = $this->priv_db->get_one(array('catid'=>$catid,'is_admin'=>1,'action'=>'push'));
	if(!$priv_datas['catid']) showmessage(L('permission_to_operate'),'blank');
}

class push extends admin {
	
	public function __construct() {
		parent::__construct();
		$this->siteid = $this->get_siteid();
		$module = (isset($_GET['module']) && !empty($_GET['module'])) ? $_GET['module'] : 'admin';
		if (in_array($module, array('admin', 'special','content'))) {
			$this->push = push_factory::get_instance()->get_api($module);
		} else {
			showmessage(L('not_exists_push'), 'blank');
		}
	}
	
	/**
	 * 推送选择界面
	 */
	public function init() {
		if ($_POST['dosubmit']) {
			$c = bc_base::load_model('detail_model');
			$c->set_model($_POST['modelid']);
			$info = array();
			$ids = explode('|', $_POST['id']);
			if(is_array($ids)) {
				foreach($ids as $id) {
					$info[$id] = $c->get_one(array('id'=>$id));//$info[$id] = $c->get_content($_POST['catid'], $id);
					$info[$id]['n_relation_field'] = $_POST['n_relation_field'];
					$info[$id]['n_pid'] = $_POST['n_pid'];
					$c->table_name = $c->table_name.'_data';
					$temp_data = $c->get_one(array('id'=>$id));
					if($temp_data) {
						$info[$id] = array_merge($info[$id],$temp_data);
					}
					$c->table_name = rtrim($c->table_name, '_data');
				}
			}
			$_GET['add_action'] = $_GET['add_action'] ? $_GET['add_action'] : $_GET['action']; 
			//echo $_GET['add_action'];exit;
			$this->push->$_GET['add_action']($info, $_POST);
			showmessage(L('success'), '', '', 'push');
		} else {
			$relation_field = $_GET['relation_field'];
			$pid = intval($_GET['pid']);
			
			bc_base::load_app_func('global', 'template');
			if (method_exists($this->push, $_GET['action'])) {
				$html = $this->push->{$_GET['action']}(array('modelid'=>$_GET['modelid'], 'catid'=>$_GET['catid']));
				$tpl = isset($_GET['tpl']) ? 'push_to_category' : 'push_list';
				include $this->admin_tpl($tpl);
			} else {
				showmessage('CLASS METHOD NO EXISTS!', 'blank');
			}
		}
	}
	
	public function public_ajax_get() {
		if (method_exists($this->push, $_GET['action'])) {
			$html = $this->push->{$_GET['action']}($_GET['html']);
			echo $html;
		} else {
			echo 'CLASS METHOD NO EXISTS!';
		}
	}
}
?>