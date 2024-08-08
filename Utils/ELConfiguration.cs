using Microsoft.Extensions.Configuration;
using Newtonsoft.Json.Linq;
namespace EnigmaLibrary.Utils;
public static class ELConfiguration {
    public static void SetAppSetting(string key, string value) {
        var json = File.ReadAllText("appsettings.json");
        var jsonObj = JObject.Parse(json);
        var sectionPath = key.Split(":")[0];
        var setting = jsonObj.SelectToken(sectionPath) as JObject;
        if (setting != null) {
            setting[key.Split(":")[1]] = value;
        } else // In case you want to add a new key
          {
            jsonObj[key] = value;
        }

        File.WriteAllText("appsettings.json", jsonObj.ToString());
    }

    public static string GetAppSetting(string key) {
        var configuration = new ConfigurationBuilder()
            .SetBasePath(Directory.GetCurrentDirectory())
            .AddJsonFile("appsettings.json")
            .Build();

        return configuration[key];
    }

    public static string GetConnectionString(string name) {
        var configuration = new ConfigurationBuilder()
            .SetBasePath(Directory.GetCurrentDirectory())
            .AddJsonFile("appsettings.json")
            .Build();

        return configuration.GetConnectionString(name);
    }
}
