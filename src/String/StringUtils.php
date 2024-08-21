<?php

namespace EnigmaLibrary\String;

class StringUtils
{

    /**
     * Converts a string to a URL-friendly slug.
     * 
     * @param string $string The string to convert.
     * @return string The slugified string.
     */
    public static function toSlug(string $string): string
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        return trim($string, '-');
    }

    /**
     * Converts a string to camelCase.
     * 
     * @param string $string The string to convert.
     * @return string The camelCase string.
     */
    public static function toCamelCase(string $string): string
    {
        $string = str_replace(['-', '_'], ' ', strtolower($string));
        $string = ucwords($string);
        return lcfirst(str_replace(' ', '', $string));
    }

    /**
     * Truncates a string to a specified length, appending a suffix if necessary.
     * 
     * @param string $string The string to truncate.
     * @param int $length The maximum length of the string.
     * @param string $suffix The suffix to append if truncation occurs (default is '...').
     * @return string The truncated string.
     */
    public static function truncate(string $string, int $length, string $suffix = '...'): string
    {
        return strlen($string) > $length ? substr($string, 0, $length) . $suffix : $string;
    }

    /**
     * Generates a random string of a specified length.
     * 
     * @param int $length The length of the random string (default is 16).
     * @return string The generated random string.
     */
    public static function randomString(int $length = 16): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Reverses a string.
     * 
     * @param string $string The string to reverse.
     * @return string The reversed string.
     */
    public static function reverse(string $string): string
    {
        return strrev($string);
    }

    /**
     * Converts a string to snake_case.
     * 
     * @param string $string The string to convert.
     * @return string The snake_case string.
     */
    public static function toSnakeCase(string $string): string
    {
        $string = strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($string)));
        return preg_replace('/[^a-z0-9_]+/', '_', $string);
    }

    /**
     * Checks if a string starts with a specified substring.
     * 
     * @param string $string The string to check.
     * @param string $startString The substring to check for.
     * @return bool True if the string starts with the substring, false otherwise.
     */
    public static function startsWith(string $string, string $startString): bool
    {
        return strncmp($string, $startString, strlen($startString)) === 0;
    }

    /**
     * Checks if a string ends with a specified substring.
     * 
     * @param string $string The string to check.
     * @param string $endString The substring to check for.
     * @return bool True if the string ends with the substring, false otherwise.
     */
    public static function endsWith(string $string, string $endString): bool
    {
        return $endString === '' || substr($string, -strlen($endString)) === $endString;
    }

    /**
     * Checks if a string contains a specified substring.
     * 
     * @param string $string The string to check.
     * @param string $substring The substring to check for.
     * @return bool True if the string contains the substring, false otherwise.
     */
    public static function contains(string $string, string $substring): bool
    {
        return strpos($string, $substring) !== false;
    }

    /**
     * Converts the first letter of each word in a string to uppercase, using a specified delimiter.
     * 
     * @param string $string The string to convert.
     * @param string $delimiter The delimiter used to separate words (default is ' ').
     * @return string The string with each word capitalized.
     */
    public static function ucwordsCustom(string $string, string $delimiter = ' '): string
    {
        return implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
    }

    /**
     * Replaces the first occurrence of a substring in a string with another substring.
     * 
     * @param string $search The substring to search for.
     * @param string $replace The substring to replace the first occurrence with.
     * @param string $subject The string to search and replace in.
     * @return string The string with the first occurrence of the substring replaced.
     */
    public static function replaceFirst(string $search, string $replace, string $subject): string
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}