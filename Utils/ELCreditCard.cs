namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for validating credit card numbers.
    /// </summary>
    public static class ELCreditCard {
        /// <summary>
        /// Validates a credit card number using the Luhn algorithm.
        /// </summary>
        /// <param name="cardNumber">The credit card number to validate.</param>
        /// <returns>True if the credit card number is valid; otherwise, false.</returns>
        public static bool IsValidCreditCardNumber(string cardNumber) {
            // Check if the card number is null, empty, or consists only of white-space characters
            if (string.IsNullOrWhiteSpace(cardNumber)) return false;

            // Extract all digit characters from the card number and convert them to an integer array
            int[] cardDigits = cardNumber.Where(char.IsDigit).Select(c => int.Parse(c.ToString())).ToArray();

            // Initialize a checksum variable to accumulate the total sum
            int checksum = 0;

            // Iterate over the digits from right to left, doubling every second digit and summing them
            for (int i = cardDigits.Length - 1; i >= 0; i -= 2) {
                // Double the value of every second digit from the right (starting with the last digit)
                int doubledValue = cardDigits[i] * 2;

                // If the doubled value is greater than 9, subtract 9 from it (equivalent to summing the digits of the doubled value)
                // Add the adjusted value to the checksum, along with the non-doubled digit (if exists) to the left of it
                checksum += (doubledValue > 9 ? doubledValue - 9 : doubledValue) + (i > 0 ? cardDigits[i - 1] : 0);
            }

            // The credit card number is valid if the checksum is divisible by 10
            return checksum % 10 == 0;
        }
    }
}
