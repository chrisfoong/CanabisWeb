<?php
session_start();
include "./utils/db_conn.php";

$params = "";

if (isset($_SESSION['user_name'])) {

  if (isset($_POST['product_id'])) {
    $is_found = false;
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value["product_id"] == $_POST['product_id']) {
        unset($_SESSION['cart'][$key]);
        $is_found = true;
      }
    }

    if (!$is_found)
      $params = "?alert=Product to remove not found.";

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