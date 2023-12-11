<?php
function autoload(string $classname) {
    $fileName = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';
    if (is_file($fileName)) {
        return require($fileName);
    }

    throw new Exception('No file' . $fileName);
}

spl_autoload_register('autoload');