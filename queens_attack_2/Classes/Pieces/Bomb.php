<?php

namespace Classes\Pieces;

use Classes\Chessboard;

class Bomb extends Piece
{
    public $symbol = 'x';

    public function clearPaths(Chessboard &$chessboard, Queen $queen)
    {
        $diffs = [
            'x' => $this->x - $queen->x,
            'y' => $this->y - $queen->y,
        ];

        if ($diffs['x'] < 0 && $diffs['y'] == 0) {
            // Top
            for ($i = $this->x - 1; $i > 0; $i--) {
                $chessboard->putPiece(new Field(), $i, $this->y);
            }
        } elseif ($diffs['x'] == 0 && $diffs['y'] > 0) {
            // Right
            for ($j = $this->y + 1; $j < $chessboard->dimensions; $j++) {
                $chessboard->putPiece(new Field(), $this->x, $j);
            }
        } elseif ($diffs['x'] > 0 && $diffs['y'] == 0) {
            // Bottom
            for ($i = $this->x + 1; $i < $chessboard->dimensions; $i++) {
                $chessboard->putPiece(new Field(), $i, $this->y);
            }
        } elseif ($diffs['x'] == 0 && $diffs['y'] < 0) {
            // Left
            for ($j = $this->y; $j > 0; $j--) {
                $chessboard->putPiece(new Field(), $this->x, $j);
            }
        } elseif ($diffs['x'] < 0 && $diffs['y'] > 0) {
            // Top-Right
            for ($i = 1; $i < $chessboard->dimensions; $i++) {
                $chessboard->putPiece(new Field(), $this->x - $i, $this->y + $i);
            }
        } elseif ($diffs['x'] > 0 && $diffs['y'] > 0) {
            // Bottom-Right
            for ($i = 1; $i < $chessboard->dimensions; $i++) {
                $chessboard->putPiece(new Field(), $this->x + $i, $this->y + $i);
            }
        } elseif ($diffs['x'] < 0 && $diffs['y'] < 0) {
            // Top-Left
            for ($i = 1; $i < $chessboard->dimensions; $i++) {
                $chessboard->putPiece(new Field(), $this->x - $i, $this->y - $i);
            }
        } elseif ($diffs['x'] > 0 && $diffs['y'] < 0) {
            // Bottom-Left
            for ($i = 1; $i < $chessboard->dimensions; $i++) {
                $chessboard->putPiece(new Field(), $this->x + $i, $this->y - $i);
            }
        }
    }
}