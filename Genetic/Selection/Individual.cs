namespace EnigmaLibrary.Genetic.Selection;
public class Individual {
    public double Fitness { get; set; }
    public double[] Genes { get; set; }
    public Individual(int geneLength) {
        Genes = new double[geneLength];
        Fitness = 0;
    }
}
