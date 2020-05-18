<?php

ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '5000');
ini_set('xdebug.var_display_max_data', '5000');

ini_set('max_execution_time', '1200');
echo 'start' . '<br />';

$counter = 0;
$check = [];

function crawl_page($url, $depth = 3, &$counter,&$check)
{
    $counter++;
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;
//    var_dump($seen);

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);

    $anchors = $dom->getElementsByTagName('a');
    foreach ($anchors as $element) {
        $href = $element->getAttribute('href');
        if (0 !== strpos($href, 'http')) {
            /* this is where I changed hobodave's code */
            $host = "http://" . parse_url($url, PHP_URL_HOST);
            $href = $host . '/' . ltrim($href, '/');
        }

        $check[] = $url;
        $check[] = $href;
//        echo 'Page: ' . $counter . '<br />';
//        echo "New Page:<br /> ";

//        var_dump($url);
//        var_dump($href);
//
        crawl_page($href, $depth - 1, $counter,$check);
    }

//    echo 'Page: ' . $counter . '<br />';
//    echo "New Page:<br /> ";
//    echo "URL:",$url,PHP_EOL,"<br />","CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL,"  <br /><br />";


//    var_dump($url);

            echo 'Page: ' . $counter . '<br />';

}

crawl_page("http://lequipe.fr/", 5, $counter, $check);


//var_dump($check);
var_dump(array_unique($check));
echo "Total page: " . $counter . "<br />";
echo 'end' . '<br />';
echo $counter;