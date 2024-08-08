namespace EnigmaLibrary.Utils;
public static class ELcollection {
    public static bool IsNullOrEmpty<T>(IEnumerable<T> collection) {
        return collection == null || !collection.Any();
    }

    public static T FindMax<T>(IEnumerable<T> collection) where T : IComparable<T> {
        if (IsNullOrEmpty(collection)) throw new ArgumentException("The collection cannot be empty");
        return collection.Max();
    }

    public static T FindMin<T>(IEnumerable<T> collection) where T : IComparable<T> {
        if (IsNullOrEmpty(collection)) throw new ArgumentException("The collection cannot be empty");
        return collection.Min();
    }

    public static IEnumerable<T> Shuffle<T>(IEnumerable<T> collection) {
        return collection.OrderBy(_ => Guid.NewGuid()).ToList();
    }
}
