<?php
class Item{
  private $itemID;
  private $name;
  private $desc;
  private $image;
  private $price;
  private $quantity;

  public function getID(){
    return $this->itemID;
  }
  public function listItems(){
    $text ="
      <a href='product.php?itemID={$this->itemID}'>
      <div class='item'>
        <img class='product_img' src='{$this->image}'>
        <h3>{$this->name} | {$this->price}</h3>

      </div>
      </a>
      ";
    return $text;
  }
  public function listItem(){
    $text ="
      <div class='viewItem'>
        <h2>{$this->name}</h2>
        <img class='product_img' src='{$this->image}'>
        <p>{$this->desc}</p>
        <h1>$ {$this->price}</h1>
        <button type='button' class='add btn btn-default navbar-btn' value='{$this->itemID}'>Add to Cart</button>
      </div>
      </a>
      ";
    return $text;
  }
  public function listCart(){
    $text ="
    <p class='navbar-text'>{$this->name} | $ {$this->price} <button type='button' class=' remove btn btn-default navbar-btn' value='{$this->itemID}'>Remove</button></p>
    ";
      return $text;
  }

}
 ?>
