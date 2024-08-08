using EnigmaLibrary.Genetic.Selection;

namespace EnigmaLibrary.Genetic.Mutation.SwapMutation;
public class SwapMutation : IMutationStrategy {
    private readonly Random _random;

    public SwapMutation() {
        _random = new Random();
    }
    public void Mutate(Individual individual) {
        int length = individual.Genes.Length;
        int index1 = _random.Next(length);
        int index2 = _random.Next(length);

        double temp = individual.Genes[index1];
        individual.Genes[index1] = individual.Genes[index2];
        individual.Genes[index2] = temp;
    }
}
