using EnigmaLibrary.Genetic.Selection;

namespace EnigmaLibrary.Genetic.Mutation;
public interface IMutationStrategy {
    void Mutate(Individual individual);
}
