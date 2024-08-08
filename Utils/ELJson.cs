using System.Text.Json;

namespace EnigmaLibrary.Utils;
public static class ELJson {
    public static string SerializeToJson<T>(T obj) {
        return JsonSerializer.Serialize(obj);
    }

    public static T DeserializeFromJson<T>(string json) {
        return JsonSerializer.Deserialize<T>(json);
    }
}
