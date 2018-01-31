<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 1:53 PM
 */

namespace Nurikabe;


class NewUserView extends View
{
    private $msg = '';

    public function __construct($get)
    {
        parent::__construct($get);

        if(isset($get['e'])){
            if($get['e'] === '1'){
                $this->msg = "<p>You must supply a name.</p>";
            }
            if($get['e'] === '2'){
                $this->msg = "<p>You must supply an email address.</p>";
            }
            if($get['e'] === '3'){
                $this->msg = "<p>Email address already exists.</p>";
            }
        }

    }

    public function userForm(){


        $html = <<<HTML
<form class="newgame" method="post" action="post/newuser.php">
    <p class="register">If you create an account on Nifty Nurikabe, you can save and load games as you play.</p>
	<div class="controls">
	
	<p class="name"><label for="name">Name </label><br><input type="text" id="name" name="name"></p>
	<p class="name"><label for="email">Email </label><br><input type="email" id="email" name="email"></p>
	<p><button name="ok">Create Account</button></p>
	<p><button name="cancel">Cancel</button></p>	
	$this->msg
	</div>
</form>
HTML;
        return $html;

    }

}