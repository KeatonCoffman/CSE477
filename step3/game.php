
<?php
require 'wumpus.inc.php';


$room = 1; // The room we are in.
$birds = 7;  // Room with the birds
$pits = array(3, 10, 13);    // Rooms with a bottomless pit


$cave = cave_array(); // Get the cave
//<p><a href="#">3</a></p>
//<p><a href="#"><?php echo $cave[$room][0]; ?\></a></p>
//$_GET['r']
if(isset($_GET['r'])&& isset($cave[$_GET['r']])) {
    // We have been passed a room number
    $room = $_GET['r'];
}
$birds = 7;  // Room with the birds
$wumpus = 16;



?>
<?php
if(in_array($room,$pits)){
    header("Location: lose.php");
    exit;
}
if($wumpus === $room){
    header("Location: lose.php");
    exit;
}


?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Stalking the Wumpus</title>
  <link href="wumpus.css" type="text/css" rel="stylesheet" />
</head>
<?php echo present_header("Stalking the Wumpus"); ?>
<body>
	<p><img class="main_picture" src="cave.jpg" width="" height="" alt="centerpicture"/>
	</p>
	<div id="details">
        <?php
        //echo "<pre>";
        //var_dump(cave_array());
        //echo "</pre>";
        echo '<p>' . date("g:ia l, F j, Y") . '</p>';

        if($birds == $room){
            $room = 10;
        }

        ?>

		<p><h2>You are in room <?php echo $room; ?></h2></p>
        <?php
            if($cave[$room][0] === $room || $cave[$room][1] === $room || $cave[$room][2] === $room){
               echo " <h2 > You hear birds!</h2 > ";
            }
            if(in_array($cave[$room][0],$pits) || in_array($cave[$room][1],$pits) || in_array($cave[$room][2],$pits)){
                echo "<h2>You feel a draft!</h2>";
            }
            else{
                echo "<p>&nbsp;</p>";
            }

        ?>
        <?php
        //if() {
        //    echo "<h2 > You smell a wumpus!</h2 >";
        //}
        ?>
	</div>
	
	<div class="rooms">
	  <div class="room"><img src="cave2.jpg" width="" height="" alt="cave2jpg"><a href=""><p><a href="game.php?r=<?php echo $cave[$room][0]; ?>"><?php echo $cave[$room][0]; ?></a></p> <p>Shoot Arrow </p></a>
	  </div>
	  <div class="room"><img src="cave2.jpg" width="" height="" alt="cave2jpg"><a href=""> <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>"><?php echo $cave[$room][1]; ?></a></p><p>Shoot Arrow </p></a>
	  </div>
	  <div class="room"><img src="cave2.jpg" width="" height="" alt="cave2jpg"><a href=""> <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>"><?php echo $cave[$room][2]; ?></a></p><p>Shoot Arrow </p></a>
	  </div>
	</div>
	<div id="arrows">
		<p>You have 3 arrows remaining.</p>
	</div>
</body>
</html>