<?php

namespace Classes\Pieces;

use Classes\Chessboard;

abstract class Piece
{
    public $symbol;
    protected $x;
    protected $y;

    public function move(Chessboard &$chessboard)
    {
        return null;
    }

    public function setCoordinates(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}