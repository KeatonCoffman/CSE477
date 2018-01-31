<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/10/17
 * Time: 8:35 PM
 */

namespace Game;


class InstructionsViewTest extends \PHPUnit_Framework_TestCase
{
    public function test_construct() {
        $name = "TOM";
        $dimension = 3;
        $game = new Game($dimension, $name);

        $view = new InstructionsView($game);

    }

}