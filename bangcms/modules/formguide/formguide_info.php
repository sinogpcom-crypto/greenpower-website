<?php
defined('IN_BANGCMS') or exit('No permission resources.');
bc_base::load_app_class('admin','admin',0);

class formguide_info extends admin {
	
	private $db, $f_db, $tablename;
	public function __construct() {
		parent::__construct();
		$this->db = bc_base::load_model('sitemodel_field_model');
		$this->f_db = bc_base::load_model('sitemodel_model');
		if (isset($_GET['formid']) && !empty($_GET['formid'])) {
			$formid = intval($_GET['formid']);
			$f_info = $this->f_db->get_one(array('modelid'=>$formid, 'siteid'=>$this->get_siteid()), 'tablename');
			$this->tablename = 'form_'.$f_info['tablename'];
			$this->db->change_table($this->tablename);
		}
	}
	
	/**
	 * 用户提交表单信息列表
	 */
	public function init() {
		if (!isset($_GET['formid']) || empty($_GET['formid'])) {
			showmessage(L('illegal_operation'), HTTP_REFERER);
		}
		$formid = intval($_GET['formid']);
		if (!$this->tablename) {
			$f_info = $this->f_db->get_one(array('modelid'=>$formid, 'siteid'=>$this->get_siteid()), 'tablename');
			$this->tablename = 'form_'.$f_info['tablename'];
			$this->db->change_table($this->tablename);
		}
		$page = max(intval($_GET['page']), 1);
		$r = $this->db->get_one(array(), "COUNT(dataid) sum");
		$total = $r['sum'];
		$this->f_db->update(array('items'=>$total), array('modelid'=>$formid));
		$pages = pages($total, $page, 20);
		$offset = ($page-1)*20;
		$datas = $this->db->select(array(), '*', $offset.', 20', '`dataid` DESC');
		$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=formguide&c=formguide&a=add\', title:\''.L('formguide_add').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('formguide_add'));
		$right_menu = array('?m=formguide&c=formguide_info&a=export_excel&formid='.$formid.'&pc_hash='.$_GET['pc_hash'],'导出Excel');
		include $this->admin_tpl('formguide_info_list');
	}
	
	/**
	 * 查看
	 */
	public function public_view() {
		if (!$this->tablename || !isset($_GET['did']) || empty($_GET['did'])) showmessage(L('illegal_operation'), HTTP_REFERER);
		$did = intval($_GET['did']);
		$formid = intval($_GET['formid']);
		$info = $this->db->get_one(array('dataid'=>$did));

		bc_base::load_sys_class('form', '', '');
		define('CACHE_MODEL_PATH',BANGCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
		require CACHE_MODEL_PATH.'formguide_output.class.php';
		$formguide_output = new formguide_output($formid);
		$forminfos_data = $formguide_output->get($info);
		$fields = $formguide_output->fields;
		include $this->admin_tpl('formguide_info_view');
	}
	
	/**
	 * 删除
	 */
	public function public_delete() {
		$formid = intval($_GET['formid']);
		if (isset($_GET['did']) && !empty($_GET['did'])) {
			$did = intval($_GET['did']);
			$this->db->delete(array('dataid'=>$did));
			$this->f_db->update(array('items'=>'-=1'), array('modelid'=>$formid));
			showmessage(L('operation_success'), HTTP_REFERER);
		} else if(is_array($_POST['did']) && !empty($_POST['did'])) {
			foreach ($_POST['did'] as $did) {
				$did = intval($did);
				$this->db->delete(array('dataid'=>$did));
				$this->f_db->update(array('items'=>'-=1'), array('modelid'=>$formid));
			}
			showmessage(L('operation_success'), HTTP_REFERER);
		} else {
			showmessage(L('illegal_operation'), HTTP_REFERER);
		}
	}
	
	/**
	 * 导出excel
	 */
	public function  export_excel(){
		$formid = intval($_GET['formid']);
		$resultPHPExcel= bc_base::load_sys_class('PHPExcel');
		
		$field = $this->db->get_fields($this->tablename);
		$num = count($field);
		$arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$i = 0;
		$box = array();
		$is_box = array();
		foreach($field as $k=>$f){
			$this->db->change_table('model_field');
			$result = $this->db->get_one(array('modelid'=>$formid, 'siteid'=>$this->get_siteid(),'field'=>$k),'field,name,setting,formtype');
			$name = $name?$result['name']:$k;
			$resultPHPExcel->getActiveSheet()->setCellValue($arr[$i].'1', $name);
			//保存box类型选项值
			if(isset($result['formtype'])&&$result['formtype']=='box'){
				array_push($is_box,$result['field']);
				$setting = string2array($result['setting']);
				$box_value = explode("\n",$setting['options']);
				foreach ($box_value as $v) {
					$value = explode("|",$v);
					$box[$result['field']][trim($value[1])] = $value[0];
				}
			}
			$i++;
			if($i>=26){
				$column = $arr[($i/26)-1].$arr[$i%26];
				array_push($arr,$column);
			}
		}
		
		$this->db->change_table($this->tablename);
		$info = $this->db->select();
		$j=2;
		foreach($info as $data){
			$i=0;
			foreach($data as $f =>$v){
				if($f=='datetime'&&is_numeric($v)){
					$v = date('Y-m-d',$v); 
				}
				if(in_array($f,$is_box)){
					$v = $box[$f][$v];
				}
				$resultPHPExcel->getActiveSheet()->setCellValueExplicit($arr[$i].$j, $v); 
				$i++;
			}
			$j++;
		}
		//设置导出文件名 
		$excel_name = $this->f_db->get_one(array('modelid'=>$formid, 'siteid'=>$this->get_siteid()), 'name');
		$outputFileName = $excel_name['name'].'.xls'; 
		$xlsWriter = new PHPExcel_Writer_Excel5($resultPHPExcel); 
		//ob_start(); ob_flush(); 
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream"); 
		header("Content-Type: application/download"); 
		header('Content-Disposition:inline;filename="'.$outputFileName.'"'); 
		header("Content-Transfer-Encoding: binary"); 
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Pragma: no-cache"); 
		$xlsWriter->save( "php://output" );
	}
}
?>