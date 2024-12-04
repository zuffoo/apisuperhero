<?php
if(isset($_GET['action'])) {
    $action = $_GET['action'];

    $api_key = '6d0644bebf90a57c691ca46b3f5cace8';
    $base_url = 'https://superheroapi.com/api/' . $api_key;

    if ($action == 'fetch_all') {
        $url = $base_url . '/search/a'; 
        $response = file_get_contents($url);
        echo $response;
    } elseif ($action == 'search_hero' && isset($_GET['name'])) {
        $name = urlencode($_GET['name']);
        $url = $base_url . '/search/' . $name;
        $response = file_get_contents($url);
        echo $response;
    }
}
?>
