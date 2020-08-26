<?php

namespace Classes;

use Classes\Pieces\Bomb;
use Classes\Pieces\Field;
use Classes\Pieces\Piece;
use Classes\Pieces\Queen;

class Chessboard
{
    private $dimensions;
    private $board;
    private $bombsCount;

    public function makeBoard($filename)
    {
        $file = fopen($filename, "r");

        // First line (Board and bombs)
        $line = fgets($file);
        $data = explode(' ', $line);
        $this->dimensions = (int) $data[0];
        $this->bombsCount = (int) $data[1];
        $this->makeEmptyBoard();

        // Second line (Queen)
        $line = fgets($file);
        $data = explode(' ', $line);
        $this->putPiece(new Queen(), (int) $data[0], (int) $data[1]);

        // Bombs coordinates
        if ($this->bombsCount) {
            while (($line = fgets($file)) !== false) {
                $data = explode(' ', $line);
                $this->putPiece(new Bomb(), (int) $data[0], (int) $data[1]);
            }
        }

        fclose($file);
    }

    private function makeEmptyBoard()
    {
        for($i = 0; $i < $this->dimensions; $i++) {
            $this->board[$i] = [];

            for($j = 0; $j < $this->dimensions; $j++) {
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
        $this->board[$x-1][$y-1] = $piece;
    }

    /**
     *
     */
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

    /**
     * @return string
     */
    private function lineStr()
    {
        return '---'.str_pad('', ($this->dimensions-1)*2, '--');
    }
}