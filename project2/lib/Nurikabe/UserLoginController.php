<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 12:50 PM
 */

namespace Nurikabe;


class UserLoginController{

    private $redirect;
    const ERROR1 = '1';//Invalid login credentials

    public function __construct(Site $site, &$session, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/";

        $email = trim(strip_tags($post['email']));
        $pass = trim(strip_tags($post['password']));


        if(isset($post['ok'])) {
            $users = new Users($site);
            $user = $users->login($email, $pass);
            if($user !== null){
                $session['user'] = $user;
                $this->redirect = "$root/";
                return;
            }
            else{
                $session['error'] = "You must enter a name!";
                $this->redirect = "$root/login.php?e=".self::ERROR1;
                return;
            }
        }

    }

    public function getRedirect(){
        return $this->redirect;
    }


}