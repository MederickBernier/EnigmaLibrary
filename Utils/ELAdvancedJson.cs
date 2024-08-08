using System.Text.Json;

namespace EnigmaLibrary.Utils;
public static class ELAdvancedJson {
    public static string SerializeWithOptions<T>(T obj, JsonSerializerOptions options) {
        return JsonSerializer.Serialize(obj, options);
    }

    public static T DeserializeWithOptions<T>(string json, JsonSerializerOptions options) {
        return JsonSerializer.Deserialize<T>(json, options);
    }

    public static string PrettifyJson(string json) {
        var jsonElement = JsonSerializer.Deserialize<JsonElement>(json);
        return JsonSerializer.Serialize(jsonElement, new JsonSerializerOptions { WriteIndented = true });
    }
}
