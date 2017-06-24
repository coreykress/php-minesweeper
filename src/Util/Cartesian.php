<?php

namespace Minesweeper\src\Util;

class Cartesian
{
    public static function build($set)
    {
        if (!$set) {
            return array(array());
        }

        $subset = array_shift($set);
        $cartesianSubset = self::build($set);
        $result = array();

        foreach ($subset as $key => $value) {
            foreach ($cartesianSubset as $p) {
                array_unshift($p, $value);
                $result[] = $p;
            }
        }

        return $result;
    }
}
