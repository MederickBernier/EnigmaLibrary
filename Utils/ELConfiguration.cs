using Microsoft.Extensions.Configuration;
using Newtonsoft.Json.Linq;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for interacting with configuration settings stored in an appsettings.json file.
    /// Includes methods for setting, getting, and retrieving connection strings.
    /// </summary>
    public static class ELConfiguration {
        /// <summary>
        /// Updates or adds a key-value pair in the appsettings.json file.
        /// </summary>
        /// <param name="key">The configuration key to set, in the format "Section:SubSection" for nested settings.</param>
        /// <param name="value">The value to associate with the key.</param>
        public static void SetAppSetting(string key, string value) {
            // Read the content of appsettings.json into a string
            var json = File.ReadAllText("appsettings.json");

            // Parse the JSON string into a JObject for manipulation
            var jsonObj = JObject.Parse(json);

            // Extract the section path from the key (e.g., "Logging:LogLevel" -> "Logging")
            var sectionPath = key.Split(":")[0];

            // Attempt to select the section as a JObject, to allow for nested settings manipulation
            var setting = jsonObj.SelectToken(sectionPath) as JObject;

            if (setting != null) {
                // If the section exists, set the value for the specific key within that section
                setting[key.Split(":")[1]] = value;
            } else {
                // If the section does not exist, add a new key-value pair to the root of the JSON object
                jsonObj[key] = value;
            }

            // Write the updated JSON back to the appsettings.json file
            File.WriteAllText("appsettings.json", jsonObj.ToString());
        }

        /// <summary>
        /// Retrieves a configuration value from the appsettings.json file based on the specified key.
        /// </summary>
        /// <param name="key">The key to search for in the configuration file.</param>
        /// <returns>The value associated with the specified key, or null if the key does not exist.</returns>
        public static string GetAppSetting(string key) {
            // Build the configuration object by loading the appsettings.json file
            var configuration = new ConfigurationBuilder()
                .SetBasePath(Directory.GetCurrentDirectory())
                .AddJsonFile("appsettings.json")
                .Build();

            // Retrieve the value associated with the specified key
            return configuration[key];
        }

        /// <summary>
        /// Retrieves a connection string from the appsettings.json file based on the specified name.
        /// </summary>
        /// <param name="name">The name of the connection string to retrieve.</param>
        /// <returns>The connection string associated with the specified name, or null if the name does not exist.</returns>
        public static string GetConnectionString(string name) {
            // Build the configuration object by loading the appsettings.json file
            var configuration = new ConfigurationBuilder()
                .SetBasePath(Directory.GetCurrentDirectory())
                .AddJsonFile("appsettings.json")
                .Build();

            // Retrieve the connection string associated with the specified name
            return configuration.GetConnectionString(name);
        }
    }
}
