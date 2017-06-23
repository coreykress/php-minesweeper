<?php

namespace Minesweeper\src;

use Minesweeper\Util\Cartesian;

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

    public function possibleAxisLocations ($location, $max, $min = 0) {
        $surroundingLocations = [$location];

        if ($location - 1 >= $min) {
            $surroundingLocations[] = ($location - 1);
        }
        if ($location + 1 < $max) {
            $surroundingLocations[] = $location + 1;
        }

        return $surroundingLocations;
    }

    public function generateCluePlacement ($mineLocations) {
        $allLocations = [];
        foreach ($mineLocations as $x) {
            $coordinates['x'] = $this->possibleAxisLocations($x, $this->width, 0);
            $coordinates['y'] = $this->possibleAxisLocations($y, $this->height, 0);
                //generate surrounding tile locations(x-1, x, x+1) X (y-1, y, y+1)
                $allLocations = array_merge($allLocations, Cartesian::build($coordinates));
            }
        }

        return $mineLocations;
    }
}
