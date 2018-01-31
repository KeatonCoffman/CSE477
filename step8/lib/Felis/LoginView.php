<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 10:02 PM
 */

namespace Felis;
class LoginView extends View
{
    public function __construct(array &$session, array $get)
    {
        if(isset($get['e'])){
            $this->error = $session["error"];
        }
    }
    public function displayError(){
        if($this->error !== null){
            return "<p class='errorMessage'>$this->error</p>";
        }
        else{
            return "";
        }
    }
    private $error= "";
}