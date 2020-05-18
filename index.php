<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '5000');
ini_set('xdebug.var_display_max_data', '5000');

echo 'start';
////////////////
///////////////

//develop

$crawl = new \crawler\Crawler();
$crawl->site_address = 'https://www.lequipe.fr/';
$crawl->run();

///////////////
///////////////
echo 'end';