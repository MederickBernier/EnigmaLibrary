namespace EnigmaLibrary.Utils;
public static class ELFinancials {
    public static decimal CalculateCompoundInterest(decimal principal, double rate, int timesCompounded, int years) {
        double compoundFactor = Math.Pow(1 + rate / timesCompounded, timesCompounded * years);
        return principal * (decimal)compoundFactor;
    }

    public static decimal ConvertCurrency(decimal amount, decimal conversionRate) {
        return amount * conversionRate;
    }
}
