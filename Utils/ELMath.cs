namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing various mathematical functions.
    /// </summary>
    public static class ELMath {
        /// <summary>
        /// Calculates the percentage that a value represents of a total.
        /// </summary>
        /// <param name="total">The total amount.</param>
        /// <param name="value">The value to calculate the percentage of.</param>
        /// <returns>The percentage value as a double.</returns>
        /// <exception cref="DivideByZeroException">Thrown if the total is zero.</exception>
        public static double CalculatePercentage(double total, double value) {
            // Ensure that total is not zero to avoid division by zero
            if (total == 0)
                throw new DivideByZeroException("total cannot be zero");

            // Calculate and return the percentage
            return value / total * 100;
        }

        /// <summary>
        /// Finds the greatest common divisor (GCD) of two integers using the Euclidean algorithm.
        /// </summary>
        /// <param name="a">The first integer.</param>
        /// <param name="b">The second integer.</param>
        /// <returns>The greatest common divisor of a and b.</returns>
        public static int FindGreatestCommonDivisor(int a, int b) {
            // Implement the Euclidean algorithm to find the GCD
            while (b != 0) {
                int temp = b;
                b = a % b;
                a = temp;
            }
            return a;
        }

        /// <summary>
        /// Finds the least common multiple (LCM) of two integers.
        /// </summary>
        /// <param name="a">The first integer.</param>
        /// <param name="b">The second integer.</param>
        /// <returns>The least common multiple of a and b.</returns>
        public static int FindLeastCommonMultiple(int a, int b) {
            // Calculate and return the LCM using the formula LCM(a, b) = |a * b| / GCD(a, b)
            return a / FindGreatestCommonDivisor(a, b) * b;
        }
    }
}
