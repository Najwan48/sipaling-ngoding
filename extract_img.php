<?php
$html = file_get_contents('https://id.pinterest.com/pin/412712753361390071/');
preg_match_all('/https:\/\/i\.pinimg\.com\/[^"]+\.(jpg|jpeg|png|webp)/', $html, $matches);
$unique = array_unique($matches[0]);
foreach ($unique as $url) {
    echo $url . PHP_EOL;
}
