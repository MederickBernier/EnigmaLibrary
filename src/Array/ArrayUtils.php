<?php

namespace EnigmaLibrary\Array;

class ArrayUtils
{
    /**
     * Flattens a multidimensional array into a single level.
     *
     * @param array $array The array to flatten.
     * @return array The flattened array.
     */
    public static function flatten(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function ($a) use (&$result) {
            $result[] = $a;
        });
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
        return array_map(function ($v) use ($key) {
            return $v[$key] ?? null;
        }, $array);
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

    /**
     * Checks if an array is associative (contains non-numeric keys).
     *
     * @param array $array The array to check.
     * @return bool True if the array is associative, false otherwise.
     */
    public static function arrayIsAssociative(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Returns an array without the specified keys.
     *
     * @param array $array The array to modify.
     * @param array $keys The keys to exclude from the array.
     * @return array The modified array.
     */
    public static function arrayExcept(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }

    /**
     * Returns an array containing only the specified keys.
     *
     * @param array $array The array to modify.
     * @param array $keys The keys to include in the array.
     * @return array The modified array.
     */
    public static function arrayOnly(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Groups an array by a specified key or callable.
     *
     * @param array $array The array to group.
     * @param string|callable $key The key or callable to group by.
     * @return array The grouped array.
     */
    public static function arrayGroupBy(array $array, $key): array
    {
        $result = [];
        foreach ($array as $item) {
            $groupKey = is_callable($key) ? $key($item) : $item[$key];
            $result[$groupKey][] = $item;
        }
        return $result;
    }
}