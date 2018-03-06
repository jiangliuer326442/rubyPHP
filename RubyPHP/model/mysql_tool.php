<?php

require_once('config/mysql.php');

/**
 * Db��������
 */
class Mysql_tool{
	//������ʵ��ľ�̬��Ա����
	private static $_instance;
	
	private $table_name; //����
	private $prefix; //��ǰ׺
	private $field; //�ֶ�
	private $where; //where����
	private $order;
	private $limit; //limit����
	
	//private��ǵĹ��췽��
	private function __construct($table_name, $prefix){
		global $config;
		if(empty($prefix)){
			$prefix = $config['mysql']['prefix'];
		}
		$this->table_name = $table_name;
		$this->prefix = $prefix;
		$this->field = "*";
		$this->where = " 1=1";
		$this->order = "";
		$this->limit = "";
	}
	
	private function init(){
		global $config;
		$this->table_name = "";
		$this->prefix = $config['mysql']['prefix'];
		$this->field = "*";
		$this->where = " 1=1";
		$this->limit = "";
		$this->order = "";
	}
	 
	//����__clone������ֹ���󱻸��ƿ�¡
	public function __clone(){
		trigger_error('Clone is not allow!',E_USER_ERROR);
	}
	 
	//����,���ڷ���ʵ��Ĺ����ľ�̬����
	public static function setTable($table_name, $prefix){
		if(!(self::$_instance instanceof self)){
			return self::$_instance = new self($table_name, $prefix);
		}else{
			self::$_instance-> table_name = $table_name;
			return self::$_instance;
		}
	}
	
	//field����
	public function field($field){
		$this->field = $field;
		return self::$_instance;
	}

	public function order($order){
		$this->order = " order by ".$order;
		return self::$_instance;
	}
	
	//where����
	public function where($condition){
		if(is_array($condition)){
			$logic = "and";
			if(isset($condition['logic'])){
				$logic = $condition['logic'];
			}
			$where = "";
			foreach($condition as $key=> $val){
				if($key != '_logic'){
					$split = "";
					if(is_string($val)){
						$split = "'";
					}
					$where .= "`".$key."` = ".$split.$val.$split." ".$logic." ";
				}
			}
			$this->where = substr($where,0, strlen($where)-strlen($logic)-1);
		}else{
			$this->where .= " and (".$condition.")";
		}
		return self::$_instance;
	}
	
	//limit����
	public function limit($limit){
		$this->limit = " limit ".$limit;
		return self::$_instance;
	}
	
	//find����
	public function find($id = null){
		if($id){
			$this->where .= " and id = ".$id;
		}
		$this->limit = " limit 1";
		$result = $this->select();
		if(count($result)>0) return $result[0]; else return null;
	}
	
	//select����
	public function select(){
		global $config;
		$sql = "";
		if($config['mysql']['enable']){
			$sql = "select ".$this->field." from ".$this->table_name." where".$this->where.$this->order.$this->limit;
			$this->init();
			$result = mysql_execute($sql);
		}
		return $result;
	}
	
	//delete
	public function delete($id = null){
		if($id == null){
			$sql = "delete from ".$this->table_name." where ".$this->where;
		}else{
			$sql = "delete from ".$this->table_name." where id = ".$id;
		}
		$this->init();
		mysql_execute($sql);
	}

	//save
	public function save($array){
		$list = array();
		foreach($array as $key=>$val){
			$values = "";
			if($val === intval($val)){
				$values = $val;
			}else{
				$values = "'".$val."'";
			}

			array_push($list,"`".$key."` = ".$values);
		}
		$set = implode(",", $list);
		global $config;
		$sql = "";
		if($config['mysql']['enable']){
			$sql = "update ".$this->table_name." set ".$set." where".$this->where;
			$this->init();
			mysql_execute($sql);
		}
	}
	
	//add����
	public function add($data){
		$fields = "";
		$values = "";
		foreach($data as $key=> $value){
			$fields .= "`".$key."`,";
			if($value === intval($value)){
				$values .= $value.",";
			}else{
				$values .= "'".$value."',";
			}
		}
		$fields = substr($fields,0,strlen($fields)-1);
		$values = substr($values,0,strlen($values)-1);
		global $config;
		$sql = "";
		if($config['mysql']['enable']){
			$sql = "insert into ".$this->table_name." (".$fields.") values(".$values.")";
			$this->init();
			$result = mysql_execute($sql);
		}
		return $result;
	}
}
