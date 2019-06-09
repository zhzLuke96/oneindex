<?php 
class ImagesController{
	function index(){
		return view::load('images/index');
	}
	public function ajaxUploadImg(){
        if($this->is_image($_FILES["file"]) ){
            $content = file_get_contents( $_FILES["file"]['tmp_name']);
            $remotepath =  'images/'.date('Y/m/').'/';
            $remotefile = $remotepath.$_FILES["file"]['name'];
            $result = onedrive::upload(config('onedrive_root').$remotefile, $content);
            if($result){
                //$cachefile = CACHE_PATH . md5('dir_'.config('onedrive_root').$remotepath) . '.php';
                //unlink($cachefile);
                $root = get_absolute_path(dirname($_SERVER['SCRIPT_NAME'])).config('root_path');
                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                $url = $_SERVER['HTTP_HOST'].$root.'/'.$remotefile.((config('root_path') == '?')?'&s':'?s');
                $url = $http_type.str_replace('//','/', $url);
                header('Content-Type:application/json');
                echo json_encode(['code'=>0,'data'=>$url]);
            }
        }
    }
	function is_image($file){
		$config = config('images@base');
		$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		if(!in_array($ext,$config['exts'])){
			return false;
		}
		if($file['size'] > 10485760 || $file['size'] == 0){
			return false;
		}
		return true;
	}
}