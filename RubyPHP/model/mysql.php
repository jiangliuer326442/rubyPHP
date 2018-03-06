<?php
/**
 * Mysql操作基类
 * 使用PDO操作
 */
class Mysql{
	//主连接
	private $master_connect;
	//从连接
	private $slaver_connect;
	
	//PDO连接数据库
	public function __construct(){
		global $config;
		$this->master_connect = new PDO('mysql:host='.$config['mysql']['master']['host'].';dbname='.$config['mysql']['master']['database'].';port='.$config['mysql']['master']['port'],$config['mysql']['master']['username'],$config['mysql']['master']['password']);
		$this->master_connect->exec('set names utf8');
		$this->slaver_connect = new PDO('mysql:host='.$config['mysql']['slaver']['host'].';dbname='.$config['mysql']['slaver']['database'].';port='.$config['mysql']['slaver']['port'],$config['mysql']['slaver']['username'],$config['mysql']['slaver']['password']);
		$this->slaver_connect->exec('set names utf8');
	}
	
	/**
	 * 执行SQL语句
	 * 根据sql语句性质选择主从连接
	 * 自动补全表前缀
	 */
	public function mysql_query($sql, $prefix = ''){
		global $config;
		if(empty($prefix))
			$prefix = $config['mysql']['prefix'];
		//自动补全表名（使用表前缀）
		$_ = strpos($sql, "from");
		if($_){
			$_ = substr($sql,$_+5);
		}
		$tb_name = substr($_,0,strpos($_, " "));
		$sql = str_replace(array("from ".$tb_name, "insert into ".$tb_name, "replace into ".$tb_name), array("from ".$prefix.$tb_name, "insert into ".$prefix.$tb_name, "replace into ".$prefix.$tb_name), $sql);
		//判断sql语句性质
		$sql_type = strtolower(substr($sql,0, strpos($sql, " ")));
		switch($sql_type){
			case 'select':
					$statement = $this->slaver_connect -> query($sql);
					$rs = $statement-> fetchAll(PDO::FETCH_ASSOC); 
					return $rs;
				break;
			case 'insert':
				if($this->master_connect -> exec($sql)){ 
					return $this->master_connect -> lastinsertid(); 
				}else{
					return 0;
				}
				break;
			default:
				$this->master_connect -> exec($sql);
		}
	}
}
