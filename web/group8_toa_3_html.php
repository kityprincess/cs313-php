<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<title>Group 8 TOA Week 03</title>
  </head>
  <body>
  		<form action="group8_toa_3.php" method="post" id="form">
  			<fieldset>
  				<label>
  					Name: 
	  				<input type="text" name="name"><br/>
  				</label>
  				<label>
  					Email: 
  					<input type="text" name="email"><br/>
  				</label>
  				<?php
            		$major_radio_id = "major-";
            		$major_radio_abbr = array("cs", "wdd", "cit", "ce");
            		$major_radio_fullname = array ("Computer Science", "Web Design and Development", "Computer Information Technology", "Computer Engineering");
        
            	for($i = 0; $i < sizeof($major_radio_fullname); $i++) {
                	echo "<input id=" . $major_radio_id . $major_radio_abbr[$i] . " type='radio' name='major' value='" . $major_radio_fullname[$i] . "' required>";
                	echo "<label for=" . $major_radio_id . $major_radio_abbr[$i] . ">" . $major_radio_fullname[$i] . "</label>";
            	}
        		?>
  				<!--
  				<label>
  					Major:<br/>
  					<input type="radio" name="major" value="Computer Science">Computer Science<br/>
  					<input type="radio" name="major" value="Web Design and Development">Web Design and Development<br/>
  					<input type="radio" name="major" value="Computer information Technology">Computer information Technology<br/>
  					<input type="radio" name="major" value="Computer 	Engineering">Computer Engineering<br/>
  				</label>
  			-->
  				<label>
  					Comments: <br/>
  					<textarea form="form" name="comments"></textarea><br/>
  				</label>
  			<p>
  				Continents Visited: <br>
            	<input type="checkbox" name="continent[]" value="na"> North America<br>
            	<input type="checkbox" name="continent[]" value="sa"> South America<br>
            	<input type="checkbox" name="continent[]" value="eu"> Europe<br>
            	<input type="checkbox" name="continent[]" value="as"> Asia<br>
            	<input type="checkbox" name="continent[]" value="au"> Australia<br>
            	<input type="checkbox" name="continent[]" value="af"> Africa<br>
            	<input type="checkbox" name="continent[]" value="an"> Antarctica
            </p>
            <input type="submit" value="Submit">
  			</fieldset>
  		</form>
  </body>
  </html>