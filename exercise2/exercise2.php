<?php
//I wasn't 100% sure on what to do for this exercise because in my opinion, the exercise was poorly explained and very unclear on the actual final goal.
//The way I understood the goal of the exercise was that my goal was to make a abstact factory, and make two seperate factories for the two types of connections (PDO and REST).
//The two factories would then inherit the same base class (the abstract factory) and have the same functions to overide, 
//thus resulting in them seeming to work identically from the outside.
//I apologize in advance if this was not the goal. I just wanted to provide as much as I can for the assessment.

//This is the abstract factory for the PdoFactory and the RestFactory
abstract class ConnectionFactory {	
	abstract function createData($data);
	abstract function fetchDataById($id);
	abstract function searchData($criteria);
}

//This is the factory for PDO connection
class PdoFactory extends ConnectionFactory {
	//These variables are to set up the database connection
	//I am aware that you should never put usernames and passwords directly in php scripts, and should not be accessable in public_html.
	//I put them here for simplicity as this is just an exercise
	private $host = "localhost";
	private $dbname = "test";
	private $table = "test";
	private $username = "root";
	private $password = "";
	
	function createData($data) {
		try {
			$db = new PDO("mysql:host=$this->host; dbname=$this->dbname; charset=utf8", "$this->username", "$this->password");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->query("INSERT INTO $this->table (id, name, description, active, created, updated) 
				VALUES ('{$data['id']}', '{$data['name']}', '{$data['description']}', '{$data['active']}', '{$data['created']}', '{$data['updated']}');");
			return true;
		}
		catch (PDOException $err) {
			echo $err->getMessage();
			return false;
		}
	}
	
	function fetchDataById($id) {
		try {
			$db = new PDO("mysql:host=$this->host; dbname=$this->dbname; charset=utf8", "$this->username", "$this->password");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result = $db->query("SELECT * FROM $this->table WHERE id = $id;");
			return $result->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $err) {
			echo $err->getMessage();
			return null;
		}
	}
	
	function searchData($criteria) {
		try {
			$db = new PDO("mysql:host=$this->host; dbname=$this->dbname; charset=utf8", "$this->username", "$this->password");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$result = $db->query("SELECT * FROM $this->table WHERE $criteria;");
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $err) {
			echo $err->getMessage();
			return null;
		}
	}
	
	//This function sets up a MySQL database for the PDO connection
	function setupDatabase() {
		try {
			$db = new PDO("mysql:host=$this->host;", "$this->username", "$this->password");
			$db->exec("CREATE DATABASE IF NOT EXISTS $this->dbname;");
			$db = new PDO("mysql:host=$this->host; dbname=$this->dbname; charset=utf8", "$this->username", "$this->password");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->query("CREATE TABLE IF NOT EXISTS $this->table ( id INT NOT NULL, name VARCHAR(256) NOT NULL, description VARCHAR(256) NOT NULL, active TINYINT(1) NOT NULL, created VARCHAR(256) NOT NULL, updated VARCHAR(256) NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB;");
		}
		catch (PDOException $err) {
			echo $err->getMessage();
			die();
		}
	}
}

//This is the factory for Rest connection
class RestFactory extends ConnectionFactory {
	//I have never used rest before, and I'm very uncertain on how to use it.
	//I tried to figure it out, but alas I failed.
	function createData($data) {
		
	}
	function fetchDataById($id) {
		
	}
	function searchData($criteria) {
		
	}
}

//Created data for testing purposes
$testData1 = array(
		"id"	 		=> 1, 
		"name" 			=> "Test Data 1",
		"description"	=> "This is just test data.", 
		"active" 		=> 1, 
		"created"		=> "05-03-16 3:00pm", 
		"updated" 		=> "05-03-16 3:10pm");

$testData2 = array(
		"id"	 		=> 2, 
		"name" 			=> "Test Data 2",
		"description"	=> "This is just some more test data.", 
		"active" 		=> 1, 
		"created"		=> "05-03-16 3:15pm", 
		"updated" 		=> "05-03-16 3:15pm");
?>