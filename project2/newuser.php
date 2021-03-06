<?php
require __DIR__ . "/vendor/autoload.php";
$view = new Nurikabe\NewUserView($_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nifty Nurikabe New User</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<body>

<header>
    <?php echo $view->present_header();?>
</header>
<div class="main">
        <div class="container">
            <?php echo $view->userForm(); ?>
        </div>
</div>
<footer>
    <?php echo $view->present_footer();?>
</footer>
</body>
</html>