<?php

namespace Classes\Pieces;

class Field extends Piece
{
    public function getSymbol()
    {
        return ' ';
    }

    public function getName()
    {
        return 'field';
    }
}