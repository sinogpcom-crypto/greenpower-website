<?php
/**
 * 获取关键字接口
 */
defined('IN_BANGCMS') or exit('No permission resources.'); 

define('API_URL_GET_KEYWORDS', 'https://upgrade.phpcmsx.net/api/cws');

$number = intval($_GET['number']);
$data = $_POST['data'];
echo get_keywords($data, $number);

function get_keywords($words, $number = 3) {
	// $data = trim(strip_tags($data));
 //    if(empty($data)) return '';
	// $http = bc_base::load_sys_class('http');
	// if(CHARSET != 'utf-8') {
	// 	$data = iconv('utf-8', CHARSET, $data);
	// } else {
	// 	$data = iconv('utf-8', 'gbk', $data);
	// }
	// $http->post(API_URL_GET_KEYWORDS, array('siteurl'=>SITE_URL, 'charset'=>CHARSET, 'data'=>$data, 'number'=>$number));
	// if($http->is_ok()) {
	// 	if(CHARSET != 'utf-8') {
	// 		return $http->get_data();
	// 	} else {
	// 		return iconv('gbk', 'utf-8', $http->get_data());
	// 	}
	// }
	// return '';

	$data = trim(strip_tags($words));
    if(empty($words)) return '';
    $http = bc_base::load_sys_class('http');
    if(CHARSET != 'utf-8') {
        $data = iconv('utf-8', CHARSET, $data);
    }
    
    $http->post(API_URL_GET_KEYWORDS, array('siteurl'=>SITE_URL, 'charset'=>CHARSET, 'data'=>$words, 'number'=>$number));
    if($http->is_ok()) {
        if(CHARSET != 'utf-8') {
            return iconv('gbk','utf-8',$http->get_data());
        } else {
            return $http->get_data();
        }
    }
    return '';
}
?>