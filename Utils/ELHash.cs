using System.Security.Cryptography;
using System.Text;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for generating and verifying hashes using SHA-256.
    /// </summary>
    public static class ELHash {
        /// <summary>
        /// Generates a SHA-256 hash for the given input string.
        /// </summary>
        /// <param name="input">The input string to hash.</param>
        /// <returns>A hexadecimal string representation of the SHA-256 hash.</returns>
        public static string GenerateHash(string input) {
            // Create a new instance of SHA-256 hash algorithm
            using (SHA256 sha256Hash = SHA256.Create()) {
                // Compute the hash as a byte array for the input string
                byte[] bytes = sha256Hash.ComputeHash(Encoding.UTF8.GetBytes(input));

                // Convert the byte array to a hexadecimal string
                StringBuilder builder = new StringBuilder();
                for (int i = 0; i < bytes.Length; i++) {
                    builder.Append(bytes[i].ToString("x2"));
                }

                // Return the resulting hash string
                return builder.ToString();
            }
        }

        /// <summary>
        /// Verifies that a given input string matches a provided SHA-256 hash.
        /// </summary>
        /// <param name="input">The input string to hash and compare.</param>
        /// <param name="hash">The hash to compare against.</param>
        /// <returns>True if the input string's hash matches the provided hash; otherwise, false.</returns>
        public static bool VerifyHash(string input, string hash) {
            // Generate the hash for the input string
            string hashOfInput = GenerateHash(input);

            // Compare the computed hash with the provided hash, ignoring case sensitivity
            return StringComparer.OrdinalIgnoreCase.Compare(hashOfInput, hash) == 0;
        }
    }
}
