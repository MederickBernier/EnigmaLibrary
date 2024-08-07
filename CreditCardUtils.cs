namespace EnigmaLibrary;
public static class CreditCardUtils {
    public static bool IsValidCreditCardNumber(string cardNumber) {
        if (string.IsNullOrWhiteSpace(cardNumber)) return false;

        int[] cardDigits = cardNumber.Where(char.IsDigit).Select(c => int.Parse(c.ToString())).ToArray();
        int checksum = 0;

        for (int i = cardDigits.Length - 1; i >= 0; i -= 2) {
            int doubledValue = cardDigits[i] * 2;
            checksum += (doubledValue > 9 ? doubledValue - 9 : doubledValue) + (i > 0 ? cardDigits[i - 1] : 0);
        }

        return checksum % 10 == 0;
    }
}
