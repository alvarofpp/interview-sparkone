<?php

namespace Classes;

use Classes\Pieces\Field;
use Classes\Pieces\Piece;

class Chessboard
{
    private $dimensions;
    private $board;

    function __construct($dimensions)
    {
        $this->dimensions = $dimensions;
        $this->board = [];

        for($i = 0; $i < $dimensions; $i++) {
            $this->board[$i] = [];

            for($j = 0; $j < $dimensions; $j++) {
                $this->board[$i][] = new Field();
            }
        }
    }

    /**
     * @param Piece $piece
     * @param int $x
     * @param Int $y
     */
    public function putPiece(Piece $piece, int $x, int $y)
    {
        $this->board[$x][$y] = $piece;
    }

    public function print()
    {
        $print = $this->lineStr()."\n";
        foreach ($this->board as $row) {
            $print .= '|';
            foreach ($row as $piece) {
                $print .= $piece->getSymbol() . '|';
            }
            $print .= "\n";
        }
        $print .= $this->lineStr()."\n";

        echo $print;
    }

    private function lineStr()
    {
        return '---'.str_pad('', ($this->dimensions-1)*2, '--');
    }
}