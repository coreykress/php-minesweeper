<?php

namespace Minesweeper\src;

use JMS\Serializer\Annotation as Serializer;


abstract class Tile{
    /**
     * @Serializer\Type("boolean")
     */
    public $activated;

    /**
     * @Serializer\Type("string")
     */
    public $displayValue;

    /**
     * @Serializer\Type("boolean")
     */
    public $hasFlag;

    public function __construct()
    {
        $this->displayValue = '';
        $this->activated = false;
    }

    /**
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     * @return Tile
     */
    public function setActivated(bool $activated): Tile
    {
        $this->activated = $activated;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayValue()
    {
        return $this->displayValue;
    }

    /**
     * @param string $displayValue
     * @return Tile
     */
    public function setDisplayValue($displayValue)
    {
        $this->displayValue = $displayValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHasFlag()
    {
        return $this->hasFlag;
    }

    /**
     * @param mixed $hasFlag
     * @return Tile
     */
    public function setHasFlag($hasFlag)
    {
        $this->hasFlag = $hasFlag;
        return $this;
    }
}
