<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
  	<link rel="stylesheet" type="text/css" href="homepageStyle.css"/>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="homepageJS.js"></script>
  	<title>Kimberly's CS313 World</title>
  </head>
  <body>
  	<div class="dropdown">
  		<button class="assign">Assignments</button>
  		<div class="content">
  			<a href="assignments.html">All Assignments</a>
  			<a href="coming.html">Week 3</a>
  			<a href="coming.html">Week 4</a>
  			<a href="coming.html">Week 5</a>
  			<a href="coming.html">Week 6</a>
  			<a href="coming.html">Week 7</a>
  			<a href="coming.html">Week 8</a>
  			<a href="coming.html">Week 9</a>
  			<a href="coming.html">Week 10</a>
  			<a href="coming.html">Week 11</a>
  			<a href="coming.html">Week 12</a>
  			<a href="coming.html">Week 13</a>
  			<a href="coming.html">Week 14</a>
  		</div><!--content-->
  	</div><!--dropdown-->
    <br/>
    <?php 
      date_default_timezone_set("America/Boise");
      echo "Last modified: ".date("F j, Y h:i A",filemtime("index.php"));
      echo " MDT";
    ?>
  	<div class = "intro">
  	<h1>What's the best way to remember things?<br/>Through music of course!</h1>
  	<br/>
  	<img src="singingintherain.jpeg" alt="Singing in the Rain">
  	<br/>
  	<p>At the beginning of every semester, the <em>getting to know you</em> activities always bring to mind the song, "Getting To Know You" from <u>The King and I</u>. Unfortunately for those that get to interact with the 3D version of me, that's not the only time songs pop into my head. If we lived in a musical, I am convinced that we would remember so much more!<br/><br/>
  	Who doesn't remember the chorus, if not the whole theme song, to their favorite cartoons and TV shows growing up?!? Put it to good music and remember away!<br/><br/>
  	For example, listen to this amazing "Tour the States" song or "Tour the World" song 20 times and you'll never forget your state capitals or countries!<br/><br/>
  	I can hear it now... (to the tune of Dem Bones) "CSS lines end in a semi-colon, CSS lines end in a semi-colon."</p>
  	</div>
  	<iframe class="youtubes" id="youtubes" src="https://www.youtube.com/embed/_E2CNZIlVIg"></iframe>
  	<iframe class="youtubes"  src="https://www.youtube.com/embed/LZFF8EuaGjM?start=3"></iframe>
  </body>