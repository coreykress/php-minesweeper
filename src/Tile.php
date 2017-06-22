<?php

namespace Minesweeper\src;

class Tile {
    public $activated;

    public $displayValue;

    public $hasFlag;

    public function __construct()
    {
        $this->displayValue = null;
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
