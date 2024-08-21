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

    /**
     * Filters an array to keep only specified keys.
     *
     * @param array $array The array to filter.
     * @param array $keys The keys to keep.
     * @return array The filtered array.
     */
    public static function arrayFilterKeys(array $array, array $keys): array
    {
        return array_filter($array, function ($key) use ($keys) {
            return in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Removes null values from an array.
     *
     * @param array $array The array to filter.
     * @return array The array without null values.
     */
    public static function arrayRemoveNullValues(array $array): array
    {
        return array_filter($array, fn($value) => !is_null($value));
    }

    /**
     * Returns an array with unique values, preserving keys.
     *
     * @param array $array The array to filter.
     * @return array The array with unique values.
     */
    public static function arrayUnique(array $array): array
    {
        return array_map("unserialize", array_unique(array_map("serialize", $array)));
    }

    /**
     * Chunks an array into smaller arrays of a specified size.
     *
     * @param array $array The array to chunk.
     * @param int $size The size of each chunk.
     * @return array A multidimensional array with the chunks.
     */
    public static function arrayChunk(array $array, int $size): array
    {
        return array_chunk($array, $size);
    }

    /**
     * Combines the keys from one array with the values from another.
     *
     * @param array $keys The array of keys.
     * @param array $values The array of values.
     * @return array The combined array.
     */
    public static function arrayCombine(array $keys, array $values): array
    {
        return array_combine($keys, $values);
    }

    /**
     * Checks if a key exists in a multidimensional array.
     *
     * @param string $key The key to search for.
     * @param array $array The array to search.
     * @return bool True if the key exists, false otherwise.
     */
    public static function arrayKeyExistsRecursive(string $key, array $array): bool
    {
        if (array_key_exists($key, $array)) {
            return true;
        }

        foreach ($array as $value) {
            if (is_array($value) && self::arrayKeyExistsRecursive($key, $value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Computes the difference between two arrays recursively.
     *
     * @param array $array1 The first array.
     * @param array $array2 The second array.
     * @return array The array containing all the elements from $array1 that are not present in $array2.
     */
    public static function arrayDiffRecursive(array $array1, array $array2): array
    {
        $result = [];
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!isset($array2[$key]) || !is_array($array2[$key])) {
                    $result[$key] = $value;
                } else {
                    $diff = self::arrayDiffRecursive($value, $array2[$key]);
                    if (!empty($diff)) {
                        $result[$key] = $diff;
                    }
                }
            } elseif (!in_array($value, $array2)) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * Filters an array recursively.
     *
     * @param array $array The array to filter.
     * @param callable $callback The callback function to use.
     * @return array The filtered array.
     */
    public static function arrayFilterRecursive(array $array, callable $callback): array
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = self::arrayFilterRecursive($value, $callback);
            }
            if (!$callback($value)) {
                unset($array[$key]);
            }
        }
        return $array;
    }

    /**
     * Applies a callback to all elements of an array recursively.
     *
     * @param callable $callback The callback function to apply.
     * @param array $array The array to process.
     * @return array The array with the callback applied.
     */
    public static function arrayMapRecursive(callable $callback, array $array): array
    {
        array_walk_recursive($array, function (&$item) use ($callback) {
            $item = $callback($item);
        });
        return $array;
    }

    /**
     * Pads an array to a specified length with a value.
     *
     * @param array $array The array to pad.
     * @param int $size The size to pad to.
     * @param mixed $value The value to pad with.
     * @return array The padded array.
     */
    public static function arrayPad(array $array, int $size, $value): array
    {
        return array_pad($array, $size, $value);
    }

    /**
     * Partitions an array into two arrays based on a predicate.
     *
     * @param array $array The array to partition.
     * @param callable $callback The predicate to determine the partition.
     * @return array An array with two sub-arrays: the first with elements that match the predicate, the second with the rest.
     */
    public static function arrayPartition(array $array, callable $callback): array
    {
        $pass = [];
        $fail = [];
        foreach ($array as $key => $value) {
            if ($callback($value)) {
                $pass[$key] = $value;
            } else {
                $fail[$key] = $value;
            }
        }
        return [$pass, $fail];
    }

    /**
     * Replaces elements in an array recursively.
     *
     * @param array ...$arrays The arrays to replace values in.
     * @return array The array with replaced values.
     */
    public static function arrayReplaceRecursive(array ...$arrays): array
    {
        return array_replace_recursive(...$arrays);
    }

    /**
     * Randomly shuffles the elements of an array.
     *
     * @param array $array The array to shuffle.
     * @return array The shuffled array.
     */
    public static function arrayShuffle(array $array): array
    {
        shuffle($array);
        return $array;
    }

    /**
     * Sums the elements of an array, supporting multidimensional arrays.
     *
     * @param array $array The array to sum.
     * @return float The sum of the elements in the array.
     */
    public static function arraySum(array $array): float
    {
        return array_sum(array_map('array_sum', $array));
    }

    /**
     * Recursively applies a callback to each element of an array, including keys.
     *
     * @param array &$array The array to walk through.
     * @param callable $callback The callback function to apply.
     * @return void
     */
    public static function arrayWalkRecursiveWithKey(array &$array, callable $callback): void
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                self::arrayWalkRecursiveWithKey($value, $callback);
            } else {
                $callback($value, $key);
            }
        }
    }
}