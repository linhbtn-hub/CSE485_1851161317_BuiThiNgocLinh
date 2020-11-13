<?php
	class Model{
		private $_db;
		public function __construct($dbName,$user,$pwd){
			$dsn = "mysql:dbname={$dbName};host=localhost;port=3306";
			try{
				$this->_db = new PDO($dsn,$user,$pwd);
			}
			catch(PDOException $m){
				echo "Can not connecting this database".$m->getMessage();
			}
		}
		public function fetchAll($sql){
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		public function execSQL($sql){
			$stmt = $this->_db->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
		public function getOne($tbl,$condition){
			$sql = "SELECT * FROM {$tbl} WHERE {$condition}";
			$stmt = $this->execSQL($sql);
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		public function getSelect($tbl,$fKey,$fValue,$slName,$mesHeader,$vFocus=null){
			$select = "<select name='{$slName}'>
				<option value=-1>$mesHeader</option>";
			$sql = "SELECT {$fKey}, {$fValue} FROM {$tbl} WHERE 1=1";
			$rs = $this->fetchAll($sql);
			if(count($rs)>0){
				foreach($rs as $row){
					$vKey = $row[$fKey];
					$vValue = $row[$fValue];
					$select .= "<option value='{$vKey}'>{$vValue}</option>";
				}
			}
			$select.= "</select>";
			if($vFocus!=null){
				$select = str_replace("<option value='{$vFocus}'>","<option value='{$vFocus}' selected='selected'>",$select);
			}
			return $select;
		}
		public function insert($tbl, $data){
			$arKey = array_keys($data);
			$arValue = array_values($data);
			foreach($arValue as $v){
				$arNewValue[] = "'{$v}'";
			}
			$lsKeys = (count($arKey)>0)?implode(',',$arKey):'';
			$lsValues = (count($arNewValue)>0)?implode(',',$arNewValue):'';
			if(strlen($lsKeys)>0&&strlen(lsValues)>0){
				$sql = "INSERT INTO {$tbl} ({$lsKeys}) VALUES ({$lsValues})";
				if($this->execSQL($sql)){
					return 1;
				}	
			}
		}
		public function delete($tbl,$condition){
			$sql = "DELETE FROM {$tbl} WHERE {$condition}";
			if($this->execSQL($sql)){
				return 1;
			}
		}
		public function update($tbl,$data,$condition){
			$arKey = array_keys($data);
			$arValue = array_values($data);
			$i=0;
			$sql = "UPDATE {$tbl} SET ";
			while($i<count($arKey)){
				$sql.= "{$arKey[$i]} = '{$arValue[$i]}' ,";
				$i++;
			}
			$sql = rtrim($sql,',');
			$sql.= "WHERE {$condition}";
			if($this->execSQL($sql)){
				return 1;
			}
		}
	}