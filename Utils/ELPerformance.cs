using System.Diagnostics;

namespace EnigmaLibrary.Utils;
public static class ELPerformance {
    public static TimeSpan MeasureExecutionTime(Action action) {
        Stopwatch stopwatch = Stopwatch.StartNew();
        action.Invoke();
        stopwatch.Stop();
        return stopwatch.Elapsed;
    }

    public static long GetMemoryUsage() {
        return Process.GetCurrentProcess().WorkingSet64;
    }

    public static float GetCpuUsage() {
        using (PerformanceCounter cpuCounter = new PerformanceCounter("Processor", "% Processor Time", "_Total")) {
            cpuCounter.NextValue();
            System.Threading.Thread.Sleep(1000);
            return cpuCounter.NextValue();
        }
    }

}
