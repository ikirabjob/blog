<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 08.06.2017
 * Time: 9:36
 */

namespace Core;

use PDO;
use PDOException;

class Db extends PDO
{

	public $error = array(),$query = "";


	function __construct(){

		try { 
			parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_DB, DB_USER, DB_PASSWORD);
			$this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$this->query("SET NAMES `utf8`");
		}  
		catch(PDOException $e) {
   			
			$this->error[] = $e->getMessage();
			if($this->logs) $this->errorLog($e);
		}
	}

	public function insert_($query,$param = array()){
	
		$this->query = $query;
		
		try
		{

				
			$STH = $this->prepare($query); 
			
			
			
			if(!empty($param))
				$result = $STH->execute($param);
			else
				$result = $STH->execute();
			
			
			
			

				
			return $result;
			
			
		}
		catch(\PDOException $e)
		{
			echo $e->getMessage();
			$this->error[]= $e->getMessage();
			return false;
		}
	}
	
	public function delete_($query,$param = array()){
		return $this->insert_($query,$param);
	}
	
	public function update_($query,$param = array()){
		return $this->insert_($query,$param);
	}
	
	public function get_($query, $all=false, $param=array(), $fetchMode = PDO::FETCH_ASSOC, $into = false){
		$this->query = $query;

		try
		{

			
			$STH = $this->prepare($query); 			
				
			if(!empty($param))
				$result = $STH->execute($param);
			else
				$result = $STH->execute();
				
			if(is_object($into))
				$STH->setFetchMode($fetchMode, get_class($into));
			else
				$STH->setFetchMode($fetchMode);  
			$result = $all ? $STH->fetchAll() : $STH->fetch();
			

				
			return $result;
				
		}
		catch(PDOException $e)
		{
			$this->error[]= $e->getMessage();
		}
	}

	public function lastId(){
		return $this->lastInsertId();
	}
	
	public function count_($query){
		return $this->query($query)->rowCount();
	}
	
	
	private function errorLog(\PDOException $e){
		$date=date("Y_m_d");
		$time=date("h:i:s");
		file_put_contents('../logs/PDOErrors_'.$date.'.txt',$time." ".$e->getMessage()."\r\n", FILE_APPEND);
	}
	
	
}
