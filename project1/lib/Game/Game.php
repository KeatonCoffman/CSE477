<?php
namespace Game;


class Game
{

    private $solution=array();
    private $state=array();
    private $number_cells=array();
    private $red_cells=array();
    private $empty_cells=array();
    public $name="";
    private $none=array();
    private $count;

    private $ask_solve=false;
    private $ask_clear=false;
    private $status=false;

    private $active = false;


    public $answers= [
        '3x3 Ultra Easy'=> ['desc'=>'3x3 Ultra Easy', 'game'=>[[1, 'sea', 1],
            ['sea', 'sea', 'sea'],
            [2, 'island', 'sea']]],
        'VeryEasy'=> ['desc'=>'8x8 Very Easy', 'game'=>[['sea', 'sea', 2, 'sea', 'sea', 'sea', 'sea', 'sea'],
            ['sea', 1, 'sea', 'sea', 'sea', 4, 'island', 'sea'],
            ['sea', 'sea', 'sea', 'island', 2, 'sea', 'island', 'sea'],
            ['sea', 2, 'island', 'sea', 'sea', 'sea', 'island', 'sea'],
            [4, 'sea', 'sea', 'sea', 'island', 2, 'sea', 'sea'],
            ['island', 'sea', 'island', 'sea', 'sea', 'sea', 'sea', 'island'],
            ['island', 'sea', 'island', 3, 'sea', 'island', 'sea', 3],
            ['island', 'sea', 'sea', 'sea', 'island', 3, 'sea', 'island']]],
        '10x10 Easy'=> ['desc'=>'10x10 Easy', 'game'=>[[4, 'island', 'island', 'island', 'sea', 'sea', 'sea', 'sea', 'sea', 1],
            ['sea', 'sea', 'sea', 'sea','sea', 'island', 'island', 'sea', 'island', 'sea'],
            ['sea', 'island', 'sea', 'island', 'island', 'sea', 3, 'sea', 3, 'sea'],
            ['sea', 2, 'sea', 3, 'sea', 'sea', 'sea', 'sea', 'island', 'sea'],
            [1, 'sea', 'sea', 'sea', 4, 'island', 'sea', 3, 'sea', 'sea'],
            ['sea', 'sea', 2, 'island', 'sea', 'island', 'sea', 'island', 'sea', 5],
            ['sea', 'island', 'sea', 'sea', 'sea', 'island', 'sea', 'island', 'sea', 'island'],
            ['sea', 'island', 'sea', 1, 'sea', 'sea', 'sea', 'sea', 'sea', 'island'],
            ['sea', 'island', 4, 'sea', 'sea', 3, 'island', 'island', 'sea', 0],
            ['sea', 'sea', 'sea', 'island', 2, 'sea', 'sea', 'sea', 'sea', 'island']]],
        '8x8 Medium'=> ['desc'=>'8x8 Medium', 'game'=>[['island', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea', 'sea'],
            [2, 'sea', 'island', 'island', 'sea', 'island', 'island', 'island'],
            ['sea', 4, 'island', 'sea', 'sea', 'sea','sea', 'island'],
            ['sea', 'sea', 'sea', 'sea', 2, 'island', 'sea', 6],
            ['sea', 'island', 'sea', 2, 'sea', 'sea', 'sea', 'island'],
            ['sea', 2, 'sea', 'island', 'sea', 'island', 'sea', 'sea'],
            [5, 'sea', 'sea', 'sea', 4, 'island', 'island', 'sea'],
            ['island', 'island', 'island', 'island', 'sea', 'sea', 'sea', 'sea']]],

    ];
    public $games = [ '3x3 Ultra Easy'=> ['desc'=>'3x3 Ultra Easy', 'game'=>[[1, 'j', 1], ['j', 'j', 'j'], [2, 'j', 'j']]], '8x8 Very Easy'=> ['desc'=>'8x8 Very Easy', 'game'=>[[0, 0, 2, 0, 0, 0, 0, 0], [0, 1, 0, 0, 0, 4, 0, 0], [0, 0, 0, 0, 2, 0, 0, 0],[0, 2, 0, 0, 0, 0, 0, 0],[4, 0, 0, 0, 0, 2, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 3, 0, 0, 0, 3],[0, 0, 0, 0, 3, 0, 0, 0] ]], '10x10 Easy'=> ['desc'=>'10x10 Easy', 'game'=>[[4, 0, 0, 0, 0, 0, 0, 0, 0, 1], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0], [0, 0, 0, 0, 0, 0, 3, 0, 3, 0],[0, 2, 0, 3, 0, 0, 0, 0, 0, 0],[1, 0, 0, 0, 4, 0, 0, 3, 0, 0],[0, 0, 2, 0, 0, 0, 0, 0, 0, 5],[0, 0, 0, 0, 0, 0, 0, 0, 0, 0],[0, 0, 0, 1, 0, 0, 0, 0, 0, 0],[0, 0, 4, 0, 0, 3, 0, 0, 0, 0],[0, 0, 0, 0, 2, 0, 0, 0, 0, 0] ]],
            '8x8 Medium'=> ['desc'=>'8x8 Medium', 'game'=>[[0, 0, 0, 0, 0, 0, 0, 0], [2, 0, 0, 0, 0, 0, 0, 0], [0, 4, 0, 0, 0, 0, 0, 0],[0, 0, 0, 0, 2, 0, 0, 6],[0, 0, 0, 2, 0, 0, 0, 0],[0, 2, 0, 0, 0, 0, 0, 0],[5, 0, 0, 0, 4, 0, 0, 0],[0, 0, 0, 0, 0, 0, 0, 0] ]],];


