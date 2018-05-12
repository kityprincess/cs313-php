<?php
  session_name("bubbles");
  session_start();

    echo <<<DISP
    <html>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <head>
            <title>Bubblegum Bonanza Checkout</title>
            <link rel="stylesheet" type="text/css" href="cart.css"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript" src="checkout.js"></script>            
        </head>
        <body>
          <div id="wrapper">
DISP;

    echo <<<DISP
        <form action="confirm.php" id="items" method="post">
	  	  	<div class="contactForm">
	  	  	  <fieldset>
	  	  		<legend>
	  	  	  	  Shipping Details
	  	  		</legend>
	            <label>
	  	  		  First Name:
	  	  		  <input name="firstName" oninput="valName(this.value, 'fNHint');" size="10"/>
	              <span class='fNHint' style="color:red">Please input your first name</span>
  	  			</label>
  	  			<label>
   				  Last Name:
	              <input name="lastName" oninput="valName(this.value, 'lNHint');" size="10"/>
	              <span class='lNHint' style="color:red">Please input your last name</span>
	  	  		</label>  	
	  	  		<br />  			
	  	  		<label>
	  	  		  Street:
	              <input name="streetAddy" oninput="valStreet(this.value, 'streetHint');" size="30"/>
	              <span class='streetHint' style="color:red">Please input your street address</span>
	  	  		</label>
	  	  		<br />
	            <label>
	              City:
	              <input name="city" oninput="valCity(this.value, 'cityHint');" size="20"/>
	              <span class='cityHint' style="color:red">Please input your city</span>	              
	            </label>
	            <label>
	              State:
	              <input name="state" oninput="valState(this.value, 'stateHint');" size="2"/>
	              <span class='stateHint' style="color:red">Please input your state</span>
	            </label>
	            <label>
	              Zip:
	              <input name="zip" oninput="valZip(this.value, 'zipHint');" size="10"/>
	              <span class='zipHint' style="color:red">Please input your zip</span>
	            </label>
	            <br />         
           		<form onsubmit="submit()">      
            	<input type="submit" value="Submit Order">	     
	          </fieldset>
	  	  	</div> <!-- form-->
  	  	</form>
DISP;
            echo <<<FINI
            <br/><br/>
            <span class="button" id="cart">Shopping Cart</span>
            <span class="button" id="browse">Browse</span>
          </div>
      </body>
    </html>
FINI;
?>