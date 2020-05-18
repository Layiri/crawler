<?php

namespace crawler;


use DOMDocument;

class Crawler
{
    public $site_address;
    public $depth = 1;
    private $page_url;
    private $quantity_tag;
    private $page_processing_time;
    private $sort_quantity_tag;

    public function __construct()
    {
    }

//    private function getAllPagesFromSite($url, $depth, &$counter, $check)
    private function getAllPagesFromSite($url, $depth)
    {
        static $seen = array();
        static $arr = array();
        if (isset($seen[$url]) || $depth === 0) {
            return;
        }


        $seen[$url] = true;
        $arr [] = $url;
        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile($url);

        $anchors = $dom->getElementsByTagName('a');
        foreach ($anchors as $element) {
            $href = $element->getAttribute('href');
            $host = "http://" . parse_url($url, PHP_URL_HOST);

            if (0 !== strpos($href, 'http')) {
                /* this is where I changed hobodave's code */
                $href = $host . '/' . ltrim($href, '/');
            } else {
                $hostHref = "http://" . parse_url($href, PHP_URL_HOST);
                if ($host != $hostHref) {
                    continue;
                }
            }
            $arr[] = $href;
            $this->getAllPagesFromSite($href, $depth - 1);
        }

        return $arr;
    }

    private function getPage($url)
    {
        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile($url);
        $anchors = $dom->getElementsByTagName('img');


    }

    private function getTag()
    {

    }

    public function run()
    {
        $all_pages = array_unique($this->getAllPagesFromSite($this->site_address, 1));
        var_dump($all_pages);
    }
}