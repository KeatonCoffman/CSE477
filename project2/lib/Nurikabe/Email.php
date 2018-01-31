<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 6:46 PM
 */

namespace Nurikabe;


class Email
{
    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }

}