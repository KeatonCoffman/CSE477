<?php
/**
 * @file
 * A file loaded for all pages on the site.
 */
require __DIR__ . "/../vendor/autoload.php";

define("LOGIN_SESSION", "ajaxnoir_login");

define("LOGIN_COOKIE", "ajaxnoir_cookie");

// Start the session system
session_start();

// Create and localize the Site object
$site = new Noir\Site();
$localize = require 'localize.inc.php';
if(is_callable($localize)) {
	$localize($site);
}

/*
 * Login functionality
 */
if(!isset($open)) {
	// This is a page other than the login pages
	if (!isset($_SESSION[LOGIN_SESSION])) {
        if(isset($_COOKIE[LOGIN_COOKIE]) && $_COOKIE[LOGIN_COOKIE] !== "") {
            $cookie = json_decode($_COOKIE[LOGIN_COOKIE], true);

            // We have a valid cookie
            $user = $cookie['user'];

            // It's valid, we can log in!
            $_SESSION[LOGIN_SESSION] = array("user" => $user);

            //$hash = $cookie['hash'];
            //$user->delete($hash);

            $cookies = new \Noir\Cookies($site);

            $token = $cookies->create($user);
            $newCookie = array('user'=> $user, 'token'=> $token);
            $expire = time() + (86400*365);
            setcookie(LOGIN_COOKIE, json_encode($newCookie), $expire, "/");
        }else{
            // If not logged in, force to the login page
            $root = $site->getRoot();
            header("location: $root/login.php");
            exit;
        }
	} else {
		// We are logged in.
		$user = $_SESSION[LOGIN_SESSION]['user'];
	}
}

