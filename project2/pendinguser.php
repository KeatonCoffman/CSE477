<?php
require __DIR__ . "/vendor/autoload.php";
$view = new Nurikabe\PendingUserView();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nifty Nurikabe New User Pending</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<body>
<header>
    <?php echo $view->present_header(); ?>
</header>
            <form class="newgame" method="get" action="post/index-post.php">
                <div class="controls">
                <p>An email message has been sent to your address. When it arrives, select the
                    validate link in the email to validate your account.</p>
                <p><button>Home</button></p>
                </div>

            </form>
<footer>
    <?php echo $view->present_footer();?>
</footer>
</body>
</html>