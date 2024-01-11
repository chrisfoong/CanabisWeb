<nav>
  <div class="navbar">

    <img src="img/weedlogoreal.png" class="logo">
    <ul <?php if (isset($_SESSION['user_name'])) {
      echo 'style="display:none"';
    } ?>>
      <li><a href="./index.php">Home</a></li>
      <li><a href="./browse.php">Browse</a></li>
      <li><a href="./signupPage.php">SIGN UP</a></li>
      <li><a href="./loginPage.php">LOGIN</a></li>
    </ul>
    <?php if (isset($_SESSION['user_name'])): ?>
      <ul>
        <li><a href="./index.php">Home</a></li>
        <li><a href="./index.php">
            <?php echo $_SESSION['user_name']; ?>
          </a></li>
        <li><a href="./browse.php">Browse</a></li>
        <li class="cart">
          <a href="./Cart.php">
            <?php
            if (isset($_SESSION['cart'])) {
              $item_in_cart_count = count($_SESSION['cart']);
              echo "$item_in_cart_count";
            } else {
              echo "0";
            }
            ?>
            <img class="cart-icon" src="./img/cart.png" />
          </a>
        </li>
        <form action="logOut.php" method="POST">
          <button class="logout" type="submit" name="logout">Log out</button>
        </form>
      </ul>
    <?php endif; ?>
  </div>
</nav>