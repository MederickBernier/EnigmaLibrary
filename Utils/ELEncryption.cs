using System.Security.Cryptography;
using System.Text;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for encrypting and decrypting strings using AES encryption.
    /// </summary>
    public static class ELEncryption {
        /// <summary>
        /// Encrypts a string using the specified key with AES encryption.
        /// </summary>
        /// <param name="input">The string to encrypt.</param>
        /// <param name="key">The encryption key. It should be a 16, 24, or 32-byte string to match AES key sizes.</param>
        /// <returns>The encrypted string, encoded in Base64.</returns>
        public static string EncryptString(string input, string key) {
            // Convert the key string to a byte array using UTF-8 encoding
            byte[] keyBytes = Encoding.UTF8.GetBytes(key);

            // Create a new instance of the Aes class for encryption
            using (Aes aes = Aes.Create()) {
                // Set the AES key and initialization vector (IV)
                aes.Key = keyBytes;
                aes.IV = new byte[16]; // IV is set to zero; ensure this matches on both encryption and decryption

                // Create an encryptor object based on the AES key and IV
                ICryptoTransform encryptor = aes.CreateEncryptor(aes.Key, aes.IV);

                // Create a memory stream to hold the encrypted data
                using (MemoryStream ms = new MemoryStream()) {
                    // Create a CryptoStream that links the memory stream with the encryptor
                    using (CryptoStream cs = new CryptoStream(ms, encryptor, CryptoStreamMode.Write)) {
                        // Create a StreamWriter to write the input string to the CryptoStream
                        using (StreamWriter sw = new StreamWriter(cs)) {
                            sw.Write(input);
                        }

                        // Convert the encrypted data in the memory stream to a Base64 string and return it
                        return Convert.ToBase64String(ms.ToArray());
                    }
                }
            }
        }

        /// <summary>
        /// Decrypts a Base64-encoded, AES-encrypted string using the specified key.
        /// </summary>
        /// <param name="encryptedText">The Base64-encoded string to decrypt.</param>
        /// <param name="key">The decryption key. It should be the same key used for encryption.</param>
        /// <returns>The decrypted string.</returns>
        public static string DecryptString(string encryptedText, string key) {
            // Convert the key string to a byte array using UTF-8 encoding
            byte[] keyBytes = Encoding.UTF8.GetBytes(key);

            // Convert the Base64-encoded encrypted text back to a byte array
            byte[] buffer = Convert.FromBase64String(encryptedText);

            // Create a new instance of the Aes class for decryption
            using (Aes aes = Aes.Create()) {
                // Set the AES key and initialization vector (IV)
                aes.Key = keyBytes;
                aes.IV = new byte[16]; // IV is set to zero; ensure this matches on both encryption and decryption

                // Create a decryptor object based on the AES key and IV
                ICryptoTransform decryptor = aes.CreateDecryptor(aes.Key, aes.IV);

                // Create a memory stream to hold the encrypted data
                using (MemoryStream ms = new MemoryStream(buffer)) {
                    // Create a CryptoStream that links the memory stream with the decryptor
                    using (CryptoStream cs = new CryptoStream(ms, decryptor, CryptoStreamMode.Read)) {
                        // Create a StreamReader to read the decrypted data from the CryptoStream
                        using (StreamReader sr = new StreamReader(cs)) {
                            // Return the decrypted string
                            return sr.ReadToEnd();
                        }
                    }
                }
            }
        }
    }
}
