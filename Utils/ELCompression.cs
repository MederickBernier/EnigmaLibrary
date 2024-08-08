using System.IO.Compression;

namespace EnigmaLibrary.Utils;
public static class ELCompression {
    public static byte[] CompressData(byte[] data) {
        using (MemoryStream compressedStream = new MemoryStream()) {
            using (GZipStream gzipStream = new GZipStream(compressedStream, CompressionMode.Compress)) {
                gzipStream.Write(data, 0, data.Length);
            }
            return compressedStream.ToArray();
        }
    }

    public static byte[] DecompressData(byte[] compressedData) {
        using (MemoryStream compressedStream = new MemoryStream(compressedData)) {
            using (MemoryStream outputStream = new MemoryStream()) {
                using (GZipStream gzipStream = new GZipStream(compressedStream, CompressionMode.Decompress)) {
                    gzipStream.CopyTo(outputStream);
                }
                return outputStream.ToArray();
            }
        }
    }
}
