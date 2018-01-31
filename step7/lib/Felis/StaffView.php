<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 5:26 PM
 */

namespace Felis;


class StaffView extends View
{

    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
        $this->addLink("index.php","Log out");
    }

    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>Felis Investigations Staff</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lib/css/felis.css">
HTML;
    }


    public function footer(){

    }

    public function header(){
        return <<<HTML
<header class="main">
	<h1><img src="images/comfortable.png" alt="Felis Mascot"> Felis Staff <img src="images/comfortable.png" alt="Felis Mascot"></h1>
</header>

HTML;

    }

}