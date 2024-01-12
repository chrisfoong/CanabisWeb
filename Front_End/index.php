<?php
session_start();
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KenshoCannabis</title>
  <link rel="stylesheet" type="text/css" href="./css/webstyle.css?<?php echo time(); ?>" />
  <link rel="stylesheet" type="text/css" href="./css/webstylertwo.css?<?php echo time(); ?>" />
</head>

<body>
  <div class="banner">
    <?php
    require_once("components/navbar.php");
    ?>

    <div class="content">
      <h1>BEST CANNABIS IN THAILAND</h1>
      <p>Welcome to our premium online dispensary, where we take pride in offering the finest selection of high-quality
        cannabis products available.<br>We are dedicated to providing a seamless and enjoyable experience for both
        seasoned connoisseurs and newcomers to the world of cannabis.</p>

      <div class="button-list">
        <button type="button"><span></span><a href="./browse.php">BROWSE</a></button>
        <button type="button"><span></span>MERCHS</button>
        </ul>
      </div>
    </div>

  </div>
  </div>

  <footer>
    <h1>
      <strong>Join us on community.</strong>
    </h1>
    <p>
      <strong>we welcome all newcomers and rookies</strong><br>
      <strong>we managed to all supplys</strong><br>
      <strong>click here to contact</strong><br><br>
      <a href='https://www.instagram.com/chriss_fng/'>
        <img src="./img/instagramlogo.png" width='60px'>
      </a>

    </p>
  </footer>
  <?php
  $alert = isset($_GET['alert']) ? $_GET['alert'] : '';
  if ($alert != "")
    echo "<script>alert(\"$alert\")</script>"
      ?>
  </body>