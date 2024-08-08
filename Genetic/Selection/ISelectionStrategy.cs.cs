namespace EnigmaLibrary.Genetic.Selection;
public interface ISelectionStrategy {
    Individual Select(Population population);
}
