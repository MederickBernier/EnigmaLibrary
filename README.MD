# Navigation

- [Array Utilities](#array-utilities)
- [Database Utilities](#database-utilities)
- [DateTime Utilities](#datetime-utilities)
- [ErrorManager & ErrorManagerInterface](#errormanager-and-errormanagerinterface)
- [File Utilities](#file-utilities)
- [Http Utilities](#http-utilities)
- [Logger Interface](#loggerinterface)
- [Buffer Logger](#bufferlogger)
- [Console Logger](#consolelogger)
- [Database Logger](#databaselogger)
- [File Logger](#filelogger)
- [Null Logger](#nulllogger)
- [SysLog Logger](#sysloglogger)
- [Security Utilities](#security-utilities)
- [String Utilities](#string-utilities)
- [Validation Utilities](#validation-utilities)

___

# Array Utilities

## Overview

The `ArrayUtils` class provides a collection of static methods for various operations on arrays. These utilities are designed to simplify common tasks such as flattening multidimensional arrays, merging arrays without overwriting values, and more. The class is part of the `EnigmaLibrary\Array` namespace.

## Methods

### 1. `flatten(array $array): array`

Flattens a multidimensional array into a single level.

- **Parameters:**
  - `array $array`: The array to flatten.
- **Returns:**
  - `array`: The flattened array.
- **Example:**
  ```php
  $nestedArray = [[1, 2], [3, [4, 5]]];
  $flattenedArray = ArrayUtils::flatten($nestedArray);
  // Result: [1, 2, 3, 4, 5]
  ```

### 2. `pluck(array $array, string $key): array`

Extracts a column of values from an array of arrays.

- **Parameters:**
  - `array $array`: The array to extract from.
  - `string $key`: The key of the column to extract.
- **Returns:**
  - `array`: An array of values from the specified column.
- **Example:**
  ```php
  $arrayOfArrays = [
      ['name' => 'John', 'age' => 30],
      ['name' => 'Jane', 'age' => 25]
  ];
  $names = ArrayUtils::pluck($arrayOfArrays, 'name');
  // Result: ['John', 'Jane']
  ```

### 3. `mergeRecursiveDistinct(array $array1, array $array2): array`

Recursively merges two arrays without overwriting values.

- **Parameters:**
  - `array $array1`: The first array.
  - `array $array2`: The second array.
- **Returns:**
  - `array`: The merged array.
- **Example:**
  ```php
  $array1 = ['key1' => ['subkey1' => 'value1']];
  $array2 = ['key1' => ['subkey2' => 'value2']];
  $merged = ArrayUtils::mergeRecursiveDistinct($array1, $array2);
  // Result: ['key1' => ['subkey1' => 'value1', 'subkey2' => 'value2']]
  ```

### 4. `arrayIsAssociative(array $array): bool`

Checks if an array is associative (contains non-numeric keys).

- **Parameters:**
  - `array $array`: The array to check.
- **Returns:**
  - `bool`: `true` if the array is associative, `false` otherwise.
- **Example:**
  ```php
  $assocArray = ['key' => 'value'];
  $isAssoc = ArrayUtils::arrayIsAssociative($assocArray);
  // Result: true
  ```

### 5. `arrayPartition(array $array, callable $callback): array`

Partitions an array into two arrays based on a callback function.

- **Parameters:**
  - `array $array`: The array to partition.
  - `callable $callback`: The callback function to determine partitioning.
- **Returns:**
  - `array`: An array with two elements: the first array contains elements that match the predicate, and the second contains the rest.
- **Example:**
  ```php
  $numbers = [1, 2, 3, 4, 5];
  [$even, $odd] = ArrayUtils::arrayPartition($numbers, function($value) {
      return $value % 2 === 0;
  });
  // Result: [$even => [2, 4], $odd => [1, 3, 5]]
  ```

### 6. `arrayReplaceRecursive(array ...$arrays): array`

Replaces elements in an array recursively.

- **Parameters:**
  - `array ...$arrays`: The arrays to replace values in.
- **Returns:**
  - `array`: The array with replaced values.
- **Example:**
  ```php
  $baseArray = ['key1' => 'value1'];
  $replacementArray = ['key1' => 'new_value'];
  $result = ArrayUtils::arrayReplaceRecursive($baseArray, $replacementArray);
  // Result: ['key1' => 'new_value']
  ```

### 7. `arrayShuffle(array $array): array`

Randomly shuffles the elements of an array.

- **Parameters:**
  - `array $array`: The array to shuffle.
- **Returns:**
  - `array`: The shuffled array.
- **Example:**
  ```php
  $numbers = [1, 2, 3, 4, 5];
  $shuffled = ArrayUtils::arrayShuffle($numbers);
  // Result: [4, 1, 5, 2, 3] (example output, actual output will vary)
  ```

### 8. `arraySum(array $array): float`

Sums the elements of an array, supporting multidimensional arrays.

- **Parameters:**
  - `array $array`: The array to sum.
- **Returns:**
  - `float`: The sum of the elements in the array.
- **Example:**
  ```php
  $array = [[1, 2], [3, 4]];
  $sum = ArrayUtils::arraySum($array);
  // Result: 10
  ```

### 9. `arrayWalkRecursiveWithKey(array &$array, callable $callback): void`

Recursively applies a callback to each element of an array, including keys.

- **Parameters:**
  - `array &$array`: The array to walk through.
  - `callable $callback`: The callback function to apply.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $array = ['key1' => 'value1', 'key2' => ['subkey' => 'subvalue']];
  ArrayUtils::arrayWalkRecursiveWithKey($array, function(&$value, $key) {
      $value = strtoupper($value);
  });
  // Result: ['key1' => 'VALUE1', 'key2' => ['subkey' => 'SUBVALUE']]
  ```

# Database Utilities

## Overview

The `DbUtils` class provides a set of utility methods for interacting with databases using PDO (PHP Data Objects). These utilities simplify common database operations, such as connecting to a database, executing queries, and managing transactions. The class is part of the `EnigmaLibrary\Database` namespace.

## Methods

### 1. `connectToDatabase(string $dsn, string $username, string $password): PDO`

Connects to a database using PDO.

- **Parameters:**
  - `string $dsn`: The Data Source Name (DSN) for the database connection.
  - `string $username`: The username for the database connection.
  - `string $password`: The password for the database connection.
- **Returns:**
  - `PDO`: The PDO instance for the database connection.
- **Throws:**
  - `Exception`: If the connection fails.
- **Example:**
  ```php
  $pdo = DbUtils::connectToDatabase('mysql:host=localhost;dbname=testdb', 'user', 'password');
  ```

### 2. `beginTransaction(PDO $pdo): bool`

Begins a transaction.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = DbUtils::beginTransaction($pdo);
  ```

### 3. `commitTransaction(PDO $pdo): bool`

Commits the current transaction.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = DbUtils::commitTransaction($pdo);
  ```

### 4. `rollBackTransaction(PDO $pdo): bool`

Rolls back the current transaction.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = DbUtils::rollBackTransaction($pdo);
  ```

### 5. `executeQuery(PDO $pdo, string $query, array $params = []): bool`

Executes an arbitrary SQL query.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
  - `string $query`: The SQL query to execute.
  - `array $params`: Optional parameters for the query.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = DbUtils::executeQuery($pdo, 'UPDATE users SET name = :name WHERE id = :id', ['name' => 'John Doe', 'id' => 1]);
  ```

### 6. `fetchAll(PDO $pdo, string $sql, array $params = []): array`

Fetches all rows from a query.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
  - `string $sql`: The SQL query to execute.
  - `array $params`: Optional parameters for the query.
- **Returns:**
  - `array`: The fetched rows as an array of associative arrays.
- **Example:**
  ```php
  $rows = DbUtils::fetchAll($pdo, 'SELECT * FROM users WHERE age > :age', ['age' => 18]);
  ```

### 7. `fetchColumn(PDO $pdo, string $sql, array $params = [], int $columnIndex = 0): array`

Fetches a single column from a query.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
  - `string $sql`: The SQL query to execute.
  - `array $params`: Optional parameters for the query.
  - `int $columnIndex`: The index of the column to fetch.
- **Returns:**
  - `array`: The fetched column as an array.
- **Example:**
  ```php
  $names = DbUtils::fetchColumn($pdo, 'SELECT name FROM users', [], 0);
  ```

### 8. `countRows(PDO $pdo, string $table, array $conditions = []): int`

Counts the number of rows in a table with optional conditions.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
  - `string $table`: The name of the table.
  - `array $conditions`: Optional conditions for the query.
- **Returns:**
  - `int`: The number of rows in the table.
- **Example:**
  ```php
  $count = DbUtils::countRows($pdo, 'users', ['status' => 'active']);
  ```

# DateTime Utilities

## Overview

The `DateTimeUtils` class offers a collection of static methods for handling and manipulating date and time operations in PHP. It is designed to simplify common tasks such as formatting dates, calculating differences, and validating dates. The class is part of the `EnigmaLibrary\DateTime` namespace.

## Methods

### 1. `formatDate(\DateTime $date, string $format = 'Y-m-d H:i:s'): string`

Formats a given `DateTime` object into a string.

- **Parameters:**
  - `\DateTime $date`: The `DateTime` object to format.
  - `string $format`: The format to use (default: `'Y-m-d H:i:s'`).
- **Returns:**
  - `string`: The formatted date string.
- **Example:**
  ```php
  $date = new \DateTime();
  $formattedDate = DateTimeUtils::formatDate($date, 'd/m/Y');
  // Result: '21/08/2024' (for example)
  ```

### 2. `dateDifference(\DateTime $date1, \DateTime $date2, string $unit = 'days'): int`

Calculates the difference between two dates.

- **Parameters:**
  - `\DateTime $date1`: The first date.
  - `\DateTime $date2`: The second date.
  - `string $unit`: The unit of time to return (options: `years`, `months`, `days`; default: `days`).
- **Returns:**
  - `int`: The difference between the two dates in the specified unit.
- **Example:**
  ```php
  $date1 = new \DateTime('2024-01-01');
  $date2 = new \DateTime('2024-12-31');
  $difference = DateTimeUtils::dateDifference($date1, $date2, 'months');
  // Result: 12
  ```

### 3. `calculateAge(\DateTime $birthDate): int`

Calculates the age based on a given birth date.

- **Parameters:**
  - `\DateTime $birthDate`: The birth date.
- **Returns:**
  - `int`: The calculated age.
- **Example:**
  ```php
  $birthDate = new \DateTime('1990-05-15');
  $age = DateTimeUtils::calculateAge($birthDate);
  // Result: 34 (for example)
  ```

### 4. `isWeekend(\DateTime $date): bool`

Checks if a given date falls on a weekend.

- **Parameters:**
  - `\DateTime $date`: The date to check.
- **Returns:**
  - `bool`: True if the date is a weekend, false otherwise.
- **Example:**
  ```php
  $date = new \DateTime('2024-08-24');
  $isWeekend = DateTimeUtils::isWeekend($date);
  // Result: true
  ```

### 5. `isLeapYear(int $year): bool`

Checks if a given year is a leap year.

- **Parameters:**
  - `int $year`: The year to check.
- **Returns:**
  - `bool`: True if the year is a leap year, false otherwise.
- **Example:**
  ```php
  $isLeap = DateTimeUtils::isLeapYear(2024);
  // Result: true
  ```

### 6. `addMonths(\DateTime $date, int $months): \DateTime`

Adds a specified number of months to a date.

- **Parameters:**
  - `\DateTime $date`: The date to modify.
  - `int $months`: The number of months to add.
- **Returns:**
  - `\DateTime`: The modified date.
- **Example:**
  ```php
  $date = new \DateTime('2024-01-01');
  $newDate = DateTimeUtils::addMonths($date, 3);
  // Result: '2024-04-01'
  ```

### 7. `subtractMonths(\DateTime $date, int $months): \DateTime`

Subtracts a specified number of months from a date.

- **Parameters:**
  - `\DateTime $date`: The date to modify.
  - `int $months`: The number of months to subtract.
- **Returns:**
  - `\DateTime`: The modified date.
- **Example:**
  ```php
  $date = new \DateTime('2024-01-01');
  $newDate = DateTimeUtils::subtractMonths($date, 2);
  // Result: '2023-11-01'
  ```

### 8. `getStartOfDay(\DateTime $date): \DateTime`

Returns the start of the day (00:00:00) for a given date.

- **Parameters:**
  - `\DateTime $date`: The date to modify.
- **Returns:**
  - `\DateTime`: The start of the day.
- **Example:**
  ```php
  $date = new \DateTime('2024-08-21 15:30:00');
  $startOfDay = DateTimeUtils::getStartOfDay($date);
  // Result: '2024-08-21 00:00:00'
  ```

### 9. `getEndOfDay(\DateTime $date): \DateTime`

Returns the end of the day (23:59:59) for a given date.

- **Parameters:**
  - `\DateTime $date`: The date to modify.
- **Returns:**
  - `\DateTime`: The end of the day.
- **Example:**
  ```php
  $date = new \DateTime('2024-08-21 15:30:00');
  $endOfDay = DateTimeUtils::getEndOfDay($date);
  // Result: '2024-08-21 23:59:59'
  ```

### 10. `isValidDate(string $date, string $format = 'Y-m-d'): bool`

Validates if a string is a valid date.

- **Parameters:**
  - `string $date`: The date string to validate.
  - `string $format`: The format to validate against (default: `'Y-m-d'`).
- **Returns:**
  - `bool`: True if the date is valid, false otherwise.
- **Example:**
  ```php
  $isValid = DateTimeUtils::isValidDate('2024-02-29');
  // Result: true
  ```

### 11. `getDaysInYear(int $year): int`

Returns the number of days in a given year.

- **Parameters:**
  - `int $year`: The year to check.
- **Returns:**
  - `int`: The number of days in the year.
- **Example:**
  ```php
  $daysInYear = DateTimeUtils::getDaysInYear(2024);
  // Result: 366
  ```

### 12. `getTimeDifferenceInMinutes(\DateTime $date1, \DateTime $date2): int`

Calculates the time difference in minutes between two dates.

- **Parameters:**
  - `\DateTime $date1`: The first date.
  - `\DateTime $date2`: The second date.
- **Returns:**
  - `int`: The difference in minutes.
- **Example:**
  ```php
  $date1 = new \DateTime('2024-08-21 12:00:00');
  $date2 = new \DateTime('2024-08-21 14:30:00');
  $minutes = DateTimeUtils::getTimeDifferenceInMinutes($date1, $date2);
  // Result: 150
  ```

# ErrorManager and ErrorManagerInterface

## Overview

The `ErrorManager` class and the `ErrorManagerInterface` interface are part of the `EnigmaLibrary\Error` namespace. They provide a standardized way to handle PHP errors and exceptions, as well as to set global error and exception handlers in a PHP application. The `ErrorManager` class implements the `ErrorManagerInterface` and integrates with a logger to record error and exception details.

## ErrorManagerInterface

The `ErrorManagerInterface` defines the contract for handling errors and exceptions within the library. It specifies the methods that must be implemented by any class that handles errors and exceptions.

### Methods

#### 1. `handleError(int $errno, string $errstr, string $errfile, int $errline): bool`

Handles PHP errors.

- **Parameters:**
  - `int $errno`: The level of the error raised.
  - `string $errstr`: The error message.
  - `string $errfile`: The filename where the error was raised.
  - `int $errline`: The line number where the error was raised.
- **Returns:**
  - `bool`: True if the error was handled, false otherwise.

#### 2. `handleException(\Throwable $exception): void`

Handles uncaught exceptions.

- **Parameters:**
  - `\Throwable $exception`: The uncaught exception.
- **Returns:**
  - `void`

#### 3. `setGlobalHandlers(): void`

Sets the global error and exception handlers.

- **Returns:**
  - `void`

#### 4. `setLogger(\EnigmaLibrary\Logging\LoggerInterface $logger): void`

Sets the logger to be used for logging errors and exceptions.

- **Parameters:**
  - `\EnigmaLibrary\Logging\LoggerInterface $logger`: The logger instance.
- **Returns:**
  - `void`

## ErrorManager

The `ErrorManager` class is an implementation of the `ErrorManagerInterface`. It provides the actual logic for handling PHP errors and exceptions and integrates with a logger to record detailed error and exception information.

### Properties

- **`protected static LoggerInterface $logger`**: The logger instance used for logging errors and exceptions.

### Methods

#### 1. `handleError(int $errno, string $errstr, string $errfile, int $errline): bool`

Handles PHP errors by logging them and preventing PHP's internal error handler from executing.

- **Parameters:**
  - `int $errno`: The level of the error raised.
  - `string $errstr`: The error message.
  - `string $errfile`: The filename where the error was raised.
  - `int $errline`: The line number where the error was raised.
- **Returns:**
  - `bool`: True if the error was handled, false otherwise.
- **Example:**
  ```php
  ErrorManager::handleError(E_WARNING, 'An error occurred', __FILE__, __LINE__);
  ```

#### 2. `handleException(\Throwable $exception): void`

Handles uncaught exceptions by logging the exception details.

- **Parameters:**
  - `\Throwable $exception`: The uncaught exception.
- **Returns:**
  - `void`
- **Example:**
  ```php
  try {
      // Code that may throw an exception
  } catch (\Exception $e) {
      ErrorManager::handleException($e);
  }
  ```

#### 3. `setGlobalHandlers(): void`

Sets the global error and exception handlers to use the `ErrorManager`'s methods.

- **Returns:**
  - `void`
- **Example:**
  ```php
  ErrorManager::setGlobalHandlers();
  ```

#### 4. `setLogger(LoggerInterface $logger): void`

Sets the logger to be used for logging errors and exceptions.

- **Parameters:**
  - `LoggerInterface $logger`: The logger instance.
- **Returns:**
  - `void`
- **Example:**
  ```php
  ErrorManager::setLogger($logger);
  ```

# File Utilities

## Overview

The `FileUtils` class is part of the `EnigmaLibrary\File` namespace and provides a collection of static methods for handling various file operations. These operations include file uploads, downloads, compression, validation, and encoding. The class is designed to simplify common file management tasks in PHP applications.

## Methods

### 1. `uploadFile(array $file, string $destination): bool`

Handles file upload.

- **Parameters:**
  - `array $file`: The file array from `$_FILES`.
  - `string $destination`: The destination path where the file should be saved.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = FileUtils::uploadFile($_FILES['upload'], '/path/to/destination/file.txt');
  ```

### 2. `downloadFile(string $filePath, string $fileName): void`

Downloads a file in a secure manner.

- **Parameters:**
  - `string $filePath`: The path to the file to be downloaded.
  - `string $fileName`: The name of the file as it should appear in the download.
- **Returns:**
  - `void`
- **Example:**
  ```php
  FileUtils::downloadFile('/path/to/file.txt', 'downloaded_file.txt');
  ```

### 3. `validateFileType(string $fileName, array $allowedTypes): bool`

Validates the file type based on its extension.

- **Parameters:**
  - `string $fileName`: The name of the file.
  - `array $allowedTypes`: An array of allowed file types (extensions).
- **Returns:**
  - `bool`: True if the file type is allowed, false otherwise.
- **Example:**
  ```php
  $isValid = FileUtils::validateFileType('document.pdf', ['pdf', 'doc', 'docx']);
  ```

### 4. `readFileContent(string $filePath): string`

Reads the content of a file and returns it as a string.

- **Parameters:**
  - `string $filePath`: The path to the file to read.
- **Returns:**
  - `string`: The content of the file.
- **Throws:**
  - `\Exception`: If the file cannot be read.
- **Example:**
  ```php
  $content = FileUtils::readFileContent('/path/to/file.txt');
  ```

### 5. `writeFileContent(string $filePath, string $content): bool`

Writes a string to a file.

- **Parameters:**
  - `string $filePath`: The path to the file to write.
  - `string $content`: The content to write to the file.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = FileUtils::writeFileContent('/path/to/file.txt', 'This is a test.');
  ```

### 6. `compressFile(string $filePath, string $destination): bool`

Compresses a file using gzip.

- **Parameters:**
  - `string $filePath`: The path to the file to compress.
  - `string $destination`: The destination path for the compressed file.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = FileUtils::compressFile('/path/to/file.txt', '/path/to/file.txt.gz');
  ```

### 7. `decompressFile(string $filePath, string $destination): bool`

Decompresses a gzip file.

- **Parameters:**
  - `string $filePath`: The path to the gzip file to decompress.
  - `string $destination`: The destination path for the decompressed file.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = FileUtils::decompressFile('/path/to/file.txt.gz', '/path/to/decompressed_file.txt');
  ```

### 8. `encodeFileToBase64(string $filePath): string`

Encodes a file to Base64.

- **Parameters:**
  - `string $filePath`: The path to the file.
- **Returns:**
  - `string`: The Base64 encoded content of the file.
- **Throws:**
  - `\Exception`: If the file cannot be read.
- **Example:**
  ```php
  $base64String = FileUtils::encodeFileToBase64('/path/to/file.txt');
  ```

### 9. `decodeBase64ToFile(string $base64String, string $destination): bool`

Decodes a Base64 string and writes it to a file.

- **Parameters:**
  - `string $base64String`: The Base64 encoded string.
  - `string $destination`: The destination path for the decoded file.
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = FileUtils::decodeBase64ToFile($base64String, '/path/to/decoded_file.txt');
  ```

### 10. `getFilePermissions(string $filePath): string`

Gets the file permissions in octal format (e.g., '0755').

- **Parameters:**
  - `string $filePath`: The path to the file.
- **Returns:**
  - `string`: The file permissions in octal format.
- **Example:**
  ```php
  $permissions = FileUtils::getFilePermissions('/path/to/file.txt');
  ```

### 11. `setFilePermissions(string $filePath, string $permissions): bool`

Sets the file permissions.

- **Parameters:**
  - `string $filePath`: The path to the file.
  - `string $permissions`: The permissions to set (e.g., '0755').
- **Returns:**
  - `bool`: True on success, false on failure.
- **Example:**
  ```php
  $success = FileUtils::setFilePermissions('/path/to/file.txt', '0755');
  ```

# Http Utilities

## Overview

The `HttpUtils` class is part of the `EnigmaLibrary\Http` namespace and provides a set of static methods for handling various HTTP-related tasks. These include sending HTTP requests (GET, POST, PUT, DELETE), sending file responses, checking HTTP status codes, and logging HTTP requests and responses.

## Methods

### 1. `sendGetRequest(string $url, array $headers = []): string`

Sends an HTTP GET request.

- **Parameters:**
  - `string $url`: The URL to send the request to.
  - `array $headers`: Optional headers to include in the request.
- **Returns:**
  - `string`: The response content.
- **Throws:**
  - `\Exception`: If the request fails.
- **Example:**
  ```php
  $response = HttpUtils::sendGetRequest('https://api.example.com/data');
  ```

### 2. `sendPostRequest(string $url, array $data, array $headers = []): string`

Sends an HTTP POST request.

- **Parameters:**
  - `string $url`: The URL to send the request to.
  - `array $data`: The data to include in the POST body.
  - `array $headers`: Optional headers to include in the request.
- **Returns:**
  - `string`: The response content.
- **Throws:**
  - `\Exception`: If the request fails.
- **Example:**
  ```php
  $response = HttpUtils::sendPostRequest('https://api.example.com/data', ['key' => 'value']);
  ```

### 3. `sendPutRequest(string $url, array $data, array $headers = []): string`

Sends an HTTP PUT request.

- **Parameters:**
  - `string $url`: The URL to send the request to.
  - `array $data`: The data to include in the PUT body.
  - `array $headers`: Optional headers to include in the request.
- **Returns:**
  - `string`: The response content.
- **Throws:**
  - `\Exception`: If the request fails.
- **Example:**
  ```php
  $response = HttpUtils::sendPutRequest('https://api.example.com/data', ['key' => 'value']);
  ```

### 4. `sendDeleteRequest(string $url, array $headers = []): string`

Sends an HTTP DELETE request.

- **Parameters:**
  - `string $url`: The URL to send the request to.
  - `array $headers`: Optional headers to include in the request.
- **Returns:**
  - `string`: The response content.
- **Throws:**
  - `\Exception`: If the request fails.
- **Example:**
  ```php
  $response = HttpUtils::sendDeleteRequest('https://api.example.com/resource');
  ```

### 5. `sendFileResponse(string $filePath, string $fileName, string $mimeType = 'application/octet-stream'): void`

Sends a file to the client as a download.

- **Parameters:**
  - `string $filePath`: The path to the file to be sent.
  - `string $fileName`: The name of the file as it should appear in the download.
  - `string $mimeType`: The MIME type of the file (default: `'application/octet-stream'`).
- **Returns:**
  - `void`
- **Example:**
  ```php
  HttpUtils::sendFileResponse('/path/to/file.pdf', 'downloaded_file.pdf', 'application/pdf');
  ```

### 6. `isHttpSuccess(int $statusCode): bool`

Checks if an HTTP response is successful (status code 200-299).

- **Parameters:**
  - `int $statusCode`: The HTTP status code.
- **Returns:**
  - `bool`: True if the response is successful, false otherwise.
- **Example:**
  ```php
  $isSuccess = HttpUtils::isHttpSuccess(200);
  ```

### 7. `logHttpRequestResponse(string $method, string $url, array $headers, string $requestBody, string $responseBody, int $statusCode): void`

Logs the details of an HTTP request and response.

- **Parameters:**
  - `string $method`: The HTTP method used (e.g., 'GET', 'POST').
  - `string $url`: The URL of the request.
  - `array $headers`: The headers sent with the request.
  - `string $requestBody`: The body of the request.
  - `string $responseBody`: The body of the response.
  - `int $statusCode`: The HTTP status code of the response.
- **Returns:**
  - `void`
- **Example:**
  ```php
  HttpUtils::logHttpRequestResponse('GET', 'https://api.example.com/data', [], '', '{"key":"value"}', 200);
  ```

# LoggerInterface

## Overview

The `LoggerInterface` is part of the `EnigmaLibrary\Logging` namespace and defines a contract for logging various levels of messages in a PHP application. This interface outlines methods for logging general messages, informational messages, warnings, and errors. Implementations of this interface can provide the actual logging logic, whether it's logging to a file, a database, or an external logging service.

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Logs a message with a specific level.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->log('info', 'This is an informational message.', ['user_id' => 123]);
  ```

### 2. `info(string $message, array $context = []): void`

Logs an informational message.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->info('User logged in.', ['user_id' => 123]);
  ```

### 3. `warning(string $message, array $context = []): void`

Logs a warning message.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->warning('This action is deprecated.', ['action' => 'old_method']);
  ```

### 4. `error(string $message, array $context = []): void`

Logs an error message.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->error('An error occurred while processing the request.', ['error_code' => 500]);
  ```

# BufferLogger

## Overview

The `BufferLogger` class is part of the `EnigmaLibrary\Logging` namespace and implements the `LoggerInterface`. This logger buffers log entries in memory and flushes them to a delegate logger once the buffer reaches a specified size. This can help in scenarios where you want to minimize the number of writes to the log storage, such as when writing to a file or sending logs over a network.

## Properties

- **`protected array $buffer`**: Holds the buffered log entries.
- **`protected int $bufferSize`**: The maximum number of log entries to hold before flushing.
- **`protected LoggerInterface $delegateLogger`**: The logger instance to which the buffered logs will be flushed.

## Constructor

### `__construct(LoggerInterface $delegateLogger, int $bufferSize = 10)`

Initializes the buffer size and the delegate logger.

- **Parameters:**
  - `LoggerInterface $delegateLogger`: The logger to write to when the buffer is flushed.
  - `int $bufferSize`: The maximum number of log entries to hold before flushing (default: 10).
- **Example:**
  ```php
  $fileLogger = new FileLogger('/path/to/logfile.log');
  $bufferLogger = new BufferLogger($fileLogger, 20);
  ```

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Logs a message with a specific level. If the buffer size is reached, the buffer is flushed to the delegate logger.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $bufferLogger->log('info', 'This is a buffered informational message.');
  ```

### 2. `info(string $message, array $context = []): void`

Logs an informational message.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $bufferLogger->info('User logged in.', ['user_id' => 123]);
  ```

### 3. `warning(string $message, array $context = []): void`

Logs a warning message.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $bufferLogger->warning('This action is deprecated.', ['action' => 'old_method']);
  ```

### 4. `error(string $message, array $context = []): void`

Logs an error message.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $bufferLogger->error('An error occurred while processing the request.', ['error_code' => 500]);
  ```

### 5. `flush(): void`

Flushes the log buffer by writing all entries to the delegate logger.

- **Returns:**
  - `void`
- **Example:**
  ```php
  $bufferLogger->flush();
  ```

### Destructor

### `__destruct()`

Ensures that any remaining log entries in the buffer are flushed to the delegate logger when the `BufferLogger` instance is destroyed.

# ConsoleLogger

## Overview

The `ConsoleLogger` class is part of the `EnigmaLibrary\Logging` namespace and implements the `LoggerInterface`. This logger outputs log messages directly to the console (standard output). It is useful for logging in command-line applications or during development to quickly see log entries in real-time.

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Logs a message with a specific level to the console.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->log('info', 'This is an informational message.');
  ```

### 2. `info(string $message, array $context = []): void`

Logs an informational message to the console.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->info('Application started successfully.');
  ```

### 3. `warning(string $message, array $context = []): void`

Logs a warning message to the console.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->warning('This action is deprecated.');
  ```

### 4. `error(string $message, array $context = []): void`

Logs an error message to the console.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->error('An error occurred while processing the request.');
  ```

### Protected Method

### `formatContext(array $context): string`

Formats the context array as a JSON string for inclusion in the log message.

- **Parameters:**
  - `array $context`: The context array to format.
- **Returns:**
  - `string`: The formatted context as a JSON string, or an empty string if the context is empty.

# DatabaseLogger

## Overview

The `DatabaseLogger` class is part of the `EnigmaLibrary\Logging` namespace and implements the `LoggerInterface`. This logger logs messages directly to a database table using a PDO connection. It is useful for persisting logs in a database where they can be queried and analyzed later.

## Properties

- **`protected PDO $pdo`**: The PDO instance used for the database connection.
- **`protected string $tableName`**: The name of the table where logs will be stored.

## Constructor

### `__construct(PDO $pdo, string $tableName = 'logs')`

Initializes the logger with a PDO instance and a table name.

- **Parameters:**
  - `PDO $pdo`: The PDO instance for the database connection.
  - `string $tableName`: The name of the table to log into (default: `'logs'`).
- **Example:**
  ```php
  $pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
  $logger = new DatabaseLogger($pdo, 'application_logs');
  ```

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Logs a message with a specific level to the database.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->log('info', 'User created successfully.', ['user_id' => 123]);
  ```

### 2. `info(string $message, array $context = []): void`

Logs an informational message to the database.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->info('Application started successfully.');
  ```

### 3. `warning(string $message, array $context = []): void`

Logs a warning message to the database.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->warning('Low disk space warning.');
  ```

### 4. `error(string $message, array $context = []): void`

Logs an error message to the database.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->error('An error occurred while processing the request.', ['error_code' => 500]);
  ```

## Database Table Structure

To use the `DatabaseLogger`, ensure your database has a table with the following structure:

```sql
CREATE TABLE `logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `level` VARCHAR(50),
  `message` TEXT,
  `context` TEXT,
  `created_at` DATETIME
);
```

You can customize the table name by passing a different name to the constructor.

# FileLogger

## Overview

The `FileLogger` class is part of the `EnigmaLibrary\Logging` namespace and implements the `LoggerInterface`. This logger logs messages directly to a file specified by the file path provided during initialization. It is useful for persisting logs in a file where they can be reviewed later.

## Properties

- **`protected string $filePath`**: The path to the file where logs will be stored.

## Constructor

### `__construct(string $filePath)`

Initializes the logger with a file path.

- **Parameters:**
  - `string $filePath`: The path to the log file.
- **Example:**
  ```php
  $logger = new FileLogger('/path/to/logfile.log');
  ```

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Logs a message with a specific level to the file.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->log('info', 'User created successfully.', ['user_id' => 123]);
  ```

### 2. `info(string $message, array $context = []): void`

Logs an informational message to the file.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->info('Application started successfully.');
  ```

### 3. `warning(string $message, array $context = []): void`

Logs a warning message to the file.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->warning('Low disk space warning.');
  ```

### 4. `error(string $message, array $context = []): void`

Logs an error message to the file.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->error('An error occurred while processing the request.', ['error_code' => 500]);
  ```

### Protected Method

### `formatContext(array $context): string`

Formats the context array into a JSON string for logging.

- **Parameters:**
  - `array $context`: The context array.
- **Returns:**
  - `string`: The formatted context as a JSON string, or an empty string if the context is empty.

# NullLogger

## Overview

The `NullLogger` class is part of the `EnigmaLibrary\Logging` namespace and implements the `LoggerInterface`. This logger is a no-op (no operation) implementation of the logging interface, meaning it does nothing with the log messages it receives. It is useful when you want to disable logging without having to change the rest of your application code.

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Handles a log message with a specific level, but performs no operation.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->log('info', 'This message will not be logged.');
  ```

### 2. `info(string $message, array $context = []): void`

Handles an informational message, but performs no operation.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->info('This informational message will not be logged.');
  ```

### 3. `warning(string $message, array $context = []): void`

Handles a warning message, but performs no operation.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->warning('This warning message will not be logged.');
  ```

### 4. `error(string $message, array $context = []): void`

Handles an error message, but performs no operation.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->error('This error message will not be logged.');
  ```

# SysLogLogger

## Overview

The `SysLogLogger` class is part of the `EnigmaLibrary\Logging` namespace and implements the `LoggerInterface`. This logger sends log messages to the system logger (`syslog`) on Unix-like systems. It is useful for logging events in a way that can be managed by the system's logging infrastructure.

## Constructor

### `__construct()`

Initializes the logger by opening a connection to `syslog`.

- **Example:**
  ```php
  $logger = new SysLogLogger();
  ```

## Methods

### 1. `log(string $level, string $message, array $context = []): void`

Logs a message with a specific level to `syslog`.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->log('info', 'This is an informational message.');
  ```

### 2. `info(string $message, array $context = []): void`

Logs an informational message to `syslog`.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->info('Application started successfully.');
  ```

### 3. `warning(string $message, array $context = []): void`

Logs a warning message to `syslog`.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->warning('Low disk space warning.');
  ```

### 4. `error(string $message, array $context = []): void`

Logs an error message to `syslog`.

- **Parameters:**
  - `string $message`: The log message.
  - `array $context`: Optional. Additional context for the log entry.
- **Returns:**
  - `void`
- **Example:**
  ```php
  $logger->error('An error occurred while processing the request.');
  ```

### Protected Methods

#### `getSyslogPriority(string $level): int`

Maps log levels to `syslog` priorities.

- **Parameters:**
  - `string $level`: The log level (e.g., `'error'`, `'warning'`, `'info'`).
- **Returns:**
  - `int`: The corresponding `syslog` priority.

#### `formatContext(array $context): string`

Formats the context array as a JSON string for inclusion in the log message.

- **Parameters:**
  - `array $context`: The context array to format.
- **Returns:**
  - `string`: The formatted context as a JSON string, or an empty string if the context is empty.

## Destructor

### `__destruct()`

Closes the connection to `syslog` when the `SysLogLogger` instance is destroyed.

# Security Utilities

## Overview

The `SecurityUtils` class is part of the `EnigmaLibrary\Security` namespace and provides a set of static methods for handling common security-related tasks in PHP. These tasks include password hashing and verification, CSRF token generation and verification, string sanitization, encryption and decryption, and JWT handling.

## Methods

### 1. `hashPassword(string $password): string`

Hashes a password using bcrypt.

- **Parameters:**
  - `string $password`: The password to hash.
- **Returns:**
  - `string`: The hashed password.
- **Example:**
  ```php
  $hashedPassword = SecurityUtils::hashPassword('my_password');
  ```

### 2. `verifyPassword(string $password, string $hash): bool`

Verifies a password against a hashed value.

- **Parameters:**
  - `string $password`: The plain password to verify.
  - `string $hash`: The hashed password to verify against.
- **Returns:**
  - `bool`: True if the password matches the hash, false otherwise.
- **Example:**
  ```php
  $isPasswordValid = SecurityUtils::verifyPassword('my_password', $hashedPassword);
  ```

### 3. `generateCsrfToken(): string`

Generates a CSRF token.

- **Returns:**
  - `string`: The generated CSRF token.
- **Example:**
  ```php
  $csrfToken = SecurityUtils::generateCsrfToken();
  ```

### 4. `verifyCsrfToken(string $token, string $sessionToken): bool`

Verifies a CSRF token against a stored session token.

- **Parameters:**
  - `string $token`: The CSRF token to verify.
  - `string $sessionToken`: The session token to compare against.
- **Returns:**
  - `bool`: True if the tokens match, false otherwise.
- **Example:**
  ```php
  $isValidCsrf = SecurityUtils::verifyCsrfToken($submittedToken, $_SESSION['csrf_token']);
  ```

### 5. `sanitizeString(string $input): string`

Sanitizes a string to prevent XSS attacks.

- **Parameters:**
  - `string $input`: The input string to sanitize.
- **Returns:**
  - `string`: The sanitized string.
- **Example:**
  ```php
  $sanitizedInput = SecurityUtils::sanitizeString($userInput);
  ```

### 6. `encrypt(string $data, string $key): string`

Encrypts a string using a specified encryption algorithm.

- **Parameters:**
  - `string $data`: The data to encrypt.
  - `string $key`: The encryption key.
- **Returns:**
  - `string`: The encrypted data.
- **Example:**
  ```php
  $encryptedData = SecurityUtils::encrypt('my_data', 'encryption_key');
  ```

### 7. `decrypt(string $data, string $key): string`

Decrypts a previously encrypted string.

- **Parameters:**
  - `string $data`: The encrypted data.
  - `string $key`: The encryption key.
- **Returns:**
  - `string`: The decrypted data.
- **Example:**
  ```php
  $decryptedData = SecurityUtils::decrypt($encryptedData, 'encryption_key');
  ```

### 8. `generateJWT(array $payload, string $secret, int $expiration): string`

Generates a JSON Web Token (JWT).

- **Parameters:**
  - `array $payload`: The payload data to include in the token.
  - `string $secret`: The secret key for signing the token.
  - `int $expiration`: The expiration time in seconds.
- **Returns:**
  - `string`: The generated JWT.
- **Example:**
  ```php
  $jwt = SecurityUtils::generateJWT(['user_id' => 123], 'secret_key', 3600);
  ```

### 9. `verifyJWT(string $jwt, string $secret): ?array`

Verifies and decodes a JSON Web Token (JWT).

- **Parameters:**
  - `string $jwt`: The JWT to verify.
  - `string $secret`: The secret key for verifying the JWT.
- **Returns:**
  - `array|null`: The decoded payload if the JWT is valid, null otherwise.
- **Example:**
  ```php
  $payload = SecurityUtils::verifyJWT($jwt, 'secret_key');
  ```

### 10. `generateHMAC(string $data, string $key, string $algo = 'sha256'): string`

Generates a HMAC for a given message.

- **Parameters:**
  - `string $data`: The message to hash.
  - `string $key`: The secret key for generating the HMAC.
  - `string $algo`: The hashing algorithm to use (default is `'sha256'`).
- **Returns:**
  - `string`: The generated HMAC.
- **Example:**
  ```php
  $hmac = SecurityUtils::generateHMAC('message', 'secret_key');
  ```

### 11. `validateHMAC(string $data, string $hmac, string $key, string $algo = 'sha256'): bool`

Validates a given HMAC against the message.

- **Parameters:**
  - `string $data`: The original message.
  - `string $hmac`: The HMAC to validate.
  - `string $key`: The secret key used to generate the HMAC.
  - `string $algo`: The hashing algorithm used (default is `'sha256'`).
- **Returns:**
  - `bool`: True if the HMAC is valid, false otherwise.
- **Example:**
  ```php
  $isValidHMAC = SecurityUtils::validateHMAC('message', $hmac, 'secret_key');
  ```

# String Utilities

## Overview

The `StringUtils` class is part of the `EnigmaLibrary\String` namespace and provides a set of static methods for handling various string manipulation tasks in PHP. These tasks include converting strings to different formats, truncating, generating random strings, checking for palindromes, and more.

## Methods

### 1. `toSlug(string $string): string`

Converts a string to a URL-friendly slug.

- **Parameters:**
  - `string $string`: The string to convert.
- **Returns:**
  - `string`: The slugified string.
- **Example:**
  ```php
  $slug = StringUtils::toSlug('Hello World!');
  // Result: hello-world
  ```

### 2. `toCamelCase(string $string): string`

Converts a string to camelCase.

- **Parameters:**
  - `string $string`: The string to convert.
- **Returns:**
  - `string`: The camelCase string.
- **Example:**
  ```php
  $camelCase = StringUtils::toCamelCase('hello_world');
  // Result: helloWorld
  ```

### 3. `truncate(string $string, int $length, string $suffix = '...'): string`

Truncates a string to a specified length, appending a suffix if necessary.

- **Parameters:**
  - `string $string`: The string to truncate.
  - `int $length`: The maximum length of the string.
  - `string $suffix`: The suffix to append if truncation occurs (default is `'...'`).
- **Returns:**
  - `string`: The truncated string.
- **Example:**
  ```php
  $truncated = StringUtils::truncate('This is a long sentence.', 10);
  // Result: This is a...
  ```

### 4. `randomString(int $length = 16): string`

Generates a random string of a specified length.

- **Parameters:**
  - `int $length`: The length of the random string (default is 16).
- **Returns:**
  - `string`: The generated random string.
- **Example:**
  ```php
  $random = StringUtils::randomString(10);
  // Result: a1b2c3d4e5 (example)
  ```

### 5. `reverse(string $string): string`

Reverses a string.

- **Parameters:**
  - `string $string`: The string to reverse.
- **Returns:**
  - `string`: The reversed string.
- **Example:**
  ```php
  $reversed = StringUtils::reverse('hello');
  // Result: olleh
  ```

### 6. `isPalindrome(string $string): bool`

Checks if a string is a palindrome.

- **Parameters:**
  - `string $string`: The string to check.
- **Returns:**
  - `bool`: True if the string is a palindrome, false otherwise.
- **Example:**
  ```php
  $isPalindrome = StringUtils::isPalindrome('A man a plan a canal Panama');
  // Result: true
  ```

### 7. `extractInitials(string $string): string`

Extracts the initials from a string.

- **Parameters:**
  - `string $string`: The string to extract initials from.
- **Returns:**
  - `string`: The extracted initials.
- **Example:**
  ```php
  $initials = StringUtils::extractInitials('John Doe');
  // Result: JD
  ```

### 8. `removeExtraSpaces(string $string): string`

Removes extra spaces from a string, leaving only single spaces between words.

- **Parameters:**
  - `string $string`: The string to clean.
- **Returns:**
  - `string`: The cleaned string.
- **Example:**
  ```php
  $cleaned = StringUtils::removeExtraSpaces('  Hello   World  ');
  // Result: Hello World
  ```

### 9. `countWords(string $string): int`

Counts the number of words in a string.

- **Parameters:**
  - `string $string`: The string to count words in.
- **Returns:**
  - `int`: The word count.
- **Example:**
  ```php
  $wordCount = StringUtils::countWords('Hello World');
  // Result: 2
  ```

### 10. `maskString(string $string, int $start, int $length, string $mask = '*'): string`

Masks a portion of a string, useful for hiding sensitive information.

- **Parameters:**
  - `string $string`: The string to mask.
  - `int $start`: The starting position of the mask.
  - `int $length`: The number of characters to mask.
  - `string $mask`: The character to use for masking (default is '*').
- **Returns:**
  - `string`: The masked string.
- **Example:**
  ```php
  $masked = StringUtils::maskString('1234567890', 3, 4);
  // Result: 123****890
  ```

# Validation Utilities

## Overview

The `ValidationUtils` class is part of the `EnigmaLibrary\Validation` namespace and provides a set of static methods for performing various common validation tasks in PHP. These tasks include validating email addresses, phone numbers, URLs, IP addresses, and more.

## Methods

### 1. `validateEmail(string $email): bool`

Validates an email address.

- **Parameters:**
  - `string $email`: The email address to validate.
- **Returns:**
  - `bool`: True if the email is valid, false otherwise.
- **Example:**
  ```php
  $isValidEmail = ValidationUtils::validateEmail('example@example.com');
  ```

### 2. `validatePhoneNumber(string $phone): bool`

Validates a phone number (international format).

- **Parameters:**
  - `string $phone`: The phone number to validate.
- **Returns:**
  - `bool`: True if the phone number is valid, false otherwise.
- **Example:**
  ```php
  $isValidPhone = ValidationUtils::validatePhoneNumber('+1234567890');
  ```

### 3. `validateURL(string $url): bool`

Validates a URL.

- **Parameters:**
  - `string $url`: The URL to validate.
- **Returns:**
  - `bool`: True if the URL is valid, false otherwise.
- **Example:**
  ```php
  $isValidURL = ValidationUtils::validateURL('https://www.example.com');
  ```

### 4. `validateIP(string $ip): bool`

Validates an IP address (both IPv4 and IPv6).

- **Parameters:**
  - `string $ip`: The IP address to validate.
- **Returns:**
  - `bool`: True if the IP address is valid, false otherwise.
- **Example:**
  ```php
  $isValidIP = ValidationUtils::validateIP('192.168.1.1');
  ```

### 5. `validateAlpha(string $string): bool`

Validates if a string contains only alphabetic characters.

- **Parameters:**
  - `string $string`: The string to validate.
- **Returns:**
  - `bool`: True if the string contains only alphabetic characters, false otherwise.
- **Example:**
  ```php
  $isAlpha = ValidationUtils::validateAlpha('HelloWorld');
  ```

### 6. `validateAlphanumeric(string $string): bool`

Validates if a string contains only alphanumeric characters.

- **Parameters:**
  - `string $string`: The string to validate.
- **Returns:**
  - `bool`: True if the string contains only alphanumeric characters, false otherwise.
- **Example:**
  ```php
  $isAlphanumeric = ValidationUtils::validateAlphanumeric('Hello123');
  ```

### 7. `validateDate(string $date, string $format = 'Y-m-d'): bool`

Validates a date string against a specified format.

- **Parameters:**
  - `string $date`: The date string to validate.
  - `string $format`: The date format to validate against (default: `'Y-m-d'`).
- **Returns:**
  - `bool`: True if the date is valid, false otherwise.
- **Example:**
  ```php
  $isValidDate = ValidationUtils::validateDate('2024-08-21');
  ```

### 8. `validateIPRange(string $ip, string $range): bool`

Validates if an IP address is within a specified range (CIDR notation).

- **Parameters:**
  - `string $ip`: The IP address to validate.
  - `string $range`: The IP range in CIDR notation (e.g., `192.168.1.0/24`).
- **Returns:**
  - `bool`: True if the IP is within the range, false otherwise.
- **Example:**
  ```php
  $isInRange = ValidationUtils::validateIPRange('192.168.1.5', '192.168.1.0/24');
  ```

### 9. `validateHexColor(string $color): bool`

Validates if a string is a valid hexadecimal color code.

- **Parameters:**
  - `string $color`: The color code to validate.
- **Returns:**
  - `bool`: True if the color code is valid, false otherwise.
- **Example:**
  ```php
  $isValidColor = ValidationUtils::validateHexColor('#ff00ff');
  ```

### 10. `validateTime24Hour(string $time): bool`

Validates if a time string is in 24-hour format.

- **Parameters:**
  - `string $time`: The time string to validate.
- **Returns:**
  - `bool`: True if the time is in 24-hour format, false otherwise.
- **Example:**
  ```php
  $isValidTime = ValidationUtils::validateTime24Hour('14:30');
  ```

### 11. `validateTime12Hour(string $time): bool`

Validates if a time string is in 12-hour format with AM/PM.

- **Parameters:**
  - `string $time`: The time string to validate.
- **Returns:**
  - `bool`: True if the time is in 12-hour format with AM/PM, false otherwise.
- **Example:**
  ```php
  $isValidTime = ValidationUtils::validateTime12Hour('02:30 PM');
  ```

### 12. `validateFileSize(int $fileSize, int $maxSize): bool`

Validates if a file size is within the specified maximum size.

- **Parameters:**
  - `int $fileSize`: The size of the file in bytes.
  - `int $maxSize`: The maximum allowed file size in bytes.
- **Returns:**
  - `bool`: True if the file size is within the limit, false otherwise.
- **Example:**
  ```php
  $isValidSize = ValidationUtils::validateFileSize(500000, 1000000);
  ```
