<?php
session_start();
include "./utils/db_conn.php";

$params = "";

if (isset($_SESSION['user_name'])) {
  if (isset($_POST['product_id'])) {

    $item_array = array(
      'product_id' => $_POST['product_id'],
      'product_quantity' => 1
    );

    if (isset($_SESSION['cart'])) {
      $item_array_id = array_column($_SESSION['cart'], "product_id");

      if (in_array($_POST['product_id'], $item_array_id)) {
        $params = "?alert=Product is already added in the cart!";
      } else {
        array_push($_SESSION['cart'], $item_array);
      }
    } else {
      $_SESSION['cart'][0] = $item_array;
    }

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