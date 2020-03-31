<?php
/*
	Main Framework System 1.0
	DataBase Conection 1.0
*/
class Database extends PDO{
	public function __construct($host,$dbname,$user,$password,$char) {
		parent::__construct(
			'mysql:host=' . $host .
			';dbname=' . $dbname,
			$user, 
			$password, 
			array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $char
				,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
			));
	}
}

?>