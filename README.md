# PHP Сrawler

## Table of contents
* [Intro](#intro)
* [Configuration](#configuration-info)
* [Example Crawling](#example-crawling)


## Intro

The bot will go to each page of the site, and will count the number of <img> tags.
At the end of the processing, the bot will generate a report (a file with the name report_dd.mm.yyyy.H.i.s.html) in the form of `(table) html`:
* page address
* number of `<img>` tags
* page processing time

## Configuration

Apache Version: `2.4.41`
PHP Version: `7.2.25`
MySQL Version: `5.7.28 - Port defined for MySQL: 3308`

## Example Crawling

* Browser mode: 
`your-localhost/?site=your-site-address`

* Cli mode: 
Run index.php and add your-site-address
* The results will be save in the file with the name `resources/report_dd.mm.yyyy.H.i.s.html`
