<?php

namespace Minesweeper\src;

use JMS\Serializer\Annotation as Serializer;

class Minesweeper {

    /**
     * @Serializer\Type("string")
     */
    public $id;

    /**
     * @Serializer\Type("Minesweeper\src\Board")
     */
    public $board;

    public function __construct($height, $width, $mineCount)
    {
        $this->id = uniqid();
        $this->board = new Board($height, $width, $mineCount);
    }

    public function startGame()
    {
    }
}