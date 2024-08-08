namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class for generating random numbers, strings, and selecting random items from a list.
    /// </summary>
    public static class ELRandom {
        // Static Random instance to ensure randomness across method calls
        private static readonly Random _random = new Random();

        /// <summary>
        /// Generates a random integer between the specified minimum (inclusive) and maximum (exclusive) values.
        /// </summary>
        /// <param name="min">The inclusive lower bound of the random number returned.</param>
        /// <param name="max">The exclusive upper bound of the random number returned.</param>
        /// <returns>A random integer between min (inclusive) and max (exclusive).</returns>
        public static int GenerateRandomNumber(int min, int max) {
            return _random.Next(min, max);
        }

        /// <summary>
        /// Generates a random string of the specified length consisting of uppercase letters, lowercase letters, and digits.
        /// </summary>
        /// <param name="length">The length of the random string to generate.</param>
        /// <returns>A random string of the specified length.</returns>
        public static string GenerateRandomString(int length) {
            const string chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            // Generate a random string by selecting random characters from the chars string
            return new string(Enumerable.Repeat(chars, length)
                .Select(s => s[_random.Next(s.Length)]).ToArray());
        }

        /// <summary>
        /// Selects a random item from a list of items.
        /// </summary>
        /// <typeparam name="T">The type of items in the list.</typeparam>
        /// <param name="items">The list of items to select from.</param>
        /// <returns>A random item from the list.</returns>
        /// <exception cref="ArgumentException">Thrown if the list is null or empty.</exception>
        public static T GetRandomItem<T>(List<T> items) {
            if (items == null || !items.Any())
                throw new ArgumentException("The list cannot be empty");

            // Return a random item from the list
            return items[_random.Next(items.Count)];
        }

        /// <summary>
        /// Generates a random double value between the specified minimum (inclusive) and maximum (exclusive) values.
        /// </summary>
        /// <param name="min">The inclusive lower bound of the random double returned.</param>
        /// <param name="max">The exclusive upper bound of the random double returned.</param>
        /// <returns>A random double between min (inclusive) and max (exclusive).</returns>
        public static double GenerateRandomDouble(double min, double max) {
            // Generate a random double within the specified range
            return _random.NextDouble() * (max - min) + min;
        }
    }
}
