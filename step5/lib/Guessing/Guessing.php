<?php
namespace Guessing;
require __DIR__ . "/../../vendor/autoload.php";
require "guessing.inc.php";



class Guessing
{
    const INVALID = "INVALID";
    const TOOLOW = "TOOLOW";
    const TOOHIGH = "TOOHIGH";
    const CORRECT = "CORRECT";
    const MIN = 1;
    const MAX = 100;
    //static public $guesses = 0;

    public function __construct($seed = null) {
        if($seed === null || !is_numeric($seed)) {
            $seed = time();
        }

        $this->guesses = 0;
        $this->current_guess = 0;

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
    }

    private $number;

    public function getNumGuesses() {
        return $this->guesses;
    }

    public function check() {

        if(!is_numeric($this->current_guess)){
            return Guessing::INVALID;
        }

        if($this->current_guess > Guessing::MAX){
            return Guessing::INVALID;
        }
        if($this->current_guess < Guessing::MIN){
            return Guessing::INVALID;
        }
        if($this->current_guess < $this->number){
            return Guessing::TOOLOW;
        }
        if($this->current_guess > $this->number){
            return Guessing::TOOHIGH;
        }
        if($this->current_guess === $this->number){
            return Guessing::CORRECT;
        }

    }

    public function getGuess() {
        return $this->current_guess;
    }

    public function guess($num) {

        $this->current_guess = $num;
        if($this->current_guess > Guessing::MIN &&  $this->current_guess < Guessing::MAX){
            $this->guesses++;
        }

    }

    public function getNumber() {
        return $this->number;
    }
}