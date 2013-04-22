<?php

class MgQuery {
	
	private $connection;
	private $qSelect;

	function __construct() {
	}

	function arrayToObject($array) {

	    if(!is_array($array)) {
	    	return $array;
	    }
	    
	    $object = new stdClass();
	    if(is_array($array) && count($array) > 0) {
			foreach ($array as $name=>$value) {
				$name = strtolower(trim($name));
				if(!empty($name)) {
					$object->$name = $this->arrayToObject($value);
				}
			}
			return $object; 
	    }
	    else {
			return false;
	    }

	}

	function qSelect() {

		$select = "SELECT ";

		if(is_array($this->qSelect->columns)){

			$i = 0;
			$j = count($this->qSelect->columns);

			foreach($this->qSelect->columns as $key=>$value){

				$select .= $value;

				$i++;

				if(@$i < $j) {
					$select .= ",";
				}

			}

		}
		else {
			$select .= $this->qSelect->columns;
		}

		$select .= " FROM `".$this->qSelect->table."`";

		if($this->qSelect->where != null) {

			$select .= " WHERE ";

			if(is_array($this->qSelect->where)){

				$i = 0;
				$j = count($this->qSelect->where);

				foreach($this->qSelect->where as $key=>$value){

					$select .= $key." = '".$value."'";

					$i++;

					if(@$i < $j) {
						$select .= " AND ";
					}

				}

			}
			else {
				$select .= $this->qSelect->where;
			}

		}

		if($this->qSelect->order != null) {

			$key = key($this->qSelect->order);
			$value = $this->qSelect->order[key($this->qSelect->order)];
			$select .= " ORDER BY ".$key." ".$value;

		}

		$query = mysql_query($select,$this->connection->getLink());

		$result = array();
		$i = 0;
		while($fetch = @mysql_fetch_array($query)) {

			while($curr = current($fetch)){

				$key = key($fetch);
				$result[$i][$key] = $curr;

			    next($fetch);

			}

			$result[$i] = $this->arrayToObject($result[$i]);

			$i++;

		}
		if(count($result) == 0)
			$result = null;

		return $result;

	}

	function select($table,$columns = "*",$where = null,$order = null) {

		$this->qSelect = new stdClass();

		$this->qSelect->table = $table;
		$this->qSelect->columns = $columns;
		$this->qSelect->where = $where;
		$this->qSelect->order = $order;

		return $this->qSelect();

	}

	/**
	*
	* STARTS THE get AND set METHODS
	*
	**/

	function getConnection() {

		return $this->connection;

	}

	function setConnection($s) {

		$this->connection = $s;

	}

}

?>