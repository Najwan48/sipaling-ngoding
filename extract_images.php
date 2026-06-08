<?php
$urls = [
    'Absensi Karyawan' => 'https://id.pinterest.com/pin/412712753361390071/',
    'Backend Uacademy' => 'https://id.pinterest.com/pin/407646203793646432/',
    'Monalisa Resto' => 'https://id.pinterest.com/pin/14355292556870170/'
];

foreach ($urls as $name => $url) {
    $html = file_get_contents($url);
    if (preg_match('/"imageLargeUrl":"([^"]+)"/', $html, $matches)) {
        echo $name . " -> " . stripslashes($matches[1]) . "\n";
    } elseif (preg_match('/https:\/\/i\.pinimg\.com\/736x\/[^"]+\.(jpg|jpeg|png|webp)/', $html, $matches)) {
        echo $name . " -> " . $matches[0] . "\n";
    } else {
        echo $name . " -> Not found\n";
    }
}
