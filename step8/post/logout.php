<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 9:55 PM

 **/

require '../lib/site.inc.php';
unset($_SESSION['user']);
header("location: " . "../$root");