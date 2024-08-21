<?php

namespace EnigmaLibrary\Array;

class ArrayUtils{
    /**
     * Flattens a multidimensional array into a single level.
     *
     * @param array $array The array to flatten.
     * @return array The flattened array.
     */
    public static function flatten(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function($a) use (&$result) { $result[] = $a; });
        return $result;
    }

    /**
     * Extracts a column of values from an array of arrays.
     *
     * @param array $array The array to extract from.
     * @param string $key The key of the column to extract.
     * @return array An array of values from the specified column.
     */
    public static function pluck(array $array, string $key): array
    {
        return array_map(function($v) use ($key) { return $v[$key] ?? null; }, $array);
    }

    /**
     * Recursively merges two arrays without overwriting values.
     *
     * @param array $array1 The first array.
     * @param array $array2 The second array.
     * @return array The merged array.
     */
    public static function mergeRecursiveDistinct(array $array1, array $array2): array
    {
        $merged = $array1;

        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = self::mergeRecursiveDistinct($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}