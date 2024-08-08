namespace EnigmaLibrary.Genetic.Selection.RouletteWheelSelection;
public class RouletteWheelSelection : ISelectionStrategy {
    private readonly Random _random;

    public RouletteWheelSelection() {
        _random = new Random();
    }

    public Individual Select(Population population) {
        double totalFitness = population.Individuals.Sum(ind => ind.Fitness);
        double randomValue = _random.NextDouble() * totalFitness;
        double cumulativeFitness = 0;

        foreach (var individual in population.Individuals) {
            cumulativeFitness += individual.Fitness;
            if (cumulativeFitness >= randomValue) {
                return individual;
            }
        }
        return population.Individuals.Last();
    }
}
