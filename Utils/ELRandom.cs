namespace EnigmaLibrary.Utils;
public static class ELRandom {
    private static readonly Random _random = new Random();

    public static int GenerateRandomNumber(int min, int max) {
        return _random.Next(min, max);
    }

    public static string GenerateRandomString(int length) {
        const string chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        return new string(Enumerable.Repeat(chars, length)
          .Select(s => s[_random.Next(s.Length)]).ToArray());
    }

    public static T GetRandomItem<T>(List<T> items) {
        if (items == null || !items.Any()) throw new ArgumentException("The list cannot be empty");
        return items[_random.Next(items.Count)];
    }

    public static double GenerateRandomDouble(double min, double max) {
        return _random.NextDouble() * (max - min) + min;
    }
}
