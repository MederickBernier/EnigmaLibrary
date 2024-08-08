using EnigmaLibrary.Genetic.Crossover;
using EnigmaLibrary.Genetic.Mutation;
using EnigmaLibrary.Genetic.Selection;

namespace EnigmaLibrary.Genetic {
    public class GeneticAlgorithm {
        private readonly ISelectionStrategy _selectionStrategy;
        private readonly ICrossoverStrategy _crossoverStrategy;
        private readonly IMutationStrategy _mutationStrategy;
        private readonly Population _population;

        public GeneticAlgorithm(ISelectionStrategy selectionStrategy, ICrossoverStrategy crossoverStrategy, IMutationStrategy mutationStrategy, Population population) {
            _selectionStrategy = selectionStrategy;
            _crossoverStrategy = crossoverStrategy;
            _mutationStrategy = mutationStrategy;
            _population = population;
        }

        public void Evolve() {
            // Evolution logic using the selected strategies
            for (int i = 0; i < _population.Individuals.Count; i++) {
                Individual parent1 = _selectionStrategy.Select(_population);
                Individual parent2 = _selectionStrategy.Select(_population);

                // Apply crossover
                Population children = _crossoverStrategy.Crossover(parent1, parent2);

                // Apply mutation
                foreach (var child in children.Individuals) {
                    _mutationStrategy.Mutate(child);
                }

                // Replace old population or add to new population (depending on your algorithm logic)
            }
        }
    }
}
