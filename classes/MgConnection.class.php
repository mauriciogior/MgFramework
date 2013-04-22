<?php

class MgConnection {
	
	private $link;
	private $configuration;
	private $id;

	function __construct() {

		$this->configuration = null;

	}

	function __destruct(){

		@mysql_close($this->link);

	}

	function connect() {

		try {

			if($this->configuration == null) {
				throw new Exception(MgExceptions::$error4);
			}

			if(!$this->link = mysql_connect(
				$this->configuration->host,
				$this->configuration->login,
				$this->configuration->password,true)) {
				throw new Exception(MgExceptions::$error2);
			}

			if(!mysql_select_db(
				$this->configuration->database,
				$this->link)) {
				throw new Exception(MgExceptions::$error3);
			}

		} catch (Exception $e) {

	    	MgExceptions::ExceptionThrower($e);

		}

	}

	/**
	*
	* STARTS THE get AND set METHODS
	*
	**/

	function getId() {

		return $this->id;

	}

	function getLink() {

		return $this->link;

	}

	function getConfiguration() {

		return $this->configuration;

	}

	function setId($s) {

		$this->id = $s;

	}

	function setLink($s) {

		$this->link = $s;

	}

	function setConfiguration($s) {

		$this->configuration = $s;

	}

}

?>