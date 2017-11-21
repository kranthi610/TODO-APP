<?php
class DB{
	private static $_instance = null;
	private  static $conn;
	public static $connection;
	private  $_pdo,
	         $_query,
	         $_error = false,
	         $_results,
	         $_count = 0;
	private function __construct(){
    try {
      self::$conn = new PDO('mysql:host='.Config::get("mysql/host"), Config::get("mysql/username"), Config::get("mysql/password"));
      foreach(self::creatTables() as  $executions){
        self::$conn->exec($executions);
      }
    
    }
    catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
  }

	public static function getInstance(){
    if(!isset(self::$_instance)){
      self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public static function creatTables(){
    $db = Config::get('mysql/db');
    $database = "CREATE DATABASE IF NOT EXISTS $db";
    $use_db = "use $db";
	  $sql = "CREATE TABLE  IF NOT EXISTS usersssss (
    id BIGINT(255) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP
    )";
    $table = "CREATE TABLE  IF NOT EXISTS todo (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
    )";
      return array($database,$use_db,$sql,$table);
	}

	public static function query($action,$table,$conditions) {
    try{
      $sql = "";
      switch ($action){
        case "insert":
          $sql = self::insert($table,$conditions);
          self::$conn->exec($sql);
          break;
        case "select":
          $sql = self::select($table,$conditions);
          $select_result = self::$conn->query($sql);
          return array($select_result->rowCount(),$select_result);
          break;
        case "update":
          $sql = self::update($table,$conditions);
          $stmt = self::$conn->prepare($sql);
          $stmt->execute();
          break;
        case "delete":
          $sql = self::delete($table,$conditions);
          self::$conn->exec($sql);
          break;
      } 
       
    }catch (Exception $e){
      echo  $e->getMessage();
    } 
  }

  public static function insert($table,$conditions){
    $query = "INSERT INTO $table $conditions";
    return $query;
  }

  public static function select($table,$conditions){
    $query = "SELECT * FROM $table $conditions";
    return $query;
  }

  public static function update($table,$conditions){  
    $query = "UPDATE $table SET $conditions";
    return $query ;

  }
  public static function delete($table,$conditions){  
    $query = "DELETE FROM $table $conditions";
    return $query;
  }


}