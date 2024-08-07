using System.Text.Json;

namespace EnigmaLibrary;
public static class JsonUtils {
    public static string SerializeToJson<T>(T obj) {
        return JsonSerializer.Serialize(obj);
    }

    public static T DeserializeFromJson<T>(string json) {
        return JsonSerializer.Deserialize<T>(json);
    }
}
