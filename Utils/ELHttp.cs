namespace EnigmaLibrary.Utils {
    /// <summary>
    /// A utility class providing methods for making HTTP GET and POST requests.
    /// </summary>
    public static class ELHttp {
        // Static HttpClient instance for reusing across multiple requests
        private static readonly HttpClient _client = new HttpClient();

        /// <summary>
        /// Sends an asynchronous HTTP GET request to the specified URL and returns the response content as a string.
        /// </summary>
        /// <param name="url">The URL to send the GET request to.</param>
        /// <returns>A task representing the asynchronous operation, with the response content as a string.</returns>
        public static async Task<string> GetHttpResponse(string url) {
            // Send the GET request
            HttpResponseMessage response = await _client.GetAsync(url);

            // Throw an exception if the response status code indicates failure
            response.EnsureSuccessStatusCode();

            // Read and return the response content as a string
            return await response.Content.ReadAsStringAsync();
        }

        /// <summary>
        /// Sends an asynchronous HTTP POST request to the specified URL with the provided data and returns the response content as a string.
        /// </summary>
        /// <param name="url">The URL to send the POST request to.</param>
        /// <param name="postData">The data to include in the POST request body.</param>
        /// <returns>A task representing the asynchronous operation, with the response content as a string.</returns>
        public static async Task<string> PostHttpRequest(string url, string postData) {
            // Create HttpContent from the provided post data
            HttpContent content = new StringContent(postData);

            // Send the POST request
            HttpResponseMessage response = await _client.PostAsync(url, content);

            // Throw an exception if the response status code indicates failure
            response.EnsureSuccessStatusCode();

            // Read and return the response content as a string
            return await response.Content.ReadAsStringAsync();
        }
    }
}
