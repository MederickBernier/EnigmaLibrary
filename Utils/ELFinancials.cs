namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for financial calculations.
    /// </summary>
    public static class ELFinancials {
        /// <summary>
        /// Calculates the future value of an investment based on compound interest.
        /// </summary>
        /// <param name="principal">The initial amount of money invested or loaned.</param>
        /// <param name="rate">The annual nominal interest rate (as a decimal, e.g., 0.05 for 5%).</param>
        /// <param name="timesCompounded">The number of times that interest is compounded per year.</param>
        /// <param name="years">The number of years the money is invested or borrowed for.</param>
        /// <returns>The future value of the investment after applying compound interest.</returns>
        public static decimal CalculateCompoundInterest(decimal principal, double rate, int timesCompounded, int years) {
            // Calculate the compound interest factor using the formula (1 + r/n)^(nt)
            double compoundFactor = Math.Pow(1 + rate / timesCompounded, timesCompounded * years);

            // Return the future value by multiplying the principal by the compound factor
            return principal * (decimal)compoundFactor;
        }

        /// <summary>
        /// Converts an amount of money from one currency to another using a given conversion rate.
        /// </summary>
        /// <param name="amount">The amount of money to be converted.</param>
        /// <param name="conversionRate">The conversion rate between the two currencies.</param>
        /// <returns>The converted amount of money in the target currency.</returns>
        public static decimal ConvertCurrency(decimal amount, decimal conversionRate) {
            // Multiply the amount by the conversion rate to get the converted amount
            return amount * conversionRate;
        }
    }
}
