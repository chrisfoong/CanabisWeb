<?php
function product_in_cart_card($product_id, $product_name, $product_price, $product_img)
{

  $product_quantity = 1;
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
      if ($cart_item['product_id'] == $product_id && isset($cart_item['product_quantity'])) {
        $product_quantity = $cart_item['product_quantity'];
        break;
      }
    }
  }

  $converted_price = number_format($product_price * $product_quantity, 2, '.', ',') . "฿";

  $element = "
          <div class=\"item-card\">
            <div class=\"item-property\">
              <img class=\"product\" src=\"$product_img\">
              <div>
              <p class=\"title\">$product_name</p>
              <form action=\"ChangeQuantity.php\" method=\"POST\" class=\"quantity\">
                <input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />
                <p class=\"quantity\">Qty: $product_quantity</p>
                <div class=\"quantity-button\">
                  <button type=\"submit\" name=\"increase\" class=\"increase\"><img src=\"./img/arrow_down.png\"></button>
                  <button type=\"submit\" name=\"decrease\" class=\"decrease\"><img src=\"./img/arrow_down.png\"></button>
                </div>
              </form>
              <p class=\"price\">$converted_price</p>
              </div>
            </div>
            <form action=\"RemoveFromCart.php\" method=\"POST\" class=\"remove\">
              <input type=\"hidden\" name=\"product_id\" value=\"$product_id\" />
              <button type=\"submit\"><img src=\"./img/close.png\"></button>
            </form>
          </div>";

  echo $element;
}


?>