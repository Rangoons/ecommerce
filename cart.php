<?php
require 'DB.class.php';
require 'LIB_project1.php';
$db = new DB;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/master.css" media="screen" title="no title">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.remove').click(function(){
      var id = $(this).val();
      var ajaxurl = 'LIB_project1.php',
      data =  {'action': 'removeItemFromCart', 'itemID':id};
      $.post(ajaxurl, data, function (response) {
          // Response div goes here.
          alert("action performed successfully");
      });
  });

});
</script>
</head>
<body>
  <?php
  include 'nav.php';
   ?>
  <div class='item_container'>
    <?php
     $items = getCart($db);
    //  echo '<pre>';
    //  print_r($items);
    //  echo "</pre>";
  //  echo $items;
    if($items){
      foreach($items as $i){
        foreach($i as $c){
          echo $c->listCart();
        }
      }
    }else{
      echo "<h1> Your cart is empty.</h1>";
    }
     ?>
  </div>
</body>
</html>
