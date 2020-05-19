<?php


use src\crawler\Crawler;
use src\crawler\SiteAddress;

spl_autoload_register(function ($class_name) {
    include __DIR__ . '/' . $class_name . '.php';
});

echo 'start time: ' . '\n';
echo date('d/m/Y H:i:s') . '\n';
///////////////
///////////////

$url = "";
if (php_sapi_name() == "cli") {
    $readLine = readline("Please enter site address: ");
    $url = $readLine;
} else {
    if (isset($_GET['site'])) {
        $url = $_GET['site'];
    }
}

$site_address = new SiteAddress(SiteAddress::sanitizeURL($url));

$crawl = new Crawler($site_address);
$crawl->run();

///////////////
///////////////
echo 'end time : ' . '\n';
echo date('d/m/Y H:i:s') . '\n';
