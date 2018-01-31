<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 9:27 PM
 */

namespace Felis;


class LoginController
{
    private $redirect;

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param mixed $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }	///< Page we will redirect the user to.

    /**
     * LoginController constructor.
     * @param Site $site The Site object
     * @param array $session $_SESSION
     * @param array $post $_POST
     */
    public function __construct(Site $site, array &$session, array $post) {
        // Create a Users object to access the table
        $users = new Users($site);

        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);
        $user = $users->login($email, $password);
        $session[User::SESSION_NAME] = $user;

        $root = $site->getRoot();
        if($user === null) {
            // Login failed
            $this->redirect = "$root/login.php?e";
            $session["error"] = "The login credentials were incorrect";
        } else {
            if($user->isStaff()) {
                $this->redirect = "$root/staff.php";
            } else {
                $this->redirect = "$root/client.php";
            }
        }

    }

}