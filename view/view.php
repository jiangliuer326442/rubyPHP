<?php
class View{
	private $tpl_data = array();
	
	//为模板分配变量
	public function assign($key, $value){
		$this->tpl_data[$key] = $value;
	}
	
	//返回json数据
	public function return_json($status, $info, $data){
		header('content-type:application/json;charset=utf8');
		$result['status'] = $status;
		$result['info'] = $info;
		$result['data'] = $data;
		exit(json_encode($result));
	}
	
	//调用模板文件
	public function display($file_path,$prefix = null,$cache = ''){
		$is_cache = @$_GET['cache'];
		if(empty($is_cache)){
			$is_cache = $cache;
		}
		global $config;
		//是否启用缓存
		if($config['tmpl']['is_cache'] && $is_cache != 'no'){
			//检测缓存文件是否存在
			//自动不全问号
			if(!strstr('?',$_SERVER['REQUEST_URI'])){
				$_SERVER['REQUEST_URI'] .= "?";
			}
			$cache_file = str_replace(array("/","?"),array("_p_","_w_"),$_SERVER['REQUEST_URI']);
			if(file_exists('cache/'.$cache_file)){
				//存在缓存文件
				//检查缓存文件是否过期
				$modify_time = filemtime('cache/'.$cache_file);
				if(((time()-$modify_time)>$config['tmpl']['cache_limit']) || ((time()-$modify_time)<0)){
					//文件已过期
					$this->_view($file_path, $prefix);
				}else{
					//加载缓存文件
					require_once('cache/'.$cache_file);
					$is_cache = 'no';
				}
			}else{
				$this->_view($file_path, $prefix);
			}
			if($is_cache != 'no'){
				//生成缓存文件
				$html = file_get_contents('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&cache=no');
				file_put_contents('cache/'.$cache_file, $html);
			}
		}else{
			$this->_view($file_path, $prefix);
		}
	}
	
	/** 
	* 压缩html: 清除换行符,清除制表符,去掉注释标记 
	* @param $string 
	* @return压缩后的$string 
	* */ 
	private function compress_html($string){ 
		$string=str_replace("\r\n",'',$string);//清除换行符
		$string=str_replace("\n",'',$string);//清除换行符
		$string=str_replace("\t",'',$string);//清除制表符
		$pattern=array(
		"/> *([^ ]*) *</",//去掉注释标记
		"/[\s]+/",
		"/<!--[^!]*-->/",
		"/\" /",
		"/ \"/",
		"'/\*[^*]*\*/'"
		);
		$replace=array (
		">\\1<",
		" ",
		"",
		"\"",
		"\"",
		""
		);
		return preg_replace($pattern, $replace, $string);
	}
	
	//加载视图文件
	private function _view($file_path, $prefix){
		global $config;
		$prefix = empty($prefix) ? $config['tmpl']['prefix'] : $prefix;
		if(!file_exists('view/'.$file_path.".".$prefix)){
			if(strtolower(APP_MODEL) == 'debug'){
				die('TMPL NOT EXISTS');
			}else{
				exit;
			} 
		}
		$tpl = file_get_contents('view/'.$file_path.".".$prefix);
		$replace_orign = array();
		$replace_to = array();
		foreach($this->tpl_data as $key=> $val){
			array_push($replace_orign, $config['tmpl']['left_delimiter'].$key.$config['tmpl']['right_delimiter']);
			array_push($replace_to, $val);
		}
		$html = str_replace($replace_orign, $replace_to, $tpl);
		if($config['tmpl']['is_compresshtml']){
			$html = $this->compress_html($html);
		}
		echo $html;
	}
}