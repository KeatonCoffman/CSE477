<?php
require '../lib/localize.inc.php';
session_start();
unset($_SESSION['user']);
header("location: " . $site->getRoot());