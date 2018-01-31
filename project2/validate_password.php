<?php
require __DIR__ . "/vendor/autoload.php";
$view = new Nurikabe\ValidatePasswordView($_GET);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nifty Nurikabe Password Entry</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<body>
<header>
    <?php echo $view->present_header(); ?>
</header>
<div class="upperMain">
    <div class="box">
        <?php echo $view->form(); ?>
    </div>
</div>
<footer>
    <?php echo $view->present_footer();?>
</footer>
</body>
</html>