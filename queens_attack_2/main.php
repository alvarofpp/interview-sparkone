<?php

spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', $class . '.php'));
});

use Classes\Chessboard;

$chessboard = new Chessboard();
$chessboard->makeBoard('inputs/input_02.txt');
$chessboard->print();
echo $chessboard->countPaths()."\n";
