 <?php 
defined('IN_BANGCMS') or exit('Access Denied');
defined('UNINSTALL') or exit('Access Denied');
$type_db = bc_base::load_model('type_model');
$typeid = $type_db->delete(array('module'=>'link'));
if(!$typeid) return FALSE;
 ?>