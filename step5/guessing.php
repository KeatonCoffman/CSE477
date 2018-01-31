<?php
require __DIR__ . '/lib/Guessing/guessing.inc.php';
$view = new Guessing\GuessingView($guessing);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Guessing Game</title>
    <link href="guessing.css" type="text/css" rel="stylesheet" />

</head>
<body>
<fieldset>
<?php echo $view->present(); ?>
</fieldset>
</body>
</html>