<?php

namespace Minesweeper\src;

use Minesweeper\src\Util\Cartesian;
use JMS\Serializer\Annotation as Serializer;

class Board {
    /**
     * @Serializer\Exclude()
     * @var int
     */
    public $height;

    /**
     * @Serializer\Exclude()
     * @var int
     */
    public $width;

    /**
     * @Serializer\Exclude()
     * @var int
     */
    public $countMines;

    /**
     * @Serializer\Type("array<array<Minesweeper\src\Tile>>")
     */
    public $tileGrid;

    public function __construct(int $height, int $width, int $countMines)
    {
        $this->height = $height;
        $this->width = $width;
        $this->countMines = $countMines;

        $this->buildBoard($height, $width, $countMines);
    }

    public function buildBoard($width, $height, $countMines) {
        $this->tileGrid = $this->generateTilePlacement($width, $height, $countMines);
    }

    public function generateTilePlacement($width, $height, $countMines)
    {
        $mineLocations = $this->generateMinePlacement($width, $height, $countMines);
        $mineAndClueLocations = $this->generateClueTiles($width, $height, $mineLocations);
        $grid = $this->generateBlankTiles($width, $height, $mineAndClueLocations);

        return $grid;
    }

    public function generateMinePlacement ($width, $height, $countMines) {
        $placedMines = 0;
        $mineLocations = [];

        while ($placedMines < $countMines) {
            $x = rand(0, $width - 1);
            $y = rand(0, $height - 1);
            if (!isset($mineLocations[$x])) {
                $mineLocations[$x] = [];
            }

            if (!isset($mineLocations[$x][$y]) || !$mineLocations[$x][$y] instanceof Tile) {
                $mineLocations[$x][$y] = new Mine();
                $placedMines++;
            }
        }

        return $mineLocations;
    }

    public function generateClueTiles($width, $height, $mineLocations)
    {
        $allLocations = $mineLocations;
        foreach ($mineLocations as $key => $x) {
            $coordinates['x'] = $this->possibleAxisLocations($key, $width, 0);
            foreach ($x as $yKey => $y) {
                $coordinates['y'] = $this->possibleAxisLocations($yKey, $height, 0);
            }
            //generate surrounding tile locations(x-1, x, x+1) X (y-1, y, y+1)
//            var_dump($coordinates);die;
            $cartCoordinates = Cartesian::build($coordinates);
            foreach ($cartCoordinates as $xyPair) {
                if (sizeof($xyPair) !== 2) {
                    continue;
                }
                //0 = x coord, 1 = y coord, current cartesian drops key
                if (!isset($allLocations[$xyPair[0]])) {
                    $allLocations[$xyPair[0]] = [];
                }
                if (isset($allLocations[$xyPair[0]][$xyPair[1]]) && $allLocations[$xyPair[0]][$xyPair[1]] instanceof ClueTile) {
                    /** @var ClueTile $clueTile */
                    $clueTile = $allLocations[$xyPair[0]][$xyPair[1]];
                    $clueTile->addMineTouching();
                } else if (isset($allLocations[$xyPair[0]][$xyPair[1]]) && $allLocations[$xyPair[0]][$xyPair[1]] instanceof Mine) {
                    continue;
                } else {
                    $allLocations[$xyPair[0]][$xyPair[1]] = new ClueTile();
                }
            }
        }

        return $allLocations;
    }

    public function generateBlankTiles($width, $height, $mineAndClueLocations)
    {
        $grid = $mineAndClueLocations;

        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                if(isset($grid[$i][$j]) && $grid[$i][$j] instanceof Tile) {
                    continue;
                }
                $grid[$i][$j] = new BlankTile();
            }
        }

        return $grid;
    }

    public function possibleAxisLocations ($location, $max, $min = 0) {
        $surroundingLocations = [$location];

        if (($location - 1) >= $min) {
            $surroundingLocations[] = ($location - 1);
        }
        if (($location + 1) < $max) {
            $surroundingLocations[] = $location + 1;
        }

        return $surroundingLocations;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getCountMines()
    {
        return $this->countMines;
    }

    /**
     * @param mixed $countMines
     */
    public function setCountMines($countMines)
    {
        $this->countMines = $countMines;
    }

    /**
     * @return mixed
     */
    public function getTileGrid()
    {
        return $this->tileGrid;
    }

    /**
     * @param mixed $tileGrid
     */
    public function setTileGrid($tileGrid)
    {
        $this->tileGrid = $tileGrid;
    }


}
