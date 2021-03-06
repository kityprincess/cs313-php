<?php
  session_name("bubbles");
  session_start();

  include("products.php");

  echo <<<DISP
    <html>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <head>
            <title>Bubblegum Bonanza Confirmation</title>
            <link rel="stylesheet" type="text/css" href="cart.css"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript" src="cart.js"></script>            
        </head>
        <body>
          <div id="wrapper">
DISP;
          
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $streetAddy = $_POST['streetAddy'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

            echo "<p>Order Details:<br/>\n</p>";
            echo "<table>";
            echo "<tr><td><strong>Customer Name:</strong></td><td>$firstName $lastName</td>
                  <tr><td><strong>Shipping Address:</strong></td><td>$streetAddy<br /> $city, $state $zip <br /></td></tr>";
            echo "</table>";

            $cart_total = 0;
            if(count($_SESSION['cart']) != 0) {
              foreach($_SESSION['cart'] as $key => $value)
              {
                $cart_total = $cart_total + $value['price'];
                $name = $value['name'];
                $price = $value['price'];
                $desc = $value['description'];
                echo <<<DISP
                <div id="$key" class="confirm">
                  <span class="prod name">$name</span>
                  <span class="prod price">\$$price</span>
                </div>
DISP;
              }
            } else {
            	echo "There are no items in your cart.";
            }

            echo "Order total: ".$cart_total;
            
            echo <<<FINI
            <br/><br/>
            <span class="button" id="browse">Browse</span>            
          </div>
      </body>
    </html>
FINI;
?>