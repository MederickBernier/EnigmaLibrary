using System.Net;
using System.Net.Sockets;

namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for retrieving network-related information.
    /// </summary>
    public static class ELNetwork {
        /// <summary>
        /// Gets the local IP address of the machine.
        /// </summary>
        /// <returns>A string representing the local IP address, or "Local IP Address Not Found" if not found.</returns>
        public static string GetLocalIpAddress() {
            // Get the host entry for the current machine
            var host = Dns.GetHostEntry(Dns.GetHostName());

            // Iterate through the address list to find an IPv4 address
            foreach (var ip in host.AddressList) {
                if (ip.AddressFamily == AddressFamily.InterNetwork) {
                    // Return the first IPv4 address found
                    return ip.ToString();
                }
            }

            // Return a default message if no IPv4 address is found
            return "Local IP Address Not Found";
        }

        /// <summary>
        /// Gets the public IP address of the machine asynchronously.
        /// </summary>
        /// <returns>A task representing the asynchronous operation, with the public IP address as a string.</returns>
        public static async Task<string> GetPublicIpAddressAsync() {
            // Create a new HttpClient instance
            using (HttpClient httpClient = new HttpClient()) {
                // Send a GET request to the ipify API to retrieve the public IP address
                return await httpClient.GetStringAsync("https://api.ipify.org");
            }
        }
    }
}
