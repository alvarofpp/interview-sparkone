<?php

namespace Classes\Pieces;

use Classes\Chessboard;

class Queen extends Piece
{
    public $symbol = 'q';

    public function move(Chessboard &$chessboard)
    {
        $dimensions = $chessboard->dimensions - 1;

        for ($i = 1; $i < $dimensions; $i++) {
            // Top
            if ($chessboard->getCell($this->x + $i, $this->y) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x + $i, $this->y);
            }
            // Right
            if ($chessboard->getCell($this->x, $this->y + $i) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x, $this->y + $i);
            }
            // Bottom
            if ($chessboard->getCell($this->x - $i, $this->y) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x - $i, $this->y);
            }
            // Left
            if ($chessboard->getCell($this->x, $this->y - $i) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x, $this->y - $i);
            }
            // Top-Right
            if ($chessboard->getCell($this->x + $i, $this->y + $i) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x + $i, $this->y + $i);
            }
            // Bottom-Right
            if ($chessboard->getCell($this->x - $i, $this->y + $i) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x - $i, $this->y + $i);
            }
            // Top-Left
            if ($chessboard->getCell($this->x + $i, $this->y - $i) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x + $i, $this->y - $i);
            }
            // Bottom-Left
            if ($chessboard->getCell($this->x - $i, $this->y - $i) instanceof Field) {
                $chessboard->putPiece(new Path(), $this->x - $i, $this->y - $i);
            }
        }
    }
}