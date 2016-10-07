<?php
require 'DB.class.php';
//$db = new DB;
function getItem($id){
  $db = new DB;
  $item = $db->getItemByID($id);
  $itemArray
}
function getAllItems(){
  $db = new DB;
  $items = $db->getAllProducts();
  $itemsArray = array();
  foreach($items as $item){
    
  }
}
//getItem(1);
 ?>
