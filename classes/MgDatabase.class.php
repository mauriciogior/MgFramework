<?php

class MgDatabase {

	private $configurationFile;
	private $configuration;

	private $connection;
	private $query;

	function __construct(){

        $this->configurationFile    = "DBOConfiguration.xml";
        $this->configuration        = new stdClass();
        $this->connection           = array();

	}

	function __destruct(){

		foreach($this->connection as $connection){

			unset($connection);

		}

	}

	function configure($newFile = false){

		try {

			if($newFile) $this->configurationFile = $newFile;

			if(!file_exists("classes/".$this->configurationFile)){
				throw new Exception(MgExceptions::$error1);
			}

			$handler = fopen("classes/".$this->configurationFile,"r");

	        $i      = 0;
	        $get    = array();

			while(($line = fgetss($handler)) !== false) {
				if($i > 1 && $i < 7) {
					array_push($get,$line);
				}
				$i++;
			}

	        $this->configuration->type       = trim($get[0]);
	        $this->configuration->host       = trim($get[1]);
	        $this->configuration->login      = trim($get[2]);
	        $this->configuration->password   = trim($get[3]);
	        $this->configuration->database   = trim($get[4]);

	    } catch (Exception $e) {

	    	MgExceptions::ExceptionThrower($e);

	    }

	}

	function initialize(){

		count(array_keys($this->connection));
		$key = count(array_keys($this->connection));

		$this->connection[$key] = new MgConnection();
		$this->connection[$key]->setConfiguration(clone $this->configuration);
		$this->connection[$key]->setId($key);
		$this->connection[$key]->connect();

		return $this->connection[$key];

	}

	/**
	*
	* STARTS THE get AND set METHODS
	*
	**/
	
	function getConnection() {

		return $this->connection;

	}

	function getConfigurationFile() {

		return $this->configurationFile;

	}

	function getQuery($key = 0){

		try {

			if(!isset($this->connection[$key])){
				throw new Exception(MgExceptions::$error5);
			}

			$this->query = new MgQuery();
			$this->query->setConnection($this->connection[$key]);
			return clone $this->query;

		} catch (Exception $e) {

	    	MgExceptions::ExceptionThrower($e);

		}

		return false;

	}

	function setConfigurationFile($s) {

		$this->configurationFile = $s;
	
	}

}

?>