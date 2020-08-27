<?php

spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', $class . '.php'));
});

use Classes\Chessboard;

$chessboard = new Chessboard();
// Place the input file path here
$chessboard->makeBoard('inputs/input_01.txt');

echo $chessboard->countPaths()."\n";
