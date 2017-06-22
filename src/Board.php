<?php

namespace Minesweeper\src;

class Board {
    public $height;

    public $width;

    public $countMines;

    public $score;

    public $tileGrid;

    public function __construct(int $height, int $width, int $countMines)
    {
        $this->height = $height;
        $this->width = $width;
        $this->countMines = $countMines;

        $this->buildBoard($height, $width, $countMines);
    }

    public function buildBoard($width, $height, $countMines) {
        $mineLocations = $this->generateTilePlacement($width, $height, $countMines);
        $clueLocations = $this->generateCluePlacement($mineLocations);

        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                if($this->tileGrid[$i][$j] instanceof Tile) {
                    continue;
                }
                $this->tileGrid[$i][$j] = new Tile();
            }
        }
    }

    public function generateTilePlacement ($width, $height, $countMines) {
        $placedMines = 0;
        $mineLocations = [];

        while ($placedMines < $countMines) {
            $x = rand(0, $width - 1);
            $y = rand(0, $height - 1);
            if (!isset($mineLocations[$x])) {
                $mineLocations[$x] = [];
            }

            if (!$mineLocations[$x][$y] instanceof Tile) {
                $mineLocations[$x][$y] = new Mine();
                $placedMines++;
            }
        }

        return $mineLocations;
    }

    public function generateCluePlacement ($mineLocations) {
        foreach ($mineLocations as $x) {
            foreach ($x as $y) {

                //generate surrounding tile locations(x-1, x, x+1) X (y-1, y, y+1)
                //if in bounds of board, count + 1 or create
            }
        }

        return $mineLocations;
    }
}
