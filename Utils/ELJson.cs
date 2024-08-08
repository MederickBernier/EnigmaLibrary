using System.Text.Json;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for serializing and deserializing JSON using System.Text.Json.
    /// </summary>
    public static class ELJson {
        /// <summary>
        /// Serializes an object to a JSON string.
        /// </summary>
        /// <typeparam name="T">The type of the object to serialize.</typeparam>
        /// <param name="obj">The object to serialize to JSON.</param>
        /// <returns>A JSON string representing the serialized object.</returns>
        public static string SerializeToJson<T>(T obj) {
            // Serialize the object to a JSON string and return it
            return JsonSerializer.Serialize(obj);
        }

        /// <summary>
        /// Deserializes a JSON string to an object of the specified type.
        /// </summary>
        /// <typeparam name="T">The type of the object to deserialize to.</typeparam>
        /// <param name="json">The JSON string to deserialize.</param>
        /// <returns>An object of type T deserialized from the JSON string.</returns>
        public static T DeserializeFromJson<T>(string json) {
            // Deserialize the JSON string to an object of type T and return it
            return JsonSerializer.Deserialize<T>(json);
        }
    }
}
