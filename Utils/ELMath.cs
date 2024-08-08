namespace EnigmaLibrary.Utils;
public static class ELMath {
    public static double CalculatePercentage(double total, double value) {
        if (total == 0) throw new DivideByZeroException("total cannot be zero");
        return value / total * 100;
    }

    public static int FindGreatestCommonDivisor(int a, int b) {
        while (b != 0) {
            int temp = b;
            b = a % b;
            a = temp;
        }
        return a;
    }

    public static int FindLeastCommonMultiple(int a, int b) {
        return a / FindGreatestCommonDivisor(a, b) * b;
    }
}