    public function __construct() {


    }

    public function getCount(){
        $dim_string = $this->getDimension();
        $count = $dim_string[0];
        return $count;
    }

    public function getRed_array(){
        return $this->red_cells;
    }

    public function getNum_array(){
        return $this->number_cells;
    }

    public function getState_array(){
        return $this->state;
    }


    public function getSolution(){
        return $this->answers;
    }

    public function askSolve(){
        $this->ask_solve = true;
    }

    public function noSolve(){
        $this->ask_solve = false;
    }

    public function getSolve(){
        return $this->ask_solve;
    }

    public function getClear(){
        return $this->ask_clear;
    }

    public function askClear(){
        $this->ask_clear = true;
    }

    public function noClear(){
        $this->ask_clear = false;
    }



    public function getDimension(){
        return $this->dimension_name;
    }

    public function getGame(){
        return $this->games;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($val){
        $this->name = $val;
        $this->active = true;
    }



    public function destroyGame() {
        $this->count=0;
        $this->solution=array();
        $this->state=array();
        $this->number_cells=array();
        $this->red_cells=array();
        $this->empty_cells=array();
        $this->ask_solve=false;
        $this->ask_clear=false;
        $this->status=false;
    }
    public $dimension_name;

    public function ActiveGame() {
        return $this->active;
    }

    public function setActive($val){
        $this->active = $val;
    }

    public function buttonClick($row,$col){
        $val = $this->games[$this->getDimension()]['game'][$row][$col];
        if (is_numeric($val))
        {
            //$this->games[$this->getDimension()]['game'][$row][$col] = 's';
        }
        else if($val == 'sea')
        {
            $this->games[$this->getDimension()]['game'][$row][$col] = 'island';
        }
        else if($val == 'island')
        {
            $this->games[$this->getDimension()]['game'][$row][$col] = '&nbsp;';
        }

    }

    public function cellCheck(){
        $cells = count($this->answers);
        for ($i=0;$i<$cells;$i++){
            for ($j=0;$j<$cells;$j++){
                if ($this->games[$this->getDimension()]['game'][$i][$j] !== $this->answers[$this->getDimension()]['game'][$i][$j]){
                    return false;
                }
            }
        }
        return true;
    }
/**
    public function userCheck(){
        $cells = count($this->answers);
        for ($i=0;$i<$cells;$i++){
            for ($j=0;$j<$cells;$j++){
                if ($this->games[$this->getDimension()]['game'][$i][$j]!==$this->answers[$this->getDimension()]['game'][$i][$j]  && $this->games[$this->getDimension()]['game'][$i][$j]){
                    $this->red_cells[$i][$j]=1;
                }
            }
        }
    }
**/
    public function delete(){
        $this->state = $this->none;
        $this->red_cells = $this->none;
    }
    public function get_game()
    {
        return $this->games;
    }

}