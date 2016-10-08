<?php
//require 'DB.class.php';
//$db = new DB;
function getItem($db,$id){
  return $db->getItemByID($id);
}
function getAllItems($db){
  return $db->getAllObjects();
}
//getItem(1);
 ?>
