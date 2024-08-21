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

    /**
     * Converts a string to kebab-case.
     * 
     * @param string $string The string to convert.
     * @return string The kebab-case string.
     */
    public static function toKebabCase(string $string): string
    {
        return strtolower(preg_replace('/[^a-z0-9]+/', '-', trim($string)));
    }

    /**
     * Pads a string to a certain length with another string.
     * 
     * @param string $string The string to pad.
     * @param int $length The desired length after padding.
     * @param string $padString The string to pad with (default is ' ').
     * @param int $padType The padding type (STR_PAD_RIGHT, STR_PAD_LEFT, or STR_PAD_BOTH).
     * @return string The padded string.
     */
    public static function padString(string $string, int $length, string $padString = ' ', int $padType = STR_PAD_RIGHT): string
    {
        return str_pad($string, $length, $padString, $padType);
    }

    /**
     * Capitalizes the first letter of each word in a string.
     * 
     * @param string $string The string to capitalize.
     * @return string The capitalized string.
     */
    public static function capitalizeWords(string $string): string
    {
        return ucwords($string);
    }

    /**
     * Checks if a string is a palindrome.
     * 
     * @param string $string The string to check.
     * @return bool True if the string is a palindrome, false otherwise.
     */
    public static function isPalindrome(string $string): bool
    {
        $cleanedString = preg_replace('/[^a-z0-9]/i', '', strtolower($string));
        return $cleanedString === strrev($cleanedString);
    }

    /**
     * Extracts the initials from a string.
     * 
     * @param string $string The string to extract initials from.
     * @return string The extracted initials.
     */
    public static function extractInitials(string $string): string
    {
        $words = explode(' ', $string);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper($word[0]);
        }
        return $initials;
    }

    /**
     * Removes extra spaces from a string, leaving only single spaces between words.
     * 
     * @param string $string The string to clean.
     * @return string The cleaned string.
     */
    public static function removeExtraSpaces(string $string): string
    {
        return preg_replace('/\s+/', ' ', trim($string));
    }

    /**
     * Counts the number of words in a string.
     * 
     * @param string $string The string to count words in.
     * @return int The word count.
     */
    public static function countWords(string $string): int
    {
        return str_word_count($string);
    }

    /**
     * Masks a portion of a string, useful for hiding sensitive information.
     * 
     * @param string $string The string to mask.
     * @param int $start The starting position of the mask.
     * @param int $length The number of characters to mask.
     * @param string $mask The character to use for masking (default is '*').
     * @return string The masked string.
     */
    public static function maskString(string $string, int $start, int $length, string $mask = '*'): string
    {
        return substr($string, 0, $start) . str_repeat($mask, $length) . substr($string, $start + $length);
    }
}