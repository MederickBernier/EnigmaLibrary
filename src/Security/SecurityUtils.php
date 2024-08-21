<?php

namespace EnigmaLibrary\Security;

class SecurityUtils
{

    /**
     * Hashes a password using bcrypt.
     * 
     * @param string $password The password to hash.
     * @return string The hashed password.
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verifies a password against a hashed value.
     * 
     * @param string $password The plain password to verify.
     * @param string $hash The hashed password to verify against.
     * @return bool True if the password matches the hash, false otherwise.
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Generates a CSRF token.
     * 
     * @return string The generated CSRF token.
     */
    public static function generateCsrfToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Verified a CSRF token against a stored session token.
     * 
     * @param string $token The CSRF token to verify.
     * @param string $sessionToken The session token to compare against.
     * @return bool True if the tokens match, false otherwise.
     */
    public static function verifyCsrfToken(string $token, string $sessionToken): bool
    {
        return hash_equals($sessionToken, $token);
    }

    /**
     * Sanitizes a string to prevent XSS attacks.
     * 
     * @param string $input The input string to sanitize.
     * @return string The sanitized string.
     */
    public static function sanitizeString(string $input): string
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Encrypts a string using a specified encryption algorithm.
     * 
     * @param string $data The data to encrypt.
     * @param string $key The encryption key.
     * @return string The encrypted data.
     */
    public static function encryptData(string $data, string $key): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    /**
     * Decrypts a string using specified encryption algorithm.
     * 
     * @param string $data The encrypted data to decrypt.
     * @param string $key The encryption key.
     * @return string The decrypted data.
     */
    public static function decryptData(string $data, string $key): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length(('aes-256-cbc'));
        $iv = substr($data, 0, $ivLength);
        $encryptedData = substr($data, $ivLength);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
    }

    public static function generateRandomToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    public static function hashData(string $data, string $algorithm = 'sha256'): string
    {
        return hash($algorithm, $data);
    }

    public static function verifyHash(string $data, string $hash, string $algorithm = 'sha256'): bool
    {
        return hash_equals($hash, self::hashData($data, $algorithm));
    }
}