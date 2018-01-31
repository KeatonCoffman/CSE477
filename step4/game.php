



<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Stalking the Wumpus</title>
  <link href="wumpus.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<p><img class="main_picture" src="cave.jpg" width="" height="" alt="centerpicture"/>
	</p>
	<div id="details">
        <?php
        echo '<p>' . date("g:ia l, F j, Y") . '</p>';
        ?>

		<p><h2>You are in room <?php echo "room"; ?></h2></p>

        <?php
        //if() {
        //    echo "<h2 > You smell a wumpus!</h2 >";
        //}
        ?>
	</div>
	
	<div class="rooms">
	  <div class="room"><img src="cave2.jpg" width="" height="" alt="cave2jpg"><a href=""> <p>Shoot Arrow </p></a>
	  </div>
	  <div class="room"><img src="cave2.jpg" width="" height="" alt="cave2jpg"><a href=""> <p>Shoot Arrow </p></a>
	  </div>
	  <div class="room"><img src="cave2.jpg" width="" height="" alt="cave2jpg"><a href=""> <p>Shoot Arrow </p></a>
	  </div>
	</div>
	<div id="arrows">
		<p>You have 3 arrows remaining.</p>
	</div>
</body>
</html>