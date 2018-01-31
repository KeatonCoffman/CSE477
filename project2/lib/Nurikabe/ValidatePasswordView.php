<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 10:14 PM
 */

namespace Nurikabe;


class ValidatePasswordView extends View
{
    private $validator;
    private $msg = '';
    public function __construct($get)
    {

        if(isset($get['v'])){
            $this->validator = $get['v'];
        }

        if(isset($get['e'])){
            if($get['e'] === '1'){
                $this->msg = "<p>Wrong Validator.</p>";
            }
            if($get['e'] === '2'){
                $this->msg = "<p>Validator and Email do not match.</p>";
            }
            if($get['e'] === '3'){
                $this->msg = "<p>Passwords do not match.</p>";
            }
            if($get['e'] === '4'){
                $this->msg = "<p>Passwords too short.</p>";
            }
        }

    }

    public function form(){
        $html = <<<HTML
<form class="newgame" action="post/validate_password.php" method="post">
<input type="hidden" name="validator" value="$this->validator">
<div class="container">
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password1">Password:</label><br>
			<input type="password" id="password1" name="password1" placeholder="password">
		</p>
		<p>
			<label for="password2">Password (again):</label><br>
			<input type="password" id="password2" name="password2" placeholder="password">
		</p>
		<p><button name="ok">Create Account</button></p>
	    <p><button name="cancel">Cancel</button></p>
		$this->msg;
		</div>
</form>

HTML;
        return $html;
    }

}