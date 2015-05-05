<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    26/04/2015
 */

namespace shanecullinane\Discogs\Http;

/**
 * Class Curl
 * Fetches requested data from Discogs
 *
 * @package shanecullinane\Discogs
 */
class Curl extends Grabber{

    /**
     * Fetches requested data from Discogs
     *
     * @return mixed discogs api response content
     * @throws \Exception
     */
    public function get() {

        if (!isset($this->config)) {
            throw new \Exception('Curl requires a Config');
        }

        $this->setHeader('user-agent', $this->config->getUserAgent());
        $this->setHeader('accept-header', $this->config->getDefaultHeader());

        $ch = curl_init();

        /* Set Headers */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_values($this->headers));

        /* Set URL */
        curl_setopt($ch, CURLOPT_URL, $this->url);

        /* Tell cURL to return the output */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* Tell cURL NOT to return the headers */
        curl_setopt($ch, CURLOPT_HEADER, false);

        /* Execute cURL, Return Data */
        $data = curl_exec($ch);

        /* Check HTTP Code */
        $this->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        /* Close cURL Resource */
        curl_close($ch);

        return $data;
    }



}