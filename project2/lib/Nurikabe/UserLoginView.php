<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 12:33 PM
 */

namespace Nurikabe;


class UserLoginView extends View
{
    private $msg="";

    public function __construct($get)
    {

        if(isset($get['e'])){
            if($get['e'] === '1'){
                $this->msg = "<p>Invalid login.</p>";
            }
        }

    }

    public function loginForm(){

        /**
        if(isset($session['error'])){
            $this->msg = $session['error'];
        }
         **/

        $html = <<<HTML
        <div class="body">
<form class="newgame" action="post/userlogin.php" method="post">
<div class="controls">
		<p>
			<label for="email">Email</label><br>
			<input type="text" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password:</label><br>
			<input type="password" id="password" name="password" placeholder="password">
		</p>
		<p><input type="submit" name="ok" value="Login"></p>
	    <p><input type="submit" name="cancel" value="Cancel"></p>
		$this->msg
		</div>
</form>
</div>
HTML;
        return $html;

    }


}