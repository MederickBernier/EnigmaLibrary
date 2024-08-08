using System.Security.Cryptography;
using System.Text;
namespace EnigmaLibrary.Utils;
public static class ELCryptography {
    public static string GenerateMD5Hash(string input) {
        using (MD5 md5 = MD5.Create()) {
            byte[] inputBytes = Encoding.UTF8.GetBytes(input);
            byte[] hashBytes = md5.ComputeHash(inputBytes);

            StringBuilder sb = new StringBuilder();
            for (int i = 0; i < hashBytes.Length; i++) {
                sb.Append(hashBytes[i].ToString("x2"));
            }
            return sb.ToString();
        }
    }

    public static string GenerateSha256Hash(string input) {
        using (SHA256 sha256 = SHA256.Create()) {
            byte[] inputBytes = Encoding.UTF8.GetBytes(input);
            byte[] hashBytes = sha256.ComputeHash(inputBytes);

            StringBuilder sb = new StringBuilder();
            for (int i = 0; i < hashBytes.Length; i++) {
                sb.Append(hashBytes[i].ToString("X2"));
            }
            return sb.ToString();
        }
    }

    public static string GenerateRandomKey(int size) {
        byte[] keyBytes = new byte[size];
        RandomNumberGenerator.Fill(keyBytes);
        return Convert.ToBase64String(keyBytes);
    }
}
