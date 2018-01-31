<?php
require __DIR__ . "/vendor/autoload.php";
require_once "./lib/game.inc.php";
$view = new Nurikabe\UserLoginView($_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Nifty Nurikabe Login</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<body>

<header>
    <?php echo $view->present_header();?>
</header>
<div class="upperMain">

        <?php echo $view->loginForm(); ?>


</div>
<footer>
    <?php echo $view->present_footer();?>
</footer>
</body>
</html>