<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});


echo 'start: '.'\n';
echo date('d/m/Y H:i:s').'\n';
///////////////
///////////////
//$site_address = new \src\crawler\SiteAddress('https://www.lequipe.fr/');
$site_address = new \src\crawler\SiteAddress('http://www.zalinoh.com/');
$crawl = new \src\crawler\Crawler($site_address);
$crawl->run();

///////////////
///////////////
echo 'end in : ' .'\n';
echo date('d/m/Y H:i:s').'\n';
