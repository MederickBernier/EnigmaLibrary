using System.Text.Json;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing advanced JSON serialization and deserialization operations.
    /// </summary>
    public static class ELAdvancedJson {
        /// <summary>
        /// Serializes an object of type <typeparamref name="T"/> into a JSON string using specified serialization options.
        /// </summary>
        /// <typeparam name="T">The type of the object to be serialized.</typeparam>
        /// <param name="obj">The object to be serialized into JSON format.</param>
        /// <param name="options">The options to control the serialization process.</param>
        /// <returns>A JSON string representation of the object.</returns>
        public static string SerializeWithOptions<T>(T obj, JsonSerializerOptions options) {
            // Serialize the object to a JSON string using the provided JsonSerializerOptions
            return JsonSerializer.Serialize(obj, options);
        }

        /// <summary>
        /// Deserializes a JSON string into an object of type <typeparamref name="T"/> using specified deserialization options.
        /// </summary>
        /// <typeparam name="T">The type of the object to be deserialized.</typeparam>
        /// <param name="json">The JSON string to be deserialized into an object.</param>
        /// <param name="options">The options to control the deserialization process.</param>
        /// <returns>An object of type <typeparamref name="T"/> represented by the JSON string.</returns>
        public static T DeserializeWithOptions<T>(string json, JsonSerializerOptions options) {
            // Deserialize the JSON string to an object of type T using the provided JsonSerializerOptions
            return JsonSerializer.Deserialize<T>(json, options);
        }

        /// <summary>
        /// Prettifies a JSON string by formatting it with indents and new lines, making it easier to read.
        /// </summary>
        /// <param name="json">The JSON string to be prettified.</param>
        /// <returns>A formatted JSON string with indentation and new lines for readability.</returns>
        public static string PrettifyJson(string json) {
            // Deserialize the JSON string to a JsonElement, which represents the JSON structure
            var jsonElement = JsonSerializer.Deserialize<JsonElement>(json);

            // Serialize the JsonElement back to a JSON string with the WriteIndented option set to true
            // This will format the JSON with indents and new lines
            return JsonSerializer.Serialize(jsonElement, new JsonSerializerOptions { WriteIndented = true });
        }
    }
}
