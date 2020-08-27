<?php

namespace Classes;

use Classes\Pieces\Bomb;
use Classes\Pieces\Field;
use Classes\Pieces\Limit;
use Classes\Pieces\Path;
use Classes\Pieces\Piece;
use Classes\Pieces\Queen;

class Chessboard
{
    public $dimensions;
    public $board;
    private $bombsCount;
    private $memory = [
        'queen' => null,
        'paths' => [],
    ];

    public function makeBoard($filename)
    {
        $file = fopen($filename, "r");

        // First line (Board and bombs)
        $line = fgets($file);
        $data = explode(' ', $line);
        $this->dimensions = ((int)$data[0]) + 1;
        $this->bombsCount = (int)$data[1];
        $this->makeEmptyBoard();

        // Second line (Queen)
        $line = fgets($file);
        $data = explode(' ', $line);
        $this->putPiece(new Queen(), (int)$data[0], (int)$data[1]);

        // Bombs coordinates
        if ($this->bombsCount) {
            while (($line = fgets($file)) !== false) {
                $data = explode(' ', $line);
                $this->putPiece(new Bomb(), (int)$data[0], (int)$data[1]);
            }
        }

        fclose($file);
    }

    private function makeEmptyBoard()
    {
        for ($i = 0; $i <= $this->dimensions; $i++) {
            $this->board[$i] = [];

            for ($j = 0; $j <= $this->dimensions; $j++) {
                if (($i > 0 && $i < $this->dimensions) && ($j > 0 && $j < $this->dimensions)) {
                    $this->board[$i][] = new Field();
                } else {
                    $this->board[$i][] = new Limit();
                }
            }
        }
    }

    /**
     * @param Piece $piece
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function putPiece(Piece $piece, int $x, int $y)
    {
        if ($x < 0 || $x > $this->dimensions
            || $y < 0 || $y > $this->dimensions) {
            return false;
        } elseif (!($this->board[$x][$y] instanceof Path || $this->board[$x][$y] instanceof Field)) {
            return false;
        }

        if ($this->board[$x][$y] instanceof Path) {
            $this->clearPath($x, $y);
        }

        $this->board[$x][$y] = $piece;
        $piece->setCoordinates($x, $y);

        if ($piece instanceof Queen) {
            $piece->move($this);
            $this->memory['queen'] = $piece;
        } elseif ($piece instanceof Bomb) {
            $piece->clearPaths($this, $this->memory['queen']);
        } elseif ($piece instanceof Path) {
            $this->memory['paths'][] = $piece;
        }

        return true;
    }

    /**
     *
     */
    public function print()
    {
        $print = '';
        foreach ($this->board as $row) {
            $print .= '|';
            foreach ($row as $piece) {
                $print .= $piece->symbol . '|';
            }
            $print .= "\n";
        }

        echo $print;
    }

    public function getCell(int $x, int $y)
    {
        if ($x < 0 || $x > $this->dimensions || $y < 0 || $y > $this->dimensions) {
            return new Limit();
        }

        return $this->board[$x][$y];
    }

    public function clearPath(int $x, int $y)
    {
        foreach ($this->memory['paths'] as $key => $path) {
            if ($path->x == $x && $path->y == $y) {
                unset($this->memory['paths'][$key]);
                break;
            }
        }
    }

    public function countPaths()
    {
        return count($this->memory['paths']);
    }
}