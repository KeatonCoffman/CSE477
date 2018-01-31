<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/16/17
 * Time: 5:56 PM
 */

namespace Felis;


class DeleteCaseView extends View
{
    public function __construct(){
        $this->addLink("./post/logout.php","Log out");
        $this->setTitle("Felis Staff");
    }

}