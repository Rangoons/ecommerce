<?php
class DB{
  private $dbh;
  function __construct(){
    require_once("../../db_connection.php");
    try{
      //open connection_
      $this->dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
      //change error reporting
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
      echo $e->getMessage();
      die();
    }
  }//contructor
  function getPeopleParam($id){
    try{
      $data = array();
      $stmt = $this->dbh->prepare("select * from people where PersonID = :id");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetchAll();
      return $data;
    }catch(PDOException $e){
      echo $e->getMessage();
      die();
    }
  }

  function insert($last, $first, $nick){
    try{
      $stmt = $this->dbh->prepare("insert into people (LastName,FirstName,NickName) values (:lastName, :firstName, :nickName)");
      $stmt->execute(array("lastName"=
      >$last,
                           "firstName"=>$first,
                           "nickName"=>$nick));
      return $this->dbh->lastInsertId();
    }catch(PDOException $e){
      echo $e->getMessage();
      die();
    }
  }
  function getAllObjects(){
    try{
      include "Person.class.php";
      $data = array();
      $stmt = $this->dbh->prepare("select * from people");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Person");
      while($person = $stmt->fetch()){
        $data[] = $person;
      }
      return $data;
    }catch(PDOException $e){
      echo $e->getmessage();
      die();
    }
  }
}//class
 ?>
