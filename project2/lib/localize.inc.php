<?php
require __DIR__ . "/../vendor/autoload.php";

$site = new \Nurikabe\Site();
$SiteFunction =  function(Nurikabe\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('coffma30@cse.msu.edu');
    $site->setRoot('/~coffma30/project2');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=coffma30',
        'coffma30',       // Database user
        'h2dQaQ7QExfNnGEv',     // Database password
        'p2_');            // Table prefix



};

if(is_callable($SiteFunction)) {
    $SiteFunction($site);
}