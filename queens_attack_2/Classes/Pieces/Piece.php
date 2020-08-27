<?php

namespace Classes\Pieces;

/**
 * Class Piece
 * Class that defines the pieces of the board.
 * @package Classes\Pieces
 */
abstract class Piece
{
    /**
     * Symbol of the piece.
     * @var string
     */
    public $symbol;
    /**
     * X axis coordinate.
     * @var int
     */
    public $x;
    /**
     * Y axis coordinate.
     * @var int
     */
    public $y;

    /**
     * Saves the coordinates of the piece.
     * @param int $x
     * @param int $y
     */
    public function setCoordinates(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}