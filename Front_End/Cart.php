<!doctype html>
<html>

<head>
<?php
session_start();
require_once('./components/productInCart.php');
require_once('./utils/db_conn.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST'){$params = "";

$user_id = $_SESSION['id'];

if (isset($user_id)) {
  if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
      $product_id = $cart_item['product_id'];
      if (isset($cart_item['product_quantity'])) {
        $product_amount = $cart_item['product_quantity'];
      } else {
        $product_amount = 1;
      }

      if (!addOrder($conn, $producttb, $ordertb, $user_id, $product_id, $product_amount, $_POST['address'], $_POST['credit_card'], $_POST['expiry_date'], $_POST['cvv'], $_POST['name'])) {

      
      }else {
        $params = "Adding order failed.";

      }
    }
    unset($_SESSION['cart']);
    $params = "orders added successfully!";
  } else {
    $params = "Failed: Cart is empty.";
  }
} else {
  $params = "Please login first.";
}

echo "<script>alert('$params')</script>";
}
$item_in_cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$total = 0;
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KenshoCannabis</title>
  <link rel="stylesheet" type="text/css" href="./css/webstyle.css?<?php echo time(); ?>" />
  <link rel="stylesheet" type="text/css" href="./css/cart.css?<?php echo time(); ?>" />
</head>

<body>

  <div class="banner">
    <?php
    require_once('./components/navbar.php');
    ?>

    <div class="container">
      <form method="POST" class="information">
        <h1>Checkout</h1>
        <div>
          <label for="name">Full Name:</label>
          <input type="text" id="name" name="name" required
            value="<?php echo isset($_SESSION['name']) ? $_SESSION["name"] : "" ?>">
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div>
          <label for="address">Address:</label>
          <textarea id="address" name="address" rows="4" cols="50" required></textarea>
        </div>
        <div>
          <label for="credit_card">Credit Card Number:</label>
          <input type="text" id="credit_card" name="credit_card" required>
        </div>
        <div>
          <label for="expiry_date">Expiry Date:</label>
          <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
        </div>
        <div>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" required>
        </div>

        <button type="submit" value="Submit">Buy</button>
      </form>
      <div class="summary">
        <h3>
          <?php echo "$item_in_cart_count ITEM" ?>
        </h3>
        <?php

        if ($item_in_cart_count == 0) {
          echo "<h3 class=\"empty\">Cart is Empty</h3>";
        } else {
          $product_id_list = array_column($_SESSION['cart'], 'product_id');

          $result = getData($conn, "producttb");
          while ($row = mysqli_fetch_assoc($result)) {
            foreach ($product_id_list as $product_id) {
              if ($row['id'] == $product_id) {
                product_in_cart_card($row['id'], $row['product_name'], $row['product_price'], $row['product_image']);
                foreach ($_SESSION['cart'] as $cart_item) {
                  if ($cart_item['product_id'] === $product_id && isset($cart_item['product_quantity'])) {
                    $total = $total + ((int) $row['product_price'] * $cart_item['product_quantity']);
                    break;
                  }
                }
              }
            }
          }
          echo "<div class=\"item-cards-container\">
         
          </div>";
        } ?>

        <div class="total">
          <p>Total</p>
          <h3>
            <?php echo $total . "฿" ?>
          </h3>
        </div>
      </div>
    </div>
  </div>
  <?php
  $alert = isset($_GET['alert']) ? $_GET['alert'] : '';
  if ($alert != "")
    echo "<script>alert(\"$alert\")</script>"
      ?>
  </body>

  </html>