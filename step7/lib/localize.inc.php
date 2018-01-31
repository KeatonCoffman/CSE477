<?php
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('coffma30@cse.msu.edu');
    $site->setRoot('/~coffma30/step7');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=coffma30',
        'coffma30',       // Database user
        'h2dQaQ7QExfNnGEv',     // Database password
        '');            // Table prefix



};


