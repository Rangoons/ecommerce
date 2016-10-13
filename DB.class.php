<?php
include_once "Item.class.php";
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
  function getItemByID($id){
    try{
      //inc
      $data = array();
      $stmt = $this->dbh->prepare("select * from item where itemID = :id and quantity > 0");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Item");
      while($item = $stmt->fetch()){
        $data[] = $item;
      }
      return $data;
    }catch(PDOException $e){
      echo $e->getMessage();
      die();
    }
  }


  // function insert($last, $first, $nick){
  //   try{
  //     $stmt = $this->dbh->prepare("insert into item (LastName,FirstName,NickName) values (:lastName, :firstName, :nickName)");
  //     $stmt->execute(array("lastName"=
  //     >$last,
  //                          "firstName"=>$first,
  //                          "nickName"=>$nick));
  //     return $this->dbh->lastInsertId();
  //   }catch(PDOException $e){
  //     echo $e->getMessage();
  //     die();
  //   }
  // }
  function getAllObjects(){
    try{
      //include "Item.class.php";
      $data = array();
      $stmt = $this->dbh->prepare("select * from item where quantity > 0");
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Item");
      while($item = $stmt->fetch()){
        $data[] = $item;
      }
      return $data;
    }catch(PDOException $e){
      echo $e->getmessage();
      die();
    }
  }
  function decreaseQuantity($id){
    try {
      $stmt = $this->dbh->prepare("update item set quantity = quantity - 1 where itemID = :id");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
  }
  function increaseQuantity($id){
    try {
      $stmt = $this->dbh->prepare("update item set quantity = quantity + 1 where itemID = :id");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
  }
  function addItemToCart($itemID,$count){
    try {
      $stmt = $this->dbh->prepare("insert into cart (cartID,itemID,count) values (1, :itemID, :count)");
      $stmt->bindParam(":itemID",$itemID,PDO::PARAM_INT);
      $stmt->bindParam(":count",$count,PDO::PARAM_INT);
      $stmt->execute();
      $this->decreaseQuantity($itemID);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
  }
  function removeItemFromCart($itemID){
    try {
      $stmt = $this->dbh->prepare("delete from cart where itemID = :itemID");
      $stmt->bindParam(":itemID",$itemID,PDO::PARAM_INT);
      $stmt->execute();
      $this->increaseQuantity($itemID);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
  }
  function getCart(){
    try {
      $stmt = $this->dbh->prepare("select * from cart where cartID = 1");
      $stmt->execute();
      while($item = $stmt->fetch()){
        $data[] = $item;
      }
      //echo count($data);
      if(count($data) > 0){
        foreach($data as $itemID){
        $cart[] = $this->getItemByID($itemID['itemID']);
      }
      return $cart;
    }else{
      return false;
    }
    } catch (PDOException $e) {
      echo $e->getMessage();
      die();
    }

  }
}//class
 ?>
