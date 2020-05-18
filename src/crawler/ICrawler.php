<?php

namespace src\crawler;

/**
 * Interface ICrawler
 * @package src\crawler
 */
interface ICrawler
{

    /**
     * This function is used to retrieve all the pages of a site
     * @param string $url $site url
     * @param int $depth Depth of access to page links
     * @return array
     */
    public function getAllPagesFromSite($url, $depth = 5);

    /**
     * This function is used to count a tag given on a site
     *
     * @param string $url
     * @param string $tagName
     * @return mixed
     */
    public function countTagFromPage($url, $tagName);

    /**
     * This function is used to run a script.
     *
     * @return void
     */
    public function run();

}