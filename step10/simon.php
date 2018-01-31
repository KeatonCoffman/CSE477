<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Simon</title>
    <link href="simon.css" type="text/css" rel="stylesheet" />
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="site.con.js"></script>
    <script>
        $(document).ready(function() {
            new Simon("form");
        });
    </script>
</head>
<body>
<form><p>
        <input type="button" value="Red">
        <input type="button" value="Green">
        <input type="button" value="Blue">
        <input type="button" value="Yellow">
    </p>
</form>

<audio id="Red" src="audio/red.mp3" preload="auto"></audio>
<audio id="Green" src="audio/green.mp3" preload="auto"></audio>
<audio id="Blue" src="audio/blue.mp3" preload="auto"></audio>
<audio id="Yellow" src="audio/yellow.mp3" preload="auto"></audio>
<audio id="Buzzer" src="audio/buzzer.mp3" preload="auto"></audio>

</body>
</html>