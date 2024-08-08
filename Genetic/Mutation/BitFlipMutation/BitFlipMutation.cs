using EnigmaLibrary.Genetic.Selection;

namespace EnigmaLibrary.Genetic.Mutation.BitFlipMutation;
public class BitFlipMutation : IMutationStrategy {
    private readonly Random _random;
    private readonly double _mutationRate;
    public void Mutate(Individual individual) {
        for (int i = 0; i < individual.Genes.Length; i++) {
            if (_random.NextDouble() < _mutationRate) {
                individual.Genes[i] = individual.Genes[i] == 0 ? 1 : 0;
            }
        }
    }
}
