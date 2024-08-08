namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing various operations for handling binary files.
    /// Includes methods for reading, writing, appending, and manipulating binary data.
    /// </summary>
    public static class ELBinaryFile {
        /// <summary>
        /// Reads the entire content of a binary file and returns it as a byte array.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <returns>A byte array containing the file's data.</returns>
        /// <exception cref="FileNotFoundException">Thrown if the specified file does not exist.</exception>
        public static byte[] ReadBinaryFile(string path) {
            // Check if the file exists; if not, throw an exception
            if (!File.Exists(path))
                throw new FileNotFoundException("File not found");

            // Read and return the file's content as a byte array
            return File.ReadAllBytes(path);
        }

        /// <summary>
        /// Writes a byte array to a binary file, overwriting it if it already exists.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <param name="data">The byte array to write to the file.</param>
        public static void WriteBinaryFile(string path, byte[] data) {
            // Write the byte array to the specified file, overwriting any existing content
            File.WriteAllBytes(path, data);
        }

        /// <summary>
        /// Appends a byte array to the end of an existing binary file.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <param name="data">The byte array to append to the file.</param>
        public static void AppendBinaryFile(string path, byte[] data) {
            // Open the file in append mode, allowing writing, and append the byte array
            using (FileStream fs = new FileStream(path, FileMode.Append, FileAccess.Write)) {
                fs.Write(data, 0, data.Length);
            }
        }

        /// <summary>
        /// Reads the entire content of a binary file and returns it as a string representation of the bytes.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <returns>A string representing the byte content of the file.</returns>
        /// <exception cref="FileNotFoundException">Thrown if the specified file does not exist.</exception>
        public static string ReadBinaryFileAsString(string path) {
            // Check if the file exists; if not, throw an exception
            if (!File.Exists(path))
                throw new FileNotFoundException("File not found");

            // Read the file's content as a byte array
            byte[] data = File.ReadAllBytes(path);

            // Convert the byte array to a string representation and return it
            return BitConverter.ToString(data);
        }

        /// <summary>
        /// Converts a string to an integer, then to a byte array, and writes it to a binary file.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <param name="content">The string content to be converted and written.</param>
        public static void WriteStringToBinaryFile(string path, string content) {
            // Convert the string to an integer, then to a byte array
            byte[] data = BitConverter.GetBytes(Convert.ToInt32(content));

            // Write the byte array to the specified file
            File.WriteAllBytes(path, data);
        }

        /// <summary>
        /// Reads the entire content of a binary file using a BinaryReader and returns it as a string representation of the bytes.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <returns>A string representing the byte content of the file.</returns>
        public static string ReadBinaryFileWithBinaryReader(string path) {
            // Open the file for reading using a FileStream and BinaryReader
            using (FileStream fs = new FileStream(path, FileMode.Open, FileAccess.Read))
            using (BinaryReader reader = new BinaryReader(fs)) {
                // Determine the length of the file
                long fileLength = new FileInfo(path).Length;

                // Read the file's content as a byte array
                byte[] data = reader.ReadBytes((int)fileLength);

                // Convert the byte array to a string representation and return it
                return BitConverter.ToString(data);
            }
        }

        /// <summary>
        /// Writes a byte array to a binary file using a BinaryWriter, overwriting it if it already exists.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <param name="data">The byte array to write to the file.</param>
        public static void WriteBinaryFileWithBinaryWriter(string path, byte[] data) {
            // Open the file for writing using a FileStream and BinaryWriter
            using (FileStream fs = new FileStream(path, FileMode.Create, FileAccess.Write))
            using (BinaryWriter writer = new BinaryWriter(fs)) {
                // Write the byte array to the file
                writer.Write(data);
            }
        }

        /// <summary>
        /// Copies a binary file from one location to another.
        /// </summary>
        /// <param name="source">The path to the source binary file.</param>
        /// <param name="destination">The path to the destination binary file.</param>
        /// <exception cref="FileNotFoundException">Thrown if the source file does not exist.</exception>
        public static void CopyBinaryFile(string source, string destination) {
            // Check if the source file exists; if not, throw an exception
            if (!File.Exists(source))
                throw new FileNotFoundException("Source file not found");

            // Copy the source file to the destination, overwriting any existing file
            File.Copy(source, destination, true);
        }

        /// <summary>
        /// Deletes a binary file if it exists.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        public static void DeleteBinaryFile(string path) {
            // Check if the file exists, and if so, delete it
            if (File.Exists(path)) {
                File.Delete(path);
            }
        }

        /// <summary>
        /// Reads a specified number of bytes from a binary file starting at a specified position.
        /// </summary>
        /// <param name="path">The path to the binary file.</param>
        /// <param name="position">The position within the file to start reading from.</param>
        /// <param name="count">The number of bytes to read.</param>
        /// <returns>A byte array containing the data read from the file.</returns>
        public static byte[] ReadBytesFromPath(string path, int position, int count) {
            // Open the file for reading using a FileStream
            using (FileStream fs = new FileStream(path, FileMode.Open, FileAccess.Read)) {
                // Seek to the specified position in the file
                fs.Seek(position, SeekOrigin.Begin);

                // Create a byte array to hold the read data
                byte[] bytes = new byte[count];

                // Read the specified number of bytes into the array
                fs.Read(bytes, 0, count);

                // Return the read bytes
                return bytes;
            }
        }
    }
}
