<?php

namespace Minesweeper\src;

class ClueTile extends Tile {

    public $countMinesTouching;

    public function __construct()
    {
        $this->countMinesTouching = 1;

        parent::__construct();
    }

    public function getCountMinesTouching() {
        return $this->countMinesTouching;
    }

    public function setCountMinesTouching(int $countMinesTouching) {
        $this->countMinesTouching = $countMinesTouching;
    }

    public function addMineTouching() {
        $this->setCountMinesTouching($this->getCountMinesTouching() + 1);
    }

    public function getDisplayValue()
    {
        return $this->getCountMinesTouching();
    }
}
