<?php
  //https://stackoverflow.com/questions/8597556/simple-php-shopping-cart-without-sql
  session_name("bubbles");
  session_start();

  include("products.php");

 if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
  }

  $action = (isset($_GET['action'])) ? $_GET['action']: "";
  switch($action)
  {
    case "additem":
      $itemid = (isset($_GET['itemid'])) ? $_GET['itemid']: "";
      if($itemid != "")
      {
        if($_SESSION['cart'] == "")
        {
          $_SESSION['cart'] = array($products[$itemid]);
        } else {
          array_push($_SESSION['cart'], $products[$itemid]);
        }
      }
      break;
    case "clearcart":
      $_SESSION['cart'] = array();
      break;
  }

echo <<<DISP
    <html>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <head>
            <title>Bubblegum Bonanza</title>
            <link rel="stylesheet" type="text/css" href="./cart.css"/>
            <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"> </script>
            <script type="text/javascript" src="./cart.js"></script>
        </head>
        <body>
          <div id="wrapper">
DISP;

            echo "<p><br/>Click an item to add it to your cart:<br/>\n</p>";
              foreach($products as $key => $value)
              {
                $name = $value['name'];
                $price = $value['price'];
                $desc = $value['description'];
                echo <<<DISP
                  <div id="$key" class="disp_item">
                    <span class="prod name">$name</span>
                    <span class="prod price">\$$price</span>
                    <span class="prod desc">$desc</span>
                  </div>

DISP;
              }

            $cart_total = 0;
            if($_SESSION['cart'] !='') {
              foreach($_SESSION['cart'] as $key => $value)
              {
                $cart_total = $cart_total + $value['price'];
                $name = $value['name'];
                $price = $value['price'];
                $desc = $value['description'];
              }
            }

            echo "Cart total: ".$cart_total;

            echo <<<FINI
            <br/><br/>
            <span class="button" id="cart">Shopping Cart</span>
            <span class="button" id="clearcart">Clear Cart</span>
          </div>
        </body>
    </html>
FINI;
?>