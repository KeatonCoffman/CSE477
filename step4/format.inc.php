<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 5/25/17
 * Time: 6:18 PM
 */
function present_header($title) {
    $html = "<header>";
    $html .= "<p><a href=\"welcome.php\">New Game</a> ";
    $html .= "<a href=\"game.php\">Game</a> ";
    $html .= "<a href=\"instructions.php\">Instructions</a></p>";
    $html .= "<h1>$title</h1>";
    $html .= "</header>";

    return $html;
}

?>