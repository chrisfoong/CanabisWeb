<html>

<head>
  <title>KenshoCannabis</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KenshoCannabis</title>
  <link rel="stylesheet" type="text/css" href="./css/webstyleregisteration.css?<?php echo time(); ?>" />
</head>

<body>
  <form action="SignUpCheck.php" method="post">
    <h2>SIGN UP</h2>
    <?php if (isset($_GET['error'])) { ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>

    <label>Name</label>
    <?php if (isset($_GET['name'])) { ?>
      <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']; ?>"><br>
    <?php } else { ?>
      <input type="text" name="name" placeholder="Name"><br>
    <?php } ?>

    <label>User Name</label>
    <?php if (isset($_GET['uname'])) { ?>
      <input type="text" name="uname" placeholder="User Name" value="<?php echo $_GET['uname']; ?>"><br>
    <?php } else { ?>
      <input type="text" name="uname" placeholder="User Name"><br>
    <?php } ?>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br>

    <label>Password Again</label>
    <input type="password" name="passwordagain" placeholder="Password Again"><br>

    <button type="submit">Sign Up</button>
    <a href="index.php" class="ca">Back to HOMEPAGE</a>
  </form>
</body>

</html>