<?php 
class session_files {
    function __construct() {
		$path = bc_base::load_config('system', 'session_n') > 0 ? bc_base::load_config('system', 'session_n').';'.bc_base::load_config('system', 'session_savepath')  : bc_base::load_config('system', 'session_savepath');
		ini_set('session.save_handler', 'files');
		session_save_path($path);
		session_start();
    }
}
?>