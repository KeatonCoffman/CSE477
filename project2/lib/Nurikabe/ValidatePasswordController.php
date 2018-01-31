<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 10:15 PM
 */

namespace Nurikabe;


class ValidatePasswordController
{


    private $redirect;
    const ERROR1 = '1';//wrong validator
    const ERROR2 = '2';//validator and email mismatch
    const ERROR3 = '3';//password conflicts
    const ERROR4 = '4';//password too short

    public function __construct(Site $site, array $post)
    {
        $root = $site->getRoot();
        $this->redirect = "$root/";

        if (isset($post['ok'])) {

            $validators = new Validators($site);
            $validator = strip_tags($post['validator']);
            $user = $validators->get($validator);
            $RegisterEmail = trim(strip_tags($user['email']));
            $RegisterName = trim(strip_tags($user['name']));
            $RegisterValidator = trim(strip_tags($user['userid']));
            if ($user === null) {
                $this->redirect = "$root/validate_password.php?v=$validator&e=" . self::ERROR1;
                return;
            }



            $email = trim(strip_tags($post['email']));
            if ($email !== $RegisterEmail) {
                // Email entered is invalid
                $this->redirect = "$root/validate_password.php?v=$validator&e=" . self::ERROR2;
                return;
            }


            $password1 = trim(strip_tags($post['password1']));
            $password2 = trim(strip_tags($post['password2']));
            if ($password1 !== $password2) {
                // Passwords do not match
                $this->redirect = "$root/validate_password.php?v=$validator&e=" . self::ERROR3;
                return;
            }

            if (strlen($password1) < 8) {
                // Password too short
                $this->redirect = "$root/validate_password.php?v=$validator&e=" . self::ERROR4;
                return;
            }

            // works
            $users = new Users($site);
            // works
            $row = array('email' => $RegisterEmail, 'name' => $RegisterName, 'validator' => $RegisterValidator);

            // specifies user database
            $user = new User($row);


            $users->createUser($user, $password1);



        }

    }

    public function getRedirect(){
        return $this->redirect;
    }
}