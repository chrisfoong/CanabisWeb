<?php
require_once('./components/product.php');
require_once('./utils/db_conn.php');
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KenshoCanabis</title>
  <link rel="stylesheet" type="text/css" href="./css/webstyle.css?<?php echo time(); ?>" />
  <link rel="stylesheet" type="text/css" href="./css/webstylertwo.css?<?php echo time(); ?>" />
</head>

<body>
  <div class="banner">
    <?php
    require_once("./components/navbar.php");
    ?>

    <section class="products">
      <h1>Our Products</h1>
      <div class="all-products">
        <?php
        $result = getData($conn, "producttb");
        while ($row = mysqli_fetch_assoc($result)) {
          product_card($row['id'], $row['product_name'], $row['product_price'], $row['product_image']);
        }
        ?>
      </div>
    </section>
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