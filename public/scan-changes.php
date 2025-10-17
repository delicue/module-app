<?php
// scan-changes.php
// Returns a hash representing the current state of all files in the application directory

$dir = __DIR__ . '/../';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$hashes = [];

foreach ($iterator as $file) {
    if ($file->isFile()) {
        $hashes[] = $file->getMTime() . $file->getSize() . $file->getPathname();
    }
}

// Create a single hash for all files
echo md5(implode('', $hashes));
