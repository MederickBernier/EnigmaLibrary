<?php

namespace EnigmaLibrary\Validation;

class ValidationUtils
{
    /**
     * Validates an email address.
     *
     * @param string $email The email address to validate.
     * @return bool True if the email is valid, false otherwise.
     */
    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validates a phone number (international format).
     *
     * @param string $phone The phone number to validate.
     * @return bool True if the phone number is valid, false otherwise.
     */
    public static function validatePhoneNumber(string $phone): bool
    {
        return preg_match('/^\+?[1-9]\d{1,14}$/', $phone);
    }

    /**
     * Validates a URL.
     *
     * @param string $url The URL to validate.
     * @return bool True if the URL is valid, false otherwise.
     */
    public static function validateURL(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validates an IP address (both IPv4 and IPv6).
     *
     * @param string $ip The IP address to validate.
     * @return bool True if the IP address is valid, false otherwise.
     */
    public static function validateIP(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * Validates if a string contains only alphabetic characters.
     *
     * @param string $string The string to validate.
     * @return bool True if the string contains only alphabetic characters, false otherwise.
     */
    public static function validateAlpha(string $string): bool
    {
        return ctype_alpha($string);
    }

    /**
     * Validates if a string contains only alphanumeric characters.
     *
     * @param string $string The string to validate.
     * @return bool True if the string contains only alphanumeric characters, false otherwise.
     */
    public static function validateAlphanumeric(string $string): bool
    {
        return ctype_alnum($string);
    }

    /**
     * Validates a date string against a specified format.
     *
     * @param string $date The date string to validate.
     * @param string $format The format to validate against (default is 'Y-m-d').
     * @return bool True if the date is valid, false otherwise.
     */
    public static function validateDate(string $date, string $format = 'Y-m-d'): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $date);
        return $dateTime && $dateTime->format($format) === $date;
    }

    /**
     * Validates if a string is a valid JSON.
     *
     * @param string $json The JSON string to validate.
     * @return bool True if the string is valid JSON, false otherwise.
     */
    public static function validateJSON(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
