namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing a simple caching mechanism using a dictionary.
    /// Allows adding, retrieving, removing, and clearing cached objects.
    /// </summary>
    public static class ELCache {
        // Private static dictionary to hold the cache items. The cache stores key-value pairs,
        // where the key is a string and the value is an object.
        private static Dictionary<string, object> cache = new Dictionary<string, object>();

        /// <summary>
        /// Adds an object to the cache with the specified key. If the key already exists, the value is updated.
        /// </summary>
        /// <param name="key">The key used to identify the cached object.</param>
        /// <param name="value">The object to be cached.</param>
        public static void AddToCache(string key, object value) {
            // Check if the key already exists in the cache
            if (cache.ContainsKey(key)) {
                // Update the existing value
                cache[key] = value;
            } else {
                // Add the new key-value pair to the cache
                cache.Add(key, value);
            }
        }

        /// <summary>
        /// Retrieves an object from the cache using the specified key.
        /// </summary>
        /// <param name="key">The key used to identify the cached object.</param>
        /// <returns>The cached object if found; otherwise, null.</returns>
        public static object GetFromCache(string key) {
            // Try to get the value associated with the specified key
            cache.TryGetValue(key, out var value);

            // Return the value, or null if the key does not exist in the cache
            return value;
        }

        /// <summary>
        /// Removes an object from the cache using the specified key.
        /// </summary>
        /// <param name="key">The key used to identify the cached object.</param>
        public static void RemoveFromCache(string key) {
            // Check if the key exists in the cache
            if (cache.ContainsKey(key)) {
                // Remove the key-value pair from the cache
                cache.Remove(key);
            }
        }

        /// <summary>
        /// Clears all objects from the cache, effectively emptying it.
        /// </summary>
        public static void ClearCache() {
            // Clear all key-value pairs from the cache
            cache.Clear();
        }
    }
}
