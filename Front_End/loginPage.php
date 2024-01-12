<html>

<head>
  <title>KenshoCannabis</title>
  <link rel="stylesheet" type="text/css" href="./css/webstyleregisteration.css?<?php echo time(); ?>" />
</head>

<body>
  <form action="login.php" method="post">
    <h2>LOGIN</h2>

    <?php if (isset($_GET['error'])) { ?>
      <p class="error">
        <?php echo $_GET['error']; ?>
      </p>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
      <p class="success">
        <?php echo $_GET['success']; ?>
      </p>
    <?php } ?>

    <label>User Name</label>
    <input type="text" name="uname" placeholder="User Name"><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br>

    <button type="submit">Login</button>
    <a href="signupPage.php" class="ca">Create an account</a>
  </form>
</body>

</html>