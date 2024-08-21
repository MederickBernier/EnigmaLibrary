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
     * Filters an array by specified keys.
     *
     * @param array $array The array to filter.
     * @param array $keys The keys to keep in the array.
     * @return array The filtered array.
     */
    public static function arrayFilterKeys(array $array, array $keys): array
    {
        return array_filter($array, function ($key) use ($keys) {
            return in_array($key, $keys);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Removes all null values from an array.
     *
     * @param array $array The array to filter.
     * @return array The array without null values.
     */
    public static function arrayRemoveNullValues(array $array): array
    {
        return array_filter($array, fn($value) => !is_null($value));
    }

    /**
     * Removes duplicate values from a multidimensional array.
     *
     * @param array $array The array to filter.
     * @return array The array without duplicate values.
     */
    public static function arrayUnique(array $array): array
    {
        return array_map("unserialize", array_unique(array_map("serialize", $array)));
    }

    /**
     * Checks if a key exists in a multidimensional array recursively.
     *
     * @param string|int $key The key to check for.
     * @param array $array The array to search.
     * @return bool True if the key exists, false otherwise.
     */
    public static function arrayKeyExistsRecursive($key, array $array): bool
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
     * Flattens a multidimensional array into a single level with keys preserved.
     *
     * @param array $array The array to flatten.
     * @param string $separator The separator for the keys (default is '.').
     * @return array The flattened array with keys preserved.
     */
    public static function arrayFlattenWithKeys(array $array, string $separator = '.'): array
    {
        $result = [];

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));
        foreach ($iterator as $key => $value) {
            $keys = [];
            foreach (range(0, $iterator->getDepth()) as $depth) {
                $keys[] = $iterator->getSubIterator($depth)->key();
            }
            $result[join($separator, $keys)] = $value;
        }

        return $result;
    }

    /**
     * Partitions an array into two arrays based on a callback function.
     *
     * @param array $array The array to partition.
     * @param callable $callback The callback function to use for partitioning.
     * @return array An array containing two arrays: the first with elements that pass the callback, the second with elements that fail.
     */
    public static function arrayPartition(array $array, callable $callback): array
    {
        $pass = [];
        $fail = [];

        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                $pass[$key] = $value;
            } else {
                $fail[$key] = $value;
            }
        }

        return [$pass, $fail];
    }

    /**
     * Shuffles an associative array while preserving keys.
     *
     * @param array $array The associative array to shuffle.
     * @return array The shuffled array.
     */
    public static function arrayShuffleAssoc(array $array): array
    {
        $keys = array_keys($array);
        shuffle($keys);
        $shuffledArray = [];
        foreach ($keys as $key) {
            $shuffledArray[$key] = $array[$key];
        }
        return $shuffledArray;
    }

    /**
     * Transposes a 2D array (exchanges rows and columns).
     *
     * @param array $array The array to transpose.
     * @return array The transposed array.
     */
    public static function arrayTranspose(array $array): array
    {
        $transposed = [];
        foreach ($array as $rowKey => $row) {
            foreach ($row as $colKey => $value) {
                $transposed[$colKey][$rowKey] = $value;
            }
        }
        return $transposed;
    }

    /**
     * Inserts a value into an array after a specified key.
     *
     * @param array $array The array to modify.
     * @param string|int $key The key after which to insert the new element.
     * @param string|int $newKey The key for the new element.
     * @param mixed $newValue The value for the new element.
     * @return array The modified array.
     */
    public static function arrayInsertAfter(array $array, $key, $newKey, $newValue): array
    {
        $keys = array_keys($array);
        $index = array_search($key, $keys);

        if ($index !== false) {
            $index++;
            $array = array_slice($array, 0, $index, true) +
                [$newKey => $newValue] +
                array_slice($array, $index, null, true);
        }

        return $array;
    }

    /**
     * Computes the Cartesian product of multiple arrays.
     *
     * @param array ...$arrays The arrays to compute the Cartesian product of.
     * @return array The Cartesian product as an array.
     */
    public static function arrayCartesianProduct(array ...$arrays): array
    {
        $result = [[]];

        foreach ($arrays as $property => $values) {
            $append = [];
            foreach ($result as $product) {
                foreach ($values as $item) {
                    $product[$property] = $item;
                    $append[] = $product;
                }
            }
            $result = $append;
        }

        return $result;
    }

    /**
     * Converts an array to a CSV string.
     *
     * @param array $array The array to convert.
     * @param string $delimiter The delimiter to use in the CSV (default is ',').
     * @param string $enclosure The enclosure to use in the CSV (default is '"').
     * @return string The CSV string.
     */
    public static function arrayToCsv(array $array, string $delimiter = ',', string $enclosure = '"'): string
    {
        $f = fopen('php://memory', 'r+');
        foreach ($array as $row) {
            fputcsv($f, $row, $delimiter, $enclosure);
        }
        rewind($f);
        $csv = stream_get_contents($f);
        fclose($f);
        return $csv;
    }

    /**
     * Removes duplicate values from a multidimensional array based on a specific key.
     *
     * @param array $array The array to filter.
     * @param string $key The key to check for duplicates.
     * @return array The array without duplicate values.
     */
    public static function arrayRemoveDuplicates(array $array, string $key): array
    {
        $temp = [];
        foreach ($array as $item) {
            if (!in_array($item[$key], $temp)) {
                $temp[] = $item[$key];
            }
        }

        return array_values(array_filter($array, function ($item) use ($temp) {
            return in_array($item, $temp);
        }));
    }

    /**
     * Computes the intersection of two associative arrays recursively.
     *
     * @param array $array1 The first array.
     * @param array $array2 The second array.
     * @return array The array containing all elements of $array1 that are present in $array2.
     */
    public static function arrayIntersectAssocRecursive(array $array1, array $array2): array
    {
        $result = [];
        foreach ($array1 as $key => $value) {
            if (array_key_exists($key, $array2)) {
                if (is_array($value) && is_array($array2[$key])) {
                    $result[$key] = self::arrayIntersectAssocRecursive($value, $array2[$key]);
                } elseif ($value === $array2[$key]) {
                    $result[$key] = $value;
                }
            }
        }
        return $result;
    }
}