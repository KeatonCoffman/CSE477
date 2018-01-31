<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/15/17
 * Time: 6:23 PM
 */

namespace Felis;


class CasesController{
    private $redirect;

    public function __construct($site, $post)
    {
        $root = $site->getRoot();

        if(isset($post["add"])){
            $this->redirect = "$root/newcase.php";
        }
        /**
        else{
            $this->redirect = "$root/cases.php";
        }
        **/
        else if(isset($post["delete"])){
            $delete_user = $post['user'];
            $this->redirect = "$root/deletecase.php?id=$delete_user";
        }
    }
    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

}