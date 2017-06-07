<?php
$routes = [
    'metadata',
    'getForecastRequest',
    'getTimeMachineRequest'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

