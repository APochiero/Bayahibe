<?php

	require_once __DIR__ . "/../config.php";
	require_once DIR_UTILITY . "dbConfig.php";
	$BayahibeDB = new BayahibedbManager();

	class BayahibedbManager {
		private $mysqli_Connection = null;
	
		function BayahibedbManager(){
			$this->openConnection();
		}
    
    	function openConnection(){
    		if (!$this->isOpened()){
    			global $dbHostname;
    			global $dbUsername;
    			global $dbPassword;
    			global $dbName;
    			
    			$this->mysqli_Connection = new mysqli($dbHostname, $dbUsername, $dbPassword);
				if ($this->mysqli_Connection-> connect_error) 
					die('Connect Error (' . $this->mysqli_Connection->connect_errno . ') ' . $this->mysqli_Connection->connect_error);

				$this->mysqli_Connection->select_db($dbName) or
					die ( mysqli_error() );
			}
    	}
		
    	function isOpened(){
       		return ($this->mysqli_Connection != null);
    	}

		function performQuery($queryText) {
			if (!$this->isOpened())
				$this->openConnection();
			
			return $this->mysqli_Connection->query($queryText);
		}
		
		function sqlInjectionFilter($string){
			if(!$this->isOpened())
				$this->openConnection();
				
			return $this->mysqli_Connection->real_escape_string($string);
		}

		function closeConnection(){
 	       	if($this->mysqli_Connection !== null)
				$this->mysqli_Connection->close();
			
			$this->mysqli_Connection = null;
		}
	}

?>