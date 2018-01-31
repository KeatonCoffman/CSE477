<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/16/17
 * Time: 5:57 PM
 */

namespace Felis;


class DeleteController
{
    private $redirect;
    public function __construct(Site $site, $post, $get)
    {
        if(isset($post['delete']) && $post['delete'] = "Yes" && isset($get['id'])){
            $cases = new Cases($site);
            $cases->deleteCase($get['id']);
        }
        $this->redirect = "{$site->getRoot()}/cases.php";
    }
    public function getRedirect(){
        return $this->redirect;
    }

}