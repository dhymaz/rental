<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

	function __contruct(){
		parent::_contruct();
	}

	public function getAll($table)
	{
		$query = $this->db->get($table);
		return $query;
	}

	public function getWhere($table,$where)
	{	
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query;
	}

	public function getWhereLike($table,$where)
	{	
		$this->db->like($where);
		$query = $this->db->get($table);
		return $query;
	}

	public function getLastData($table,$id)
	{	
		$this->db->limit(1);
		$this->db->order_by($id,'DESC');
		$query = $this->db->get($table);
		return $query;
	}

	public function getSpesificWhereLike($field,$table,$where)
	{	$this->db->select($field);
		$this->db->like($where);
		$query = $this->db->get($table);
		return $query;
	}

	public function getSpesificAll($field,$table)
	{	
		$this->db->select($field);
		$query = $this->db->get($table);
		return $query;
	}

	public function getSpesificWhere($field,$table,$where)
	{	
		$this->db->select($field);
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query;
	}

	public function getAllJoin($table,$condition,$type_join)
	{	
		$this->db->select('*');
		if(is_array($table)){
			foreach ($table as $key => $value) {
				if($key == 0){
					$this->db->from($table[$key]);
				}else{
					$this->db->join($table[$key],$condition[$key-1],$type_join[$key-1]);
				}
			}
		}
		$query = $this->db->get();
		return $query;
	}

	public function getWhereJoin($table,$condition,$type_join,$where)
	{	
		$this->db->select('*');
		if(is_array($table)){
			foreach ($table as $key => $value) {
				if($key == 0){
					$this->db->from($table[$key]);
				}else{
					$this->db->join($table[$key],$condition[$key-1],$type_join[$key-1]);
				}
			}
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function getWhereJoinWithOrder($table,$condition,$type_join,$where,$fieldOrder,$typeOrder)
	{	
		$this->db->select('*');
		if(is_array($table)){
			foreach ($table as $key => $value) {
				if($key == 0){
					$this->db->from($table[$key]);
				}else{
					$this->db->join($table[$key],$condition[$key-1],$type_join[$key-1]);
				}
			}
		}
		$this->db->where($where);
		$this->db->order_by($fieldOrder,$typeOrder);
		$query = $this->db->get();
		return $query;
	}

	public function getSpesificWhereJoin($field,$table,$condition,$type_join,$where)
	{	
		$this->db->select($field);
		if(is_array($table)){
			foreach ($table as $key => $value) {
				if($key == 0){
					$this->db->from($table[$key]);
				}else{
					$this->db->join($table[$key],$condition[$key-1],$type_join[$key-1]);
				}
			}
		}
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}

	public function getSpesificWhereJoinWithOrder($field,$table,$condition,$type_join,$where,$fieldOrder,$typeOrder)
	{	
		$this->db->select($field);
		if(is_array($table)){
			foreach ($table as $key => $value) {
				if($key == 0){
					$this->db->from($table[$key]);
				}else{
					$this->db->join($table[$key],$condition[$key-1],$type_join[$key-1]);
				}
			}
		}
		$this->db->where($where);
		$this->db->order_by($fieldOrder,$typeOrder);
		$query = $this->db->get();
		return $query;
	}

	public function deleteAllData($table){
		$query = $this->db->delete($table);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function deleteWhereData($table,$where){
		$this->db->where($where);
		$query = $this->db->delete($table);
		if($query){
			return true;
		}else{
			return false;
		}
	}


	public function UpdateAllData($table,$data){
		$query = $this->db->update($table,$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function UpdateWhereData($table,$data,$where){
		$this->db->where($where);
		$query = $this->db->update($table,$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function insertData($table,$data){
		$query  = $this->db->insert($table,$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function queryExec($query){
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query;
		}else{
			return 0;
		}
	}


}
