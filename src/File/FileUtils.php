<?php

namespace EnigmaLibrary\File;

class FileUtils{
    /**
     * Handles file upload
     * 
     * @param array $file The file array from $_FILES.
     * @param string $destination The destination path where the file should be saved.
     * @return bool True on success, false on failure.
     */
    public static function uploadFile(array $file, string $destination):bool{
        return move_uploaded_file($file['tmp_name'], $destination);
    }

    /**
     * Downloads a file in a secure manner.
     * 
     * @param string $filePath The path to the file to be downloaded.
     * @param string $fileName The name of the file as it should appear in the download.
     * @return void
     */
    public static function downloadFile(string $filePath, string $fileName):void{
        if(file_exists($filePath)){
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($fileName));
            header('Expires:0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length:'.filesize($filePath));
            flush();
            readfile($filePath);
            exit;
        }
    }

    /**
     * Validates the file type and MIME
     * 
     * @param string $fileName The name of the file.
     * @param array $allowedTypes An array of allowed file types (extensions).
     * @return bool True if the type is allowed, false otherwise.
     */
    public static function validateFileType(string $fileName, array $allowedTypes):bool{
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        return in_array($fileType, $allowedTypes);
    }

    /**
     * Reads the content of a file and returns it as a string.
     * 
     * @param string $filePath The path to the file to read.
     * @return string The content of the file.
     * @throws \Exception if the file cannot be read.
     */
    public static function readFileContent(string $filePath):string{
        if(!file_exists($filePath) || !is_readable($filePath)){
            throw new \Exception("File not found or not readable: {$filePath}");
        }
        return file_get_contents($filePath);
    }

    /**
     * Writes content to a file
     * 
     * @param string $filePath The path to the file to write to.
     * @param string $content The content to write to the file.
     * @param bool $append Whether to append to the file (default is false, which overwrites the file).
     * @return bool True on success, false on failure.
     */
    public static function writeFileContent(string $filePath, string $content, bool $append = false){
        $flags = $append ? FILE_APPEND:0;
        return file_put_contents($filePath, $content, $flags) !== false;
    }

    /**
     * Deletes a file.
     * 
     * @param string $filePath The path to the file to delete.
     * @return bool True on success, false on failure.
     */
    public static function deleteFile(string $filePath):bool{
        if(file_exists($filePath)){
            return unlink($filePath);
        }
        return false;
    }
}