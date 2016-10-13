<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addToCart':
            addToCart($_POST['itemID']);
            break;
        case 'removeItemFromCart':
            removeItemFromCart($_POST['itemID']);
            break;
    }
}
function getItem($db,$id){
  return $db->getItemByID($id);
}
function getAllItems($db){
  return $db->getAllObjects();
}
function getCart($db){
  return $db->getCart();
}
function addToCart($id){
  require 'DB.class.php';
  $db = new DB;
  $db->addItemToCart($id, 1);
}
function removeItemFromCart($id){
  require 'DB.class.php';
  $db = new DB;
  $db->removeItemFromCart($id);
  //echo $id;
}
 ?>
