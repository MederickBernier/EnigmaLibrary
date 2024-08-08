namespace EnigmaLibrary.Utils;
public static class ELHttp {
    private static readonly HttpClient _client = new HttpClient();

    public static async Task<string> GetHttpResponse(string url) {
        HttpResponseMessage response = await _client.GetAsync(url);
        response.EnsureSuccessStatusCode();
        return await response.Content.ReadAsStringAsync();
    }

    public static async Task<string> PostHttpRequest(string url, string postData) {
        HttpContent content = new StringContent(postData);
        HttpResponseMessage response = await _client.PostAsync(url, content);
        response.EnsureSuccessStatusCode();
        return await response.Content.ReadAsStringAsync();
    }
}
