<?php
/**
 * Db操作基类
 */
class Mysql_tool{
	//保存类实例的静态成员变量
	private static $_instance;
	
	private $table_name; //表名
	private $prefix; //表前缀
	private $field; //字段
	private $where; //where条件
	private $limit; //limit限制
	
	//private标记的构造方法
	private function __construct($table_name, $prefix){
		global $config;
		if(empty($prefix)){
			$prefix = $config['mysql']['prefix'];
		}
		$this->table_name = $table_name;
		$this->prefix = $prefix;
		$this->field = "*";
		$this->where = " 1=1";
		$this->limit = "";
	}
	 
	//创建__clone方法防止对象被复制克隆
	public function __clone(){
		trigger_error('Clone is not allow!',E_USER_ERROR);
	}
	 
	//单例方法,用于访问实例的公共的静态方法
	public static function setTable($table_name, $prefix){
		if(!(self::$_instance instanceof self)){
			self::$_instance = new self($table_name, $prefix);
		}
		return self::$_instance;
	}
	
	//field操作
	public function field($field){
		$this->field = $field;
		return self::$_instance;
	}
	
	//where操作
	public function where($condition){
		$this->where .= " and (".$condition.")";
		return self::$_instance;
	}
	
	//limit操作
	public function limit($limit){
		$this->limit = " limit ".$limit;
		return self::$_instance;
	}
	
	//find操作
	public function find(){
		$this->limit = " limit 1";
		$result = $this->select();
		return $result[0];
	}
	
	//select操作
	public function select(){
		global $config;
		$sql = "";
		if($config['mysql']['enable']){
			$sql = "select ".$this->field." from ".$this->table_name." where".$this->where.$this->limit;
			$result = mysql_execute($sql);
		}
		return $result;
	}
	
	//add操作
	public function add($data){
		$fields = "";
		$values = "";
		foreach($data as $key=> $value){
			$fields .= "`".$key."`,";
			$values .= "'".$value."',";
		}
		$fields = substr($fields,0,strlen($fields)-1);
		$values = substr($values,0,strlen($values)-1);
		global $config;
		$sql = "";
		if($config['mysql']['enable']){
			$sql = "insert into ".$this->table_name." (".$fields.") values(".$values.")";
			$result = mysql_execute($sql);
		}
		return $result;
	}
}