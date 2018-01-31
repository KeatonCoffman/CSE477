<?php
/**
 * The collection of available games.
 */

namespace Nurikabe;

/**
 * The collection of available games.
 */
class Games {

	public static $games = [
		'3x3ultraeasy' => ['desc'=>'3x3 Ultra Easy',
			'game'=>[
				[1, Cell::SEA, 1],
				[Cell::SEA, Cell::SEA, Cell::SEA],
				[2, Cell::ISLAND, Cell::SEA]
			]
		],

		'8x8veryeasy' => ['desc'=>'8x8 Very Easy',
			'game'=>[
				[Cell::SEA, Cell::SEA, 2, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA],
				[Cell::SEA, 1, Cell::SEA, Cell::SEA, Cell::SEA, 4, Cell::ISLAND, Cell::SEA],
				[Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, 2, Cell::SEA, Cell::ISLAND, Cell::SEA],
				[Cell::SEA, 2, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, Cell::SEA],
				[4, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, 2, Cell::SEA, Cell::SEA],
				[Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND],
				[Cell::ISLAND, Cell::SEA, Cell::ISLAND, 3, Cell::SEA, Cell::ISLAND, Cell::SEA, 3],
				[Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, 3, Cell::SEA, Cell::ISLAND]
			]
		],

		'10x10easy' => ['desc' => '10x10 Easy',
			'game'=>[
				[4, Cell::ISLAND, Cell::ISLAND, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, 1],
				[Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::SEA],
				[Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::ISLAND, Cell::SEA, 3, Cell::SEA, 3, Cell::SEA],
				[Cell::SEA, 2, Cell::SEA, 3, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, Cell::SEA],
				[1, Cell::SEA, Cell::SEA, Cell::SEA, 4, Cell::ISLAND, Cell::SEA, 3, Cell::SEA,Cell::SEA],
				[Cell::SEA, Cell::SEA, 2, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::SEA, 5],
				[Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::ISLAND],
				[Cell::SEA, Cell::ISLAND, Cell::SEA, 1, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND],
				[Cell::SEA, Cell::ISLAND, 4, Cell::SEA, Cell::SEA, 3, Cell::ISLAND, Cell::ISLAND, Cell::SEA, Cell::ISLAND],
				[Cell::SEA,Cell::SEA,Cell::SEA, Cell::ISLAND, 2, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND]
			]
		],

		'8x8medium' => ['desc'=>'8x8 Medium',
			'game'=>[
				[Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA],
				[2, Cell::SEA, Cell::ISLAND, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::ISLAND, Cell::ISLAND],
				[Cell::SEA, 4, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND],
				[Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA, 2, Cell::ISLAND, Cell::SEA, 6],
				[Cell::SEA, Cell::ISLAND, Cell::SEA, 2, Cell::SEA, Cell::SEA, Cell::SEA, Cell::ISLAND],
				[Cell::SEA, 2, Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::ISLAND, Cell::SEA, Cell::SEA],
				[5, Cell::SEA, Cell::SEA, Cell::SEA, 4, Cell::ISLAND, Cell::ISLAND, Cell::SEA],
				[Cell::ISLAND, Cell::ISLAND, Cell::ISLAND, Cell::ISLAND, Cell::SEA, Cell::SEA, Cell::SEA, Cell::SEA]
			]

		]

	];

	public static function getGames() {
		return self::$games;
	}

	public static function getGame($id) {
		if(!isset(self::$games[$id])) {
			return null;
		}

		return self::$games[$id];
	}
}