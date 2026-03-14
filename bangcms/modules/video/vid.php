<?php 
defined('IN_BANGCMS') or exit('No permission resources.');

/**
 * 
 * ------------------------------------------
 * check_vid 
 * ------------------------------------------
 * @package 	BangCMS
 * @author		
 * @copyright	
 * 
 */

 class vid {
	
	public function __construct() {
		bc_base::load_app_class('ku6api', 'video', 0);

		$this->setting = getcache('video', 'video');
		$this->ku6api = new ku6api($this->setting['sn'], $this->setting['skey']);
	}

	/**
	 * 
	 * 添加vid
	 */
	public function check () {
		$vid = $_GET['vid'];
		
		$this->ku6api->check($vid);
	}
 }