<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    26/04/2015
 */

namespace shanecullinane\Discogs\Http;
use shanecullinane\Discogs\Config\Config;
use shanecullinane\Discogs\Contracts\ConfigInterface;
use shanecullinane\Discogs\Contracts\GrabberInterface;

/**
 * Class Grabber
 * Sets out a few parameters/settings/functions/etc that are (or might be) needed by the Resource class
 *
 * @package shanecullinane\Discogs\Http
 */
abstract class Grabber implements GrabberInterface {

    protected $config       = null;
    protected $headers      = array();
    protected $status       = null;
    protected $url          = null;

    /**
     * @param ConfigInterface $config
     * @throws \Exception
     */
    public function __construct($config){

        if ($config instanceof ConfigInterface) {
            $this->config = $config;
        } else { throw new \Exception('$config does implement ConfigInterface'); }
    }

    public function get(){}

    public function setConfig(Config $config){
        $this->config = $config;
    }

    /**
     * Sets headers to be sent to discogs. A default accept-headers header is generally already set - reset it like
     * $this: $grabber->setHeader('accept-header', 'my new header')
     *
     * @param $header
     * @param $value
     */
    public function setHeader($header, $value) {
        $this->headers[$header] = $value;
    }


    public function setUrl($url) {
        $this->url = $url;
    }

    public function status() {
        return $this->status;
    }

}