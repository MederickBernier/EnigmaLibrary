using EnigmaLibrary.Genetic.Selection;

namespace EnigmaLibrary.Genetic;
public class Population {
    public List<Individual> Individuals { get; }
    public Population(int populationSize, int geneLength) {
        Individuals = new List<Individual>();
        for (int i = 0; i < populationSize; i++) {
            Individuals.Add(new Individual(geneLength));
        }
    }
}
