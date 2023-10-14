<?php
session_start();
include "./utils/db_conn.php";

$params = "";

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

      if (!addOrder($conn, $producttb, $ordertb, $user_id, $product_id, $product_amount, $_POST['address'], $_POST['credit_card'], $_POST['expiry_date'], $_POST['cvv'])) {
      } else {
        $params = "?alert=Adding order failed.";

      }
    }
    unset($_SESSION['cart']);
    $params = "?alert=orders added successfully!";
  } else {
    $params = "?alert=Failed: Cart is empty.";
  }
} else {
  $params = "?alert=Please login first.";
}

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Remove query parameters from the URL
$referer_parts = parse_url($referer);
$referer_url = $referer_parts['scheme'] . '://' . $referer_parts['host'] . $referer_parts['path'] . $params;

// Redirect to the modified referring URL
header("Location: $referer_url");
exit();