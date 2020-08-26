<?php

namespace Classes\Pieces;

class Bomb extends Piece
{
    public function getSymbol()
    {
        return 'x';
    }

    public function getName()
    {
        return 'bomb';
    }
}