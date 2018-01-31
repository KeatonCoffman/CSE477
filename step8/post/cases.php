<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/15/17
 * Time: 6:21 PM
 */
require '../lib/site.inc.php';
$controller = new Felis\CasesController($site, $_POST);
header("location: " . $controller->getRedirect());