using System.Security.Cryptography;
using System.Text;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing cryptographic methods, including hashing and key generation.
    /// </summary>
    public static class ELCryptography {
        /// <summary>
        /// Generates an MD5 hash for the given input string.
        /// </summary>
        /// <param name="input">The input string to hash.</param>
        /// <returns>A hexadecimal string representation of the MD5 hash.</returns>
        public static string GenerateMD5Hash(string input) {
            // Create an MD5 hash algorithm instance
            using (MD5 md5 = MD5.Create()) {
                // Convert the input string to a byte array using UTF-8 encoding
                byte[] inputBytes = Encoding.UTF8.GetBytes(input);

                // Compute the hash for the byte array
                byte[] hashBytes = md5.ComputeHash(inputBytes);

                // Convert the hash byte array to a hexadecimal string
                StringBuilder sb = new StringBuilder();
                for (int i = 0; i < hashBytes.Length; i++) {
                    sb.Append(hashBytes[i].ToString("x2"));
                }

                // Return the resulting hash string
                return sb.ToString();
            }
        }

        /// <summary>
        /// Generates a SHA-256 hash for the given input string.
        /// </summary>
        /// <param name="input">The input string to hash.</param>
        /// <returns>A hexadecimal string representation of the SHA-256 hash.</returns>
        public static string GenerateSha256Hash(string input) {
            // Create a SHA-256 hash algorithm instance
            using (SHA256 sha256 = SHA256.Create()) {
                // Convert the input string to a byte array using UTF-8 encoding
                byte[] inputBytes = Encoding.UTF8.GetBytes(input);

                // Compute the hash for the byte array
                byte[] hashBytes = sha256.ComputeHash(inputBytes);

                // Convert the hash byte array to a hexadecimal string
                // Use uppercase format ("X2") for the hexadecimal characters
                StringBuilder sb = new StringBuilder();
                for (int i = 0; i < hashBytes.Length; i++) {
                    sb.Append(hashBytes[i].ToString("X2"));
                }

                // Return the resulting hash string
                return sb.ToString();
            }
        }

        /// <summary>
        /// Generates a random key of the specified size in bytes.
        /// </summary>
        /// <param name="size">The size of the key to generate, in bytes.</param>
        /// <returns>A base64 string representation of the generated random key.</returns>
        public static string GenerateRandomKey(int size) {
            // Create a byte array to hold the random key
            byte[] keyBytes = new byte[size];

            // Fill the byte array with cryptographically secure random bytes
            RandomNumberGenerator.Fill(keyBytes);

            // Convert the byte array to a base64 string and return it
            return Convert.ToBase64String(keyBytes);
        }
    }
}
