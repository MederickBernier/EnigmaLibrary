namespace EnigmaLibrary.Utils;
public static class ELBinaryFile {
    public static byte[] ReadBinaryFile(string path) {
        if (!File.Exists(path)) throw new FileNotFoundException("File not found");
        return File.ReadAllBytes(path);
    }

    public static void WriteBinaryFile(string path, byte[] data) {
        File.WriteAllBytes(path, data);
    }

    public static void AppendBinaryFile(string path, byte[] data) {
        using (FileStream fs = new FileStream(path, FileMode.Append, FileAccess.Write)) {
            fs.Write(data, 0, data.Length);
        }
    }

    public static string ReadBinaryFileAsString(string path) {
        if (!File.Exists(path)) throw new FileNotFoundException("File not found");
        byte[] data = File.ReadAllBytes(path);
        return BitConverter.ToString(data);
    }

    public static void WriteStringToBinaryFile(string path, string content) {
        byte[] data = BitConverter.GetBytes(Convert.ToInt32(content));
        File.WriteAllBytes(path, data);
    }

    public static string ReadBinaryFileWithBinaryReader(string path) {
        using (FileStream fs = new FileStream(path, FileMode.Open, FileAccess.Read))
        using (BinaryReader reader = new BinaryReader(fs)) {
            long fileLength = new FileInfo(path).Length;
            byte[] data = reader.ReadBytes((int)fileLength);
            return BitConverter.ToString(data);
        }
    }

    public static void WriteBinaryFileWithBinaryWriter(string path, byte[] data) {
        using (FileStream fs = new FileStream(path, FileMode.Create, FileAccess.Write))
        using (BinaryWriter writer = new BinaryWriter(fs)) {
            writer.Write(data);
        }
    }

    public static void CopyBinaryFile(string source, string destination) {
        if (!File.Exists(source)) throw new FileNotFoundException("Source file not found");
        File.Copy(source, destination, true);
    }

    public static void DeleteBinaryFile(string path) {
        if (File.Exists(path)) {
            File.Delete(path);
        }
    }

    public static byte[] ReadBytesFromPath(string path, int position, int count) {
        using (FileStream fs = new FileStream(path, FileMode.Open, FileAccess.Read)) {
            fs.Seek(position, SeekOrigin.Begin);
            byte[] bytes = new byte[count];
            fs.Read(bytes, 0, count);
            return bytes;
        }
    }
}
