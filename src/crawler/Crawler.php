<?php

namespace src\crawler;


use DOMDocument;
use src\helpers\HtmlHelpers;
use src\helpers\SaveFileHelpers;

/**
 * Class Crawler
 * @package src\crawler
 * @access public
 * @author Layiri Batiene <eratos02@yahoo.fr>
 */
class Crawler implements ICrawler
{
    /**
     * @var SiteAddress $site_address The site address
     */
    private $site_address;

    public function __construct(SiteAddress $site_address)
    {
        $this->site_address = $site_address;
    }

    /**
     * This function is used to retrieve all the pages of a site
     * @param string $url $site url
     * @param int $depth Depth of access to page links
     * @return array
     */
    public function getAllPagesFromSite($url, $depth = 5)
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

    /**
     * This function is used to count a tag given on a site
     *
     * @param string $url
     * @param string $tagName
     * @return mixed
     */
    public function countTagFromPage($url, $tagName)
    {
        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile($url);
        $anchors = $dom->getElementsByTagName($tagName);
        return count($anchors);
    }


    /**
     * This function is used to run a script.
     *
     * @return void
     */
    public function run()
    {
        $all_pages = array_unique($this->getAllPagesFromSite(trim($this->site_address),5));

        $array_pages_tag = [];
        $i = 0;
        foreach ($all_pages as $page_address) {
            $start_processing_page = microtime(true);
            $array_pages_tag[$i]['page_address'] = $page_address;
            $array_pages_tag[$i]['quantity_img'] = $this->countTagFromPage($page_address, 'img');
            $end_processing_page = microtime(true);
            $array_pages_tag[$i]['micro_timestamp'] = $end_processing_page - $start_processing_page;

            $i++;
        }

        $html = HtmlHelpers::html_page_builder($array_pages_tag);

        SaveFileHelpers::createFile($html, 'html');

    }
}