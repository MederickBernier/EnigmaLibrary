using System.Security.Cryptography;
using System.Text;

namespace EnigmaLibrary;
public static class EncryptionUtils {
    public static string EncryptString(string input, string key) {
        byte[] keyBytes = Encoding.UTF8.GetBytes(key);
        using (Aes aes = Aes.Create()) {
            aes.Key = keyBytes;
            aes.IV = new byte[16];
            ICryptoTransform encryptor = aes.CreateEncryptor(aes.Key, aes.IV);

            using (MemoryStream ms = new MemoryStream()) {
                using (CryptoStream cs = new CryptoStream(ms, encryptor, CryptoStreamMode.Write)) {
                    using (StreamWriter sw = new StreamWriter(cs)) {
                        sw.Write(input);
                    }
                    return Convert.ToBase64String(ms.ToArray());
                }
            }
        }
    }

    public static string DecryptString(string encryptedText, string key) {
        byte[] keyBytes = Encoding.UTF8.GetBytes(key);
        byte[] buffer = Convert.FromBase64String(encryptedText);

        using (Aes aes = Aes.Create()) {
            aes.Key = keyBytes;
            aes.IV = new byte[16];
            ICryptoTransform decryptor = aes.CreateDecryptor(aes.Key, aes.IV);

            using (MemoryStream ms = new MemoryStream(buffer)) {
                using (CryptoStream cs = new CryptoStream(ms, decryptor, CryptoStreamMode.Read)) {
                    using (StreamReader sr = new StreamReader(cs)) {
                        return sr.ReadToEnd();
                    }
                }
            }
        }
    }
}