namespace EnigmaLibrary.Genetic.Selection.TournamentSelection;
public class TournamentSelection : ISelectionStrategy {
    private readonly Random _random;
    private readonly int _tournamentSize;

    public TournamentSelection(int tournamentSize) {
        _random = new Random();
        _tournamentSize = tournamentSize;
    }
    public Individual Select(Population population) {
        var tournament = new List<Individual>();
        for (int i = 0; i < _tournamentSize; i++) {
            int randomIndex = _random.Next(population.Individuals.Count);
            tournament.Add(population.Individuals[randomIndex]);
        }
        return tournament.OrderByDescending(ind => ind.Fitness).First();
    }
}
