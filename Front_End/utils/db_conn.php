<?php
require 'vendor/autoload.php';
$sname = "localhost";
$uname = "id21408595_canabis_user";
$password = "KenshoCanabis!1";

$db_name = "id21408595_kenshocanabis";

$usertb = "usertb";
$producttb = "producttb";
$ordertb = "ordertb";

// connect to mysql
$mysql_conn = mysqli_connect($sname, $uname, $password);
if (!$mysql_conn)
  die("MySQL connection failed!");

// connect to database if not exist
$create_db_sql = "CREATE DATABASE IF NOT EXISTS $db_name /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */";
if (!mysqli_query($mysql_conn, $create_db_sql))
  die("Create database failed!");

// connect to exist or created database
$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn)
  echo "Database connection failed!";

//sql for create table for user if not exist
$create_usertb_sql = "CREATE TABLE IF NOT EXISTS $usertb (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                user_name VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

//sql for create table for product if not exist
$craete_producttb_sql = "CREATE TABLE IF NOT EXISTS $producttb (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(255) NOT NULL,
            product_price FLOAT NOT NULL,
            product_image TEXT NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

//sql for add initial products
$add_data_sql = "INSERT INTO $producttb (product_name, product_price, product_image) VALUES
('100g Weed', 750, 'https://images.unsplash.com/photo-1589140915708-20ff586fe767?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8d2VlZHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80'),
('plant for growing', 1000, 'https://images.unsplash.com/photo-1589140915708-20ff586fe767?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8d2VlZHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80'),
('Lighter', 10000, 'https://images.unsplash.com/photo-1589140915708-20ff586fe767?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8d2VlZHxlbnwwfHwwfHx8MA%3D%3D&w=1000&q=80');";

//sql for create table for order if not exist
$create_ordertb_sql = "CREATE TABLE IF NOT EXISTS $ordertb (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) NOT NULL,
            product_id INT(11) NOT NULL,
            product_price FLOAT NOT NULL,
            product_amount INT(11) NOT NULL,
            shipping_address TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES $usertb(id),
            FOREIGN KEY (product_id) REFERENCES $producttb(id)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

//sql for check if product table has any product yet
$product_check_sql = "SELECT COUNT(*) FROM $producttb";

//run all sql relevant to tables check if error
if (
  !mysqli_query($conn, $create_usertb_sql) ||
  !mysqli_query($conn, $craete_producttb_sql) ||
  !mysqli_query($conn, $create_ordertb_sql)
)
  die("Create tables failed!");

//check if product table has any product yet
$product_in_tb = mysqli_query($conn, $product_check_sql);
$row = mysqli_fetch_row($product_in_tb);
//if not found any product
if ($row[0] == 0) {
  //add initial product
  mysqli_query($conn, $add_data_sql);
}

//function for fetch all data from a table
function getData($conn, $tablename)
{
  $sql = "SELECT * FROM $tablename";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    return $result;
  }
}

function addOrder($conn, $producttb, $ordertb, $user_id, $product_id, $product_amount, $user_address, $card_num, $card_ex, $card_ccv, $name)
{
  $get_price_sql = "SELECT product_price, product_name FROM $producttb WHERE id = '$product_id'";
  $result = mysqli_query($conn, $get_price_sql);
  $row = mysqli_fetch_assoc($result);
  $product_price = $row['product_price'];
  $product_name = $row['product_name'];

  //Payment process mock
  if ($card_num == null && $card_ex == null && $card_ccv == null) {
    return false;
  }

  $address = mysqli_real_escape_string($conn,$user_address);
  $add_order_sql =  "INSERT INTO $ordertb (user_id, product_id, product_price, product_amount, shipping_address) VALUES ('$user_id', '$product_id', '$product_price', '$product_amount', '$address')";

  if (mysqli_query($conn, $add_order_sql)) {
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("keshocanabis@gmail.com");
    $email->setSubject("Customer's Orders");
    $email->addTo("chrisfoong010@gmail.com");
    $email->addContent("text/plain", "$name ('ID'$user_id) just ordered product '$product_name'\nAmount: $product_amount\n Address: $user_address");
    $sendgrid = new \SendGrid('API_KEY');

    try {
    $sendgrid->send($email);
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n"; 
      }
    return true;
  } else {
    return false;
  }
}