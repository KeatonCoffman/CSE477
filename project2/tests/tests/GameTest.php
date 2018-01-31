<?php
require __DIR__ . "/../../vendor/autoload.php";

use Nurikabe\Cell;

/** @file
 * Unit tests for the class Game
 * @cond 
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
	public function test_set() {
		$game = new \Nurikabe\Game();

		$this->assertFalse($game->setGameById("invalid"));

		$this->assertTrue($game->setGameById("3x3ultraeasy"));
		$this->assertEquals("3x3 Ultra Easy", $game->getDesc());

		$grid = $game->getGrid();
		$this->assertEquals(3, count($grid));
		foreach($grid as $row) {
			$this->assertEquals(3, count($row));
		}

		for($r=0; $r<3; $r++) {
			for($c=0; $c<3; $c++) {
				$cell = $grid[$r][$c];
				if($r == 0 && $c == 0) {
					$this->assertEquals(1, $cell->getExpected());
					$this->assertEquals(1, $cell->getCurrent());
				} else if($r == 0 && $c == 2) {
					$this->assertEquals(1, $cell->getExpected());
					$this->assertEquals(1, $cell->getCurrent());
				} else if($r == 2 && $c == 0) {
					$this->assertEquals(2, $cell->getExpected());
					$this->assertEquals(2, $cell->getCurrent());
				} else if($r == 2 && $c == 1) {
					$this->assertEquals(Cell::ISLAND, $cell->getExpected());
					$this->assertEquals(Cell::NONE, $cell->getCurrent());
				} else {
					$this->assertEquals(Cell::SEA, $cell->getExpected());
					$this->assertEquals(Cell::NONE, $cell->getCurrent());
				}
			}

		}
	}
}

/// @endcond
