<?php
$html = file_get_contents('https://id.pinterest.com/pin/617837642703924046/');
preg_match_all('/https:\/\/[^"]+\.mp4/', $html, $matches);
print_r(array_unique($matches[0]));
