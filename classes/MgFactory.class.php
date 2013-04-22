<?php
require("MgDatabase.class.php");
require("MgConnection.class.php");
require("MgQuery.class.php");
require("MgExceptions.class.php");

class MgFactory {

	private $dbo;

	function __construct(){

		$this->dbo = new MgDatabase();

	}

	function __destruct(){

		unset($this->dbo);

	}

	function initDbo() {

		$this->dbo->configure();
		return $this->dbo->initialize();

	}

	/**
	*
	* STARTS THE get AND set METHODS
	*
	**/

	function getDbo() {
		return $this->dbo;
	}

	function setDbo($s) {
		$this->dbo = $s;
	}
	
}

?>