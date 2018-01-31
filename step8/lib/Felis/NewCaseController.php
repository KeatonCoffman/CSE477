<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/15/17
 * Time: 6:23 PM
 */

namespace Felis;


class NewCaseController{

    private $redirect;

    public function __construct($site,$user, $post)
    {
        $root = $site->getRoot();
        if(!isset($post['ok'])) {
            $this->redirect = "$root/cases.php";
            return;
        }
        $cases = new Cases($site);
        $id = $cases->insert(strip_tags($post['client']),
            $user->getId(),
            strip_tags($post['number']));

        if($id === null){
            $this->redirect = "$root/newcase.php?e";
        } else {
            $this->redirect = "$root/case.php?id=$id";
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