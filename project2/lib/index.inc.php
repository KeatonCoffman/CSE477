<?php
require __DIR__ . "/../vendor/autoload.php";

session_start();

if(isset($_SESSION['game'])){
    unsset($_SESSION['game']);
}