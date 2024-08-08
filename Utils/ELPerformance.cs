using System.Diagnostics;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for measuring performance, such as execution time, memory usage, and CPU usage.
    /// </summary>
    public static class ELPerformance {
        /// <summary>
        /// Measures the execution time of a given action.
        /// </summary>
        /// <param name="action">The action to measure the execution time of.</param>
        /// <returns>A TimeSpan representing the elapsed time of the action's execution.</returns>
        public static TimeSpan MeasureExecutionTime(Action action) {
            // Start a stopwatch to measure the execution time
            Stopwatch stopwatch = Stopwatch.StartNew();

            // Invoke the provided action
            action.Invoke();

            // Stop the stopwatch and return the elapsed time
            stopwatch.Stop();
            return stopwatch.Elapsed;
        }

        /// <summary>
        /// Gets the memory usage of the current process in bytes.
        /// </summary>
        /// <returns>A long representing the amount of memory used by the current process in bytes.</returns>
        public static long GetMemoryUsage() {
            // Return the current process's memory usage in bytes
            return Process.GetCurrentProcess().WorkingSet64;
        }

        /// <summary>
        /// Gets the CPU usage percentage of the current system.
        /// </summary>
        /// <returns>A float representing the total CPU usage percentage.</returns>
        public static float GetCpuUsage() {
            // Create a PerformanceCounter to monitor the total CPU usage
            using (PerformanceCounter cpuCounter = new PerformanceCounter("Processor", "% Processor Time", "_Total")) {
                // Retrieve the initial value to set up the counter
                cpuCounter.NextValue();

                // Wait for one second to allow the counter to update with the actual CPU usage
                System.Threading.Thread.Sleep(1000);

                // Return the CPU usage percentage
                return cpuCounter.NextValue();
            }
        }
    }
}
