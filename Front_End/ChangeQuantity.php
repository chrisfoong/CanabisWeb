<?php
session_start();

$params = "";

if (isset($_SESSION['user_name'])) {
  // Check if product_id and action are set
  if (isset($_POST['product_id']) && (isset($_POST['increase']) || isset($_POST['decrease']))) {
    $productId = $_POST['product_id'];

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $key => $value) {
        if ($value["product_id"] == $_POST['product_id']) {
          if (isset($_POST['increase'])) {
            $_SESSION['cart'][$key]['product_quantity'] = $_SESSION['cart'][$key]['product_quantity'] + 1;
          } elseif (isset($_POST['decrease']) && $_SESSION['cart'][$key]['product_quantity'] > 1) {
            $_SESSION['cart'][$key]['product_quantity'] = $_SESSION['cart'][$key]['product_quantity'] - 1;
          }
          break;
        }
      }
    }

  } else {
    // Handle error, invalid request
    $params = "?alert=Invalid request.";
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
?>