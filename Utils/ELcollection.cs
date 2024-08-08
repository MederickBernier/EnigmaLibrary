namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing various collection-related operations.
    /// Includes methods for checking if a collection is null or empty, finding the maximum and minimum values, and shuffling the collection.
    /// </summary>
    public static class ELCollection {
        /// <summary>
        /// Checks if a collection is null or empty.
        /// </summary>
        /// <typeparam name="T">The type of elements in the collection.</typeparam>
        /// <param name="collection">The collection to check.</param>
        /// <returns>True if the collection is null or empty; otherwise, false.</returns>
        public static bool IsNullOrEmpty<T>(IEnumerable<T> collection) {
            // Check if the collection is null or has no elements
            return collection == null || !collection.Any();
        }

        /// <summary>
        /// Finds the maximum value in a collection.
        /// </summary>
        /// <typeparam name="T">The type of elements in the collection. Must implement IComparable<T>.</typeparam>
        /// <param name="collection">The collection to search for the maximum value.</param>
        /// <returns>The maximum value in the collection.</returns>
        /// <exception cref="ArgumentException">Thrown if the collection is null or empty.</exception>
        public static T FindMax<T>(IEnumerable<T> collection) where T : IComparable<T> {
            // Check if the collection is null or empty
            if (IsNullOrEmpty(collection))
                throw new ArgumentException("The collection cannot be empty");

            // Return the maximum value in the collection
            return collection.Max();
        }

        /// <summary>
        /// Finds the minimum value in a collection.
        /// </summary>
        /// <typeparam name="T">The type of elements in the collection. Must implement IComparable<T>.</typeparam>
        /// <param name="collection">The collection to search for the minimum value.</param>
        /// <returns>The minimum value in the collection.</returns>
        /// <exception cref="ArgumentException">Thrown if the collection is null or empty.</exception>
        public static T FindMin<T>(IEnumerable<T> collection) where T : IComparable<T> {
            // Check if the collection is null or empty
            if (IsNullOrEmpty(collection))
                throw new ArgumentException("The collection cannot be empty");

            // Return the minimum value in the collection
            return collection.Min();
        }

        /// <summary>
        /// Randomly shuffles the elements of a collection.
        /// </summary>
        /// <typeparam name="T">The type of elements in the collection.</typeparam>
        /// <param name="collection">The collection to shuffle.</param>
        /// <returns>A new collection with the elements shuffled.</returns>
        public static IEnumerable<T> Shuffle<T>(IEnumerable<T> collection) {
            // Shuffle the collection using a random GUID as the sort key
            // and return the shuffled collection as a list
            return collection.OrderBy(_ => Guid.NewGuid()).ToList();
        }
    }
}
