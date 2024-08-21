<?php

namespace EnigmaLibrary\Array;

interface ArrayUtilsInterface{
    /**
     * Flattens a multidimensional array into a single level
     * 
     * @param array $array The array to flatten.
     * @return array The flattened array.
     */
    public function flatten(array $array):array;

    /**
     * Extracts a column of values from an array of arrays
     * 
     * @param array $array The array to extract from
     * @param string $key The key of the column to extract
     * @return array An array of values from the specified column
     */
    public function pluck(array $array, string $key):array;

    /**
     * Recursively merges two arrays without overwriting values
     * 
     * @param array $array1 The first array.
     * @param array $array2 The second array.
     * @return array The merged array.
     */
    public function mergeRecursiveDistinct(array $array1, array $array2):array;
}