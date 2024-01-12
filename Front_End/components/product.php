<?php
function product_card($product_id, $product_name, $product_price, $product_img)
{

  $converted_price = number_format($product_price, 2, '.', ',') . "฿";
  $element = "
  <div class=\"product_card\">
    <img src=\"$product_img\">
    <div class=\"product-info\">
      <h4 class=\"product-title\">$product_name</h4>
      <p class=\"product-price\">$converted_price</p>
      <br>
      <form action=\"AddToCart.php\" method=\"POST\">
      <input type='hidden' name='product_id' value='$product_id'>
      <button type=\"submit\" class=\"product-btn\" name=\"add\">Add to cart</button>
      </form>
    </div>
  </div>
    ";
  echo $element;
}
?>