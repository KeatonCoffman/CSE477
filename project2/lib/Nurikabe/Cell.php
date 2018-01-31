<?php
/**
 * A single cell in the Nurikabe grid
 * @author Charles B. Owen
 */

namespace Nurikabe;

/**
 * A single cell in the Nurikabe grid
 */
class Cell {
	const NONE = 0;		///< Value when a cell is empty
	const ISLAND = -1;	///< Value when a cell is an island
	const SEA = -2;		///< Value when a cell is the sea

	/**
	 * Cell constructor.
	 * @param $expected Value expected in cell location
	 * @param $row Row number
	 * @param $col Column number
	 */
	public function __construct($expected, $row, $col) {
		$this->expected = $expected;
		if($this->expected > 0) {
			$this->current = $this->expected;
		} else {
			$this->current = self::NONE;
		}

		$this->row = $row;
		$this->col = $col;
	}

	/**
	 * Handle a click on the cell.
	 * Rotates NONE -> SEA -> ISLAND -> NONE
	 */
	public function click() {
		switch($this->current) {
			default:
				$this->current = self::SEA;
				break;

			case self::ISLAND:
				$this->current = self::NONE;
				break;

			case self::SEA:
				$this->current = self::ISLAND;
				break;
		}
	}

	/**
	 * Clear this cell to an initial game state
	 */
	public function clear() {
		if($this->current > 0) {
			return;
		}

		$this->current = self::NONE;
	}

	/**
	 * Solve this cell
	 */
	public function solve() {
		$this->current = $this->expected;
	}

	/**
	 * Is this cell solved?
	 * @return bool True is cell is solved
	 */
	public function solved() {
		return $this->current == $this->expected;
	}

	/**
	 * What is the expected value at this cell?
	 * @return expected value
	 */
	public function getExpected() {
		return $this->expected;
	}

	/**
	 * What is the current value at this cell?
	 * @return current value
	 */
	public function getCurrent() {
		return $this->current;
	}

	/**
	 * Set the value at this cell.
	 * @param $s Value to set
	 */
	public function set($s) {
		$this->current = $s;
	}

	/**
	 * Create a <td> tag for this cell.
	 * @param $button If true, create a button in the cell
	 * @param $checking If true, add bad class to errors
	 * @return string HTML
	 */
	public function present($button, $checking) {
		if($this->current > 0) {
			return "<td>$this->current</td>";
		}

		$class = "none";
		$contents = "&nbsp;";

		switch($this->current) {
			case self::ISLAND:
				$class = "dot";
				$contents = "&#9679;";
				if($checking && $this->expected != self::ISLAND) {
					$class .= " bad";
				}
				break;

			case self::SEA:
				$class = "sea";
				if($checking && $this->expected != self::SEA) {
					$class .= " bad";
				}
				break;
		}

		if($button) {
			$value = $this->row . "," . $this->col;
			return "<td class=\"cell $class\"><button name=\"cell\" value=\"$value\">" .
				"$contents</button></td>";
		} else {
			return "<td class=\"cell $class\">$contents</td>";
		}
	}

	private $expected;	///< Expected value for a cell
	private $current;	///< Current value
	private $row;		///< Cell row
	private $col;		///< Cell column
}