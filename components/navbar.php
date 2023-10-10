<?php
session_start();
?>

<nav>
    <div class="navbar">

            <img src="img/weedlogoreal.png" class="logo">
                <ul <?php if (isset($_SESSION['user_name'])) 
                {echo 'style="display:none"';} ?>>

                    <li><a href="./Index.php">Home</a></li>
                    <li><a href="#">Location</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="./SignUp.php">SIGN UP</a></li>
                    <li><a href="./LoginPage.php">LOGIN</a></li>
                    <img src="img/American-removebg-preview.png" class="lang">

                </ul>
                <?php if (isset($_SESSION['user_name'])) : ?>
                    <ul>
                    <li><a href="./Index.php">Home</a></li>
                    <li><a href="#">Location</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="./Index.php"><?php echo $_SESSION['user_name']; ?></a></li>
                    <form method="POST">
                    <button class="logout" type="submit" name="logout">Log out</button>
                    </form>

                    <img src="img/American-removebg-preview.png" class="lang">
                    </ul>
                <?php endif; ?>
    </div>   
</nav>