<?php
/*
function libraryOne($classname) {
    $file = __DIR__ . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';
    if (file_exists($file)) {
        require_once($file);
    }
}
// регистрация
spl_autoload_register('libraryOne');
*/

function autoload(string $classname) {
    $fileName = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';
    if (is_file($fileName)) {
        return require_once($fileName);
    }

    throw new Exception('No file' . $fileName);
}

spl_autoload_register('autoload');
