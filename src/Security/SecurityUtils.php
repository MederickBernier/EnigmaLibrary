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
     * Verifies a CSRF token against a stored session token.
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
     * Decrypts a string using a specified encryption algorithm.
     * 
     * @param string $data The encrypted data to decrypt.
     * @param string $key The encryption key.
     * @return string The decrypted data.
     */
    public static function decryptData(string $data, string $key): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivLength);
        $encryptedData = substr($data, $ivLength);
        return openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);
    }

    /**
     * Generates a random token of a specified length.
     * 
     * @param int $length The length of the token (default is 32).
     * @return string The generated random token.
     */
    public static function generateRandomToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Hashes data using a specified hashing algorithm.
     * 
     * @param string $data The data to hash.
     * @param string $algorithm The hashing algorithm to use (default is 'sha256').
     * @return string The hashed data.
     */
    public static function hashData(string $data, string $algorithm = 'sha256'): string
    {
        return hash($algorithm, $data);
    }

    /**
     * Verifies if data matches a given hash using a specified hashing algorithm.
     * 
     * @param string $data The data to verify.
     * @param string $hash The hash to compare against.
     * @param string $algorithm The hashing algorithm used (default is 'sha256').
     * @return bool True if the data matches the hash, false otherwise.
     */
    public static function verifyHash(string $data, string $hash, string $algorithm = 'sha256'): bool
    {
        return hash_equals($hash, self::hashData($data, $algorithm));
    }

    /**
     * Validates the strength of a password based on certain criteria.
     * 
     * @param string $password The password to validate.
     * @return bool True if the password meets the criteria, false otherwise.
     */
    public static function validatePasswordStrength(string $password): bool
    {
        $hasUppercase = preg_match('@[A-Z]@', $password);
        $hasLowercase = preg_match('@[a-z]@', $password);
        $hasNumber = preg_match('@[0-9]@', $password);
        $hasSpecialChar = preg_match('@[^\w]@', $password);
        return $hasUppercase && $hasLowercase && $hasNumber && $hasSpecialChar && strlen($password) >= 8;
    }

    /**
     * Generates cryptographically secure random bytes.
     * 
     * @param int $length The length of the random bytes to generate.
     * @return string The generated random bytes.
     */
    public static function secureRandomBytes(int $length): string
    {
        return random_bytes($length);
    }

    /**
     * Escapes a string for safe use in an SQL query.
     * 
     * @param string $string The string to escape.
     * @param \PDO $pdo The PDO instance for escaping the string.
     * @return string The escaped string.
     */
    public static function escapeSql(string $string, \PDO $pdo): string
    {
        return $pdo->quote($string);
    }

    /**
     * Generates a random password with specified length.
     * 
     * @param int $length The length of the password (default is 12).
     * @return string The generated random password.
     */
    public static function generateRandomPassword(int $length = 12): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $password;
    }

    /**
     * Starts a secure session with enhanced security parameters.
     * 
     * @return void
     */
    public static function secureSessionStart(): void
    {
        session_start([
            'cookie_lifetime' => 0,
            'cookie_httponly' => true,
            'cookie_secure' => isset($_SERVER['HTTPS']),
            'use_strict_mode' => true,
            'use_cookies' => true,
            'use_only_cookies' => true,
        ]);
        session_regenerate_id(true);
    }

    /**
     * Generates a JSON Web Token (JWT) with the specified payload.
     * 
     * @param array $payload The payload data for the JWT.
     * @param string $secret The secret key for signing the JWT.
     * @return string The generated JWT.
     */
    public static function generateJWT(array $payload, string $secret): string
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($payload);

        $header64 = base64_encode($header);
        $payload64 = base64_encode($payload);

        $signature = hash_hmac('sha256', "$header64.$payload64", $secret, true);
        return "$header64.$payload64." . base64_encode($signature);
    }

    /**
     * Verifies and decodes a JSON Web Token (JWT).
     * 
     * @param string $jwt The JWT to verify.
     * @param string $secret The secret key for verifying the JWT.
     * @return array|null The decoded payload if the JWT is valid, null otherwise.
     */
    public static function verifyJWT(string $jwt, string $secret): ?array
    {
        $parts = explode('.', $jwt);
        if (count($parts) === 3) {
            list($header64, $payload64, $signature) = $parts;
            $header = json_decode(base64_decode($header64), true);
            $payload = json_decode(base64_decode($payload64), true);

            $validSignature = hash_hmac('sha256', "$header64.$payload64", $secret, true);
            if (hash_equals($signature, base64_encode($validSignature))) {
                return $payload;
            }
        }
        return null;
    }

    /**
     * Generates a HMAC for a given message.
     * 
     * @param string $data The message to hash.
     * @param string $key The secret key for generating the HMAC.
     * @param string $algo The hashing algorithm to use (default is 'sha256').
     * @return string The generated HMAC.
     */
    public static function generateHMAC(string $data, string $key, string $algo = 'sha256'): string
    {
        return hash_hmac($algo, $data, $key);
    }

    /**
     * Validates a given HMAC against the message.
     * 
     * @param string $data The original message.
     * @param string $hmac The HMAC to validate.
     * @param string $key The secret key used to generate the HMAC.
     * @param string $algo The hashing algorithm used (default is 'sha256').
     * @return bool True if the HMAC is valid, false otherwise.
     */
    public static function validateHMAC(string $data, string $hmac, string $key, string $algo = 'sha256'): bool
    {
        $calculatedHmac = self::generateHMAC($data, $key, $algo);
        return hash_equals($calculatedHmac, $hmac);
    }
}