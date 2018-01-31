<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 5:51 PM
 */

namespace Nurikabe;


class NewUserController
{
    private $redirect;
    public function __construct($site, $post)
    {
        $this->redirect = "{$site->getRoot()}";
        if(isset($post['ok'])){
            $name = trim(strip_tags($post['name']));
            $email = trim(strip_tags($post['email']));
            $mailer = new Email();
            $subject = 'Confirm your email';
            $from = $site->getEmail();

            if($name == ""){
                $this->redirect = "{$site->getRoot()}/newuser.php?e=1";
                return;
            }
            if($email == ""){
                $this->redirect = "{$site->getRoot()}/newuser.php?e=2";
                return;
            }

            $user = new Users($site);
            if($user->email_exists($email)){
                $this->redirect = "{$site->getRoot()}/newuser.php?e=3";
                return;
            }

            $validators = new Validators($site);
            $validator = $validators->newValidator($name, $email);



            // Send email with the validator in it
            $link = "http://webdev.cse.msu.edu/~coffma30/project2/validate_password.php?v=" . $validator;

            $message = <<<MSG
<html>
<p>Greetings $name,</p>

<p>Welcome to Nifty Nurikabe. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
            $header =  "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
            $mailer->mail($email,$subject,$message,$header);
            $this->redirect = "{$site->getRoot()}/pendinguser.php";

            //$user = new User();

            //$validators->add($name,$email, $mailer);
        }
    }
    public function getRedirect(){
        return $this->redirect;
    }

}