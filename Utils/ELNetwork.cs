using System.Net;
using System.Net.Sockets;

namespace EnigmaLibrary.Utils;
public static class ELNetwork {
    public static string GetLocalIpAddress() {
        var host = Dns.GetHostEntry(Dns.GetHostName());
        foreach (var ip in host.AddressList) {
            if (ip.AddressFamily == AddressFamily.InterNetwork) {
                return ip.ToString();
            }
        }
        return "Local IP Address Not Found";
    }

    public static async Task<string> GetPublicIpAddressAsync() {
        using (HttpClient httpClient = new HttpClient()) {
            return await httpClient.GetStringAsync("https://api.ipify.org");
        }
    }
}
