<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/users/Najwan48/repos');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Awesome-Octocat-App');
$output = curl_exec($ch);
curl_close($ch);
$data = json_decode($output, true);
foreach($data as $repo) {
    echo $repo['name'] . ' - ' . ($repo['language'] ?? 'Unknown') . ' - ' . $repo['html_url'] . PHP_EOL;
}
