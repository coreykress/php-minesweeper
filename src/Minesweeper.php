<?php

namespace Minesweeper\src;

use JMS\Serializer\Annotation as Serializer;

class Minesweeper {

    /**
     * @Serializer\Type("string")
     */
    public $id;

    /**
     * @Serializer\Type("array<Minesweeper\src\management\Player>")
     */
    public $players;

    /**
     * @Serializer\Type("Minesweeper\src\management\Player")
     */
    public $currentTurn;

    /**
     * @Serializer\Type("Minesweeper\src\Board")
     */
    public $board;

    public function __construct($height, $width, $mineCount, $id, $players)
    {
        $this->id = uniqid();
        $this->board = new Board($height, $width, $mineCount);
        $this->players = $players;
    }

    public function startGame()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return mixed
     */
    public function getCurrentTurn()
    {
        return $this->currentTurn;
    }

    /**
     * @return mixed
     */
    public function getBoard()
    {
        return $this->board;
    }

    public function setCurrentTurn()
    {

    }
}