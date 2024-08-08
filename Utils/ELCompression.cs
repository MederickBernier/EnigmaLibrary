using System.IO.Compression;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for compressing and decompressing data using GZip.
    /// </summary>
    public static class ELCompression {
        /// <summary>
        /// Compresses a byte array using GZip compression.
        /// </summary>
        /// <param name="data">The byte array to be compressed.</param>
        /// <returns>A compressed byte array.</returns>
        public static byte[] CompressData(byte[] data) {
            // Create a memory stream to hold the compressed data
            using (MemoryStream compressedStream = new MemoryStream()) {
                // Create a GZipStream to handle the compression
                // CompressionMode.Compress indicates that the stream will be used for compression
                using (GZipStream gzipStream = new GZipStream(compressedStream, CompressionMode.Compress)) {
                    // Write the original data to the GZipStream
                    // This compresses the data and writes it to the compressedStream
                    gzipStream.Write(data, 0, data.Length);
                }

                // Convert the compressed data in the memory stream to a byte array and return it
                return compressedStream.ToArray();
            }
        }

        /// <summary>
        /// Decompresses a GZip-compressed byte array.
        /// </summary>
        /// <param name="compressedData">The compressed byte array to be decompressed.</param>
        /// <returns>A decompressed byte array.</returns>
        public static byte[] DecompressData(byte[] compressedData) {
            // Create a memory stream containing the compressed data
            using (MemoryStream compressedStream = new MemoryStream(compressedData)) {
                // Create a memory stream to hold the decompressed data
                using (MemoryStream outputStream = new MemoryStream()) {
                    // Create a GZipStream to handle the decompression
                    // CompressionMode.Decompress indicates that the stream will be used for decompression
                    using (GZipStream gzipStream = new GZipStream(compressedStream, CompressionMode.Decompress)) {
                        // Copy the decompressed data from the GZipStream to the outputStream
                        gzipStream.CopyTo(outputStream);
                    }

                    // Convert the decompressed data in the output stream to a byte array and return it
                    return outputStream.ToArray();
                }
            }
        }
    }
}
