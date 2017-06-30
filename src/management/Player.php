<?php

namespace Minesweeper\src\management;

use JMS\Serializer\Annotation as Serializer;

class Player
{
    /**
     * @Serializer\Type("string")
     */
    public $id;

    /**
     * @Serializer\Type("string")
     */
    public $email;

    /**
     * @Serializer\Type("array<string>")
     */
    public $gameIds;

    public function __construct($email)
    {
        $this->id = uniqid();
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getGameIds()
    {
        return $this->gameIds;
    }

    /**
     * @param string $id
     */
    public function addGameId($id)
    {
        $this->gameIds[] = $id;
    }

    /**
     * @param string $id
     */
    public function removeGameId($id)
    {
        unset($this->gameIds[array_search($id, $this->getGameIds())]);
    }

}