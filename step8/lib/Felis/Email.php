<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/17/17
 * Time: 1:12 PM
 */

namespace Felis;


/**
 * Email adapter class
 */
class Email {
    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }
}