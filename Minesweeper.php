<?php

namespace Minesweeper;

use Minesweeper\src\Board;
use JMS\Serializer\Annotation as Serializer;

class Minesweeper {

    /**
     * @Serializer\Type("Minesweeper\src\Board")
     */
    public $board;

    /**
     * @Serializer\Type("string")
     */
    public $id;

    public function __construct($height, $width, $mineCount)
    {
        $this->id = uniqid();
        $this->board = new Board($height, $width, $mineCount);
    }

    public function startGame()
    {
    }
}