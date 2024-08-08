namespace EnigmaLibrary.Utils;
public static class ELCache {
    private static Dictionary<string, object> cache = new Dictionary<string, object>();

    public static void AddToCache(string key, object value) {
        if (cache.ContainsKey(key)) {
            cache[key] = value;
        } else {
            cache.Add(key, value);
        }
    }
    public static object GetFromCache(string key) {
        cache.TryGetValue(key, out var value);
        return value;
    }

    public static void RemoveFromCache(string key) {
        if (cache.ContainsKey(key)) {
            cache.Remove(key);
        }
    }

    public static void ClearCache() {
        cache.Clear();
    }
}
