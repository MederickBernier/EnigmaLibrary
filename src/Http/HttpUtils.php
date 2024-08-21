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
     * Formats a response in the specified format (JSON, XML, etc.).
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
     * Builds a query string from an array of parameters.
     * 
     * @param array $params The parameters to include in the query string.
     * @return string The query string.
     */
    public static function buildQueryString(array $params): string
    {
        return http_build_query($params);
    }

    /**
     * Parses a URL and returns its components.
     * 
     * @param string $url The URL to parse.
     * @return array The parsed components of the URL.
     */
    public static function parseUrl(string $url): array
    {
        return parse_url($url);
    }

    /**
     * Sets multiple HTTP headers.
     * 
     * @param array $headers An array of headers to set.
     * @return void
     */
    public static function setHttpHeaders(array $headers): void
    {
        foreach ($headers as $header) {
            header($header);
        }
    }

    /**
     * Returns the message corresponding to an HTTP status code.
     * 
     * @param int $statusCode The HTTP status code.
     * @return string The message associated with the status code.
     */
    public static function getHttpStatusMessage(int $statusCode): string
    {
        $statusMessages = [
            200 => 'OK',
            201 => 'Created',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            // Add more status codes and messages as needed
        ];
        return $statusMessages[$statusCode] ?? 'Unknown Status';
    }

    /**
     * Sends a JSON response.
     * 
     * @param array $data The data to include in the JSON response.
     * @param int $statusCode The HTTP status code (default is 200).
     * @return void
     */
    public static function sendJsonResponse(array $data, int $statusCode = 200): void
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }

    /**
     * Retrieves a specific query parameter from the URL.
     * 
     * @param string $name The name of the query parameter.
     * @param string|null $default The default value if the parameter is not found.
     * @return string|null The value of the query parameter or the default value.
     */
    public static function getQueryParam(string $name, ?string $default = null): ?string
    {
        return $_GET[$name] ?? $default;
    }

    /**
     * Retrieves a specific POST parameter.
     * 
     * @param string $name The name of the POST parameter.
     * @param string|null $default The default value if the parameter is not found.
     * @return string|null The value of the POST parameter or the default value.
     */
    public static function getPostParam(string $name, ?string $default = null): ?string
    {
        return $_POST[$name] ?? $default;
    }

    /**
     * Redirects to a URL with a flash message.
     * 
     * @param string $url The URL to redirect to.
     * @param string $message The flash message to set.
     * @param string $type The type of message (e.g., 'info', 'success', 'error').
     * @return void
     */
    public static function redirectWithMessage(string $url, string $message, string $type = 'info'): void
    {
        $_SESSION['flash_message'] = ['type' => $type, 'message' => $message];
        header("Location: {$url}");
        exit();
    }

    /**
     * Retrieves and removes a flash message from the session.
     * 
     * @return array|null The flash message data or null if not set.
     */
    public static function getFlashMessage(): ?array
    {
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
            return $message;
        }
        return null;
    }

    /**
     * Checks if the current HTTP request method matches the specified method.
     * 
     * @param string $method The HTTP method to check (e.g., 'GET', 'POST').
     * @return bool True if the request method matches, false otherwise.
     */
    public static function isMethod(string $method): bool
    {
        return strtoupper($_SERVER['REQUEST_METHOD']) === strtoupper($method);
    }

    /**
     * Sends an HTML response.
     * 
     * @param string $html The HTML content to send.
     * @param int $statusCode The HTTP status code (default is 200).
     * @return void
     */
    public static function sendHtmlResponse(string $html, int $statusCode = 200): void
    {
        header('Content-Type: text/html');
        http_response_code($statusCode);
        echo $html;
        exit();
    }

    /**
     * Retrieves the current URL of the request.
     * 
     * @return string The current URL.
     */
    public static function getCurrentUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domain = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        return $protocol . $domain . $requestUri;
    }

    /**
     * Sends a file as a response to an HTTP request.
     * 
     * @param string $filePath The path to the file to send.
     * @param string $fileName The name of the file as it should appear in the download.
     * @param string $mimeType The MIME type of the file (default is 'application/octet-stream').
     * @return void
     */
    public static function sendFileResponse(string $filePath, string $fileName, string $mimeType = 'application/octet-stream'): void
    {
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $mimeType);
            header('Content-Disposition: attachment; filename=' . basename($fileName));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            flush();
            readfile($filePath);
            exit();
        }
    }
}