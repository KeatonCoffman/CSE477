<?php
require __DIR__ . "/../../vendor/autoload.php";

//require "GuessingView.php";
//namespace Guessing;
use Guessing\Guessing as Guessing;
use Guessing\GuessingView as GuessingView;

class GuessingViewTest extends \PHPUnit_Framework_TestCase{

    const SEED = 1234;
    const NUM_OF_GUESSES = '<form method="post" action="guessing-post.php">' .
    '<h1>Guessing Game</h1><p class="message">Your guess of 0 is invalid!</p>
<p><label for="value">Guess:</label> <input type="text" name="value" id="value"></p>
<p><input type="submit"></p><p><input type="submit" name="clear" value="New Game"></p></form>';

    const WAY_OFF ='<form method="post" action="guessing-post.php">' .
    '<h1>Guessing Game</h1><p class="message">Your guess of WAY OFF is invalid!</p>
<p><label for="value">Guess:</label> <input type="text" name="value" id="value"></p>
<p><input type="submit"></p><p><input type="submit" name="clear" value="New Game"></p></form>';

    const CORRECT ='<form method="post" action="guessing-post.php"> <br>
    <h1>Guessing Game</h1><p class="message">After 1 guesses you are correct!</p>
<p><input type="submit" name="clear" value="New Game"></p></form>';

    const TOOHIGH_LOW='<form method="post" action="guessing-post.php">' .
    '<h1>Guessing Game</h1><p class="message">After 1 guesses you are too low!</p>
<p><label for="value">Guess:</label> <input type="text" name="value" id="value"></p>
<p><input type="submit"></p>'.'<p><input type="submit" name="clear" value="New Game"></p></form>';

    public function test_construct() {
        $guessing = new Guessing(self::SEED);

        $view = new GuessingView($guessing);

    }

    public function test_present() {
        $guessing = new Guessing(self::SEED);
        $view = new GuessingView($guessing);


        // $num(ofguesses) == 0
        $this->assertContains(self::NUM_OF_GUESSES,$view->present());


        // $check == Guessin::INVALID
        $guessing->guess("WAY OFF");
        $this->assertContains(self::WAY_OFF,$view->present());

        // $check == Guessin::CORRECT
        //$guessing->guess(23);
        //$this->assertEquals(self::CORRECT,$view->present());


        // $check == Guessin::TOOHIGH || $check == Guessin::TOOLOW
        $guessing->guess(18);
        $this->assertContains(self::TOOHIGH_LOW,$view->present());

        //$guessing->guess(56);
        //$this->assertEquals(self::TOOHIGH_LOW,$view->present());


    }

}