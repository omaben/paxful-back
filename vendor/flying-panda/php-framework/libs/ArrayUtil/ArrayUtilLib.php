<?php

namespace Libs\ArrayUtil;

class ArrayUtilLib
{
    /**
     * @param $name
     * @param $array
     * @return array
     */
    static function keyToMap($name, $array)
    {
        $map = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $map[$item[$name]] = $item;
            } else {
                $map[$item->$name] = $item;
            }
        }
        return $map;
    }
}
