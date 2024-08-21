<?php

namespace EnigmaLibrary\Http;

class HttpUtils
{
    /**
     * Sends an HTTP GET request.
     * 
     * @param string $url The URL to send the request to.
     * @param array $headers Optional headers to include in the request.
     * @return string The response content.
     * @throws \Exception if the request fails.
     */
    public static function sendGetRequest(string $url, array $headers = []): string
    {
        $options = [
            'http' => [
                'header' => $headers,
                'method' => 'GET'
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        if ($response === false) {
            throw new \Exception("GET request to {$url} failed.");
        }
        return $response;
    }

    /**
     * Sends an HTTP POST request.
     *
     * @param string $url The URL to send the request to.
     * @param array $data The data to include in the POST body.
     * @param array $headers Optional headers to include in the request.
     * @return string The response content.
     * @throws \Exception if the request fails.
     */
    public static function sendPostRequest(string $url, array $data, array $headers = []): string
    {
        $options = [
            'http' => [
                'header' => array_merge(['Content-type: application/x-www-form-urlencoded'], $headers),
                'method' => 'POST',
                'content' => http_build_query($data),
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new \Exception("POST request to {$url} failed.");
        }
        return $response;
    }

    /**
     * Formats a response in the specified format (JSON, XML, etc.)
     * 
     * @param mixed $data The data to format.
     * @param string $format The format to use (default is 'json').
     * @return string The formatted response.
     * @throws \Exception if the format is not supported.
     */
    public static function formatResponse($data, string $format = 'json'): string
    {
        switch ($format) {
            case 'json':
                header('Content-Type: application/json');
                return json_encode($data);
            case 'xml':
                header('Content-Type: text/xml');
                return self::toXml($data);
            default:
                throw new \Exception("Format {$format} not supported.");
        }
    }

    /**
     * Converts an array to XML format.
     * 
     * @param mixed $data The data to convert.
     * @param string $rootNodeName The root node name for the XML (default is 'data').
     * @param \SimpleXMLElement|null $xml The SimpleXMLElement object for recursion.
     * @return string The XML formatted string.
     */
    public static function toXml($data, $rootNodeName = 'data', $xml = null): string
    {
        if ($xml === null) {
            $xml = new \SimpleXMLElement("<{$rootNodeName}/>");
        }
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                self::toXml($value, $key, $xml->addChild($key));
            } else {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
        return $xml->asXml();
    }

    /**
     * Handles HTTP redirects.
     * 
     * @param string $url The URL to redirect to.
     * @param int $statusCode The HTTP status code for the redirect (default is 302).
     * @return void
     */
    public static function redirect(string $url, int $statusCode = 302): void
    {
        header("Location: {$url}", true, $statusCode);
        exit();
    }

    /**
     * Sends an HTTP PUT request.
     * 
     * @param string $url The URL to send the request to.
     * @param array $data The data to include in the PUT body.
     * @param array $headers Optional headers to include in the request.
     * @return string The response content.
     * @throws \Exception if the request fails.
     */
    public static function sendPutRequest(string $url, array $data, array $headers = []): string
    {
        $options = [
            'http' => [
                'header'  => array_merge(['Content-type: application/x-www-form-urlencoded'], $headers),
                'method'  => 'PUT',
                'content' => http_build_query($data),
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new \Exception("PUT request to {$url} failed.");
        }

        return $response;
    }

    /**
     * Sends an HTTP DELETE request.
     * 
     * @param string $url The URL to send the request to.
     * @param array $headers Optional headers to include in the request.
     * @return string The response content.
     * @throws \Exception if the request fails.
     */
    public static function sendDeleteRequest(string $url, array $headers = []): string
    {
        $options = [
            'http' => [
                'header' => $headers,
                'method' => 'DELETE',
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            throw new \Exception("DELETE request to {$url} failed.");
        }

        return $response;
    }

    /**
     * Builds a query string from an array of parameters.
     * 
     * @param array $params The parameters to include in the query string.
     * @return string The query string.
     */
    public static function buildQueryString(array $params): string
    {
        return http_build_query($params);
    }
}