<?php
/**
 * Created by PhpStorm.
 * User: Tom Gribbins
 * Date: 27/04/2015
 * Time: 21:21
 */

namespace shanecullinane\Discogs\Config;

use shanecullinane\Discogs\Contracts\ConfigInterface;

/**
 * Class Config
 * Stores configuration data and supplies it where needed
 *
 * @todo implement rate limiting
 * @package shanecullinane\Discogs\Config
 */
class Config implements ConfigInterface{

    private $DISCOGS_USER_AGENT;
    private $DISCOGS_TOKEN;
    private $DISCOGS_URL;
    private $DISCOGS_DEFAULT_ACCEPT_HEADER;

    public function __construct() {

        /*
         * get defined settings
         */
        if (defined('DISCOGS_URL')) {
            $this->DISCOGS_URL = DISCOGS_URL;
        }

        if (defined('DISCOGS_TOKEN')) {
            $this->DISCOGS_TOKEN = DISCOGS_TOKEN;
        }

        if (defined('DISCOGS_DEFAULT_ACCEPT_HEADER')) {
            $this->DISCOGS_DEFAULT_ACCEPT_HEADER = DISCOGS_DEFAULT_ACCEPT_HEADER;
        }

        if (defined('DISCOGS_USER_AGENT')) {
            $this->DISCOGS_USER_AGENT = DISCOGS_USER_AGENT;
        }


        /*
         * if .env settings are set use those
         */
        if (class_exists('\Config')) {

            if ( env('DISCOGS_URL')){
                $this->DISCOGS_URL = env('DISCOGS_URL');
            }

            if (env('DISCOGS_TOKEN')) {
                $this->DISCOGS_TOKEN = env('DISCOGS_TOKEN');
            }

            if (env('DISCOGS_DEFAULT_ACCEPT_HEADER')) {
                $this->DISCOGS_DEFAULT_ACCEPT_HEADER = env('DISCOGS_DEFAULT_ACCEPT_HEADER');
            }

            if (env('DISCOGS_USER_AGENT')) {
                $this->DISCOGS_USER_AGENT = env('DISCOGS_USER_AGENT');
            }

        }

    }

    /**
     * @return string personal discogs api access token
     */
    public function getApiToken()
    {
        return $this->DISCOGS_TOKEN;
    }

    /**
     * @return string standard discogs api url (expanded by Resource classes)
     */
    public function getApiUrl()
    {
        return $this->DISCOGS_URL;
    }

    /**
     * Many discogs resources require that an accept-header be sent with requests. This provides
     * @return string
     */
    public function getDefaultHeader()
    {
        return $this->DISCOGS_DEFAULT_ACCEPT_HEADER;
    }

    public function getUserAgent()
    {
        return $this->DISCOGS_USER_AGENT;
    }



}