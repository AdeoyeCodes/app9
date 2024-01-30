<?php

function getIpInfo() {
    // Simulate Nigeria's information
    return [
        'ip' => 'N/A',  // You can set the IP address to a default value or leave it as 'N/A'.
        'country' => 'Nigeria',
        'loc' => '9.0820,8.6753',  // Latitude and Longitude for Nigeria.
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ipInfo = getIpInfo();

    $result = [
        'ip' => $ipInfo['ip'] ?? '',
        'country' => $ipInfo['country'] ?? '',
        'latitude' => $ipInfo['loc'] ? explode(',', $ipInfo['loc'])[0] : '',
        'longitude' => $ipInfo['loc'] ? explode(',', $ipInfo['loc'])[1] : '',
    ];

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>
