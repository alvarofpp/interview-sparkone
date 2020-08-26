<?php

spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', $class . '.php'));
});

use Classes\Chessboard;

$chessboard = new Chessboard(5);
$chessboard->print();
