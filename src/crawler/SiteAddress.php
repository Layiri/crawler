<?php


namespace src\crawler;


use Exception;

/**
 * Class SiteAddress
 *
 * Class SiteAddress is valid yif site address is valid
 * @package src\crawler
 * @access public
 * @author Layiri Batiene <eratos02@yahoo.fr>
 */
class SiteAddress
{
    private $site_address;

    public function __construct(string $site_address)
    {
        $this->ensureIsValidSiteAdress($site_address);

        $this->site_address = $site_address;

    }

    public static function fromString(string $site_address): self
    {
        return new self($site_address);
    }

    public function __toString(): string
    {
        return $this->site_address;
    }

    private function ensureIsValidSiteAdress(string $site_address): void
    {
        $site_address = filter_var($site_address, FILTER_SANITIZE_URL);

        try {
            if (!filter_var($site_address, FILTER_VALIDATE_URL)) {
                throw new Exception(
                    sprintf(
                        '"%s" is not a valid site address ',
                        $site_address
                    )
                );
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function sanitizeURL($url)
    {
        return (strtolower(substr($url, 0, 7)) == 'http://' || strtolower(substr($url, 0, 8)) == 'https://') ? $url : 'http://' . $url;
    }


}//$url = strpos($url, 'http') !== 0 ? "http://$url" : $url;
