<?php

/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    24/04/2015
 */

namespace shanecullinane\Discogs\Resources;

use shanecullinane\Discogs\Contracts\ConfigInterface;
use shanecullinane\Discogs\Contracts\GrabberInterface;
use shanecullinane\Discogs\Contracts\ResourceInterface;
use shanecullinane\Discogs\Http\Grabber;

/**
 * Class Resource
 * Represents a Discogs resource such as Artist, Label, Release etc.
 * The Resource contains methods to generate an api url and the Grabber class uses this url to get the data from
 * Discogs and save it to $this->resource.
 *
 * @package shanecullinane\Discogs\Models
 */
abstract class Resource implements ResourceInterface {

    protected $config           = null;     // Should be an instance of ConfigInterface, supplies user/app info
    protected $url              = null;     // The discogs api url that will be called
    protected $resource         = null;     // The required Discogs resource e.g. Artist(), Label() etc
    protected $response         = null;     // Stores the API response from Discogs as JSON
    protected $grabber          = null;     // Object for getting the data from discogs e.g. Curl
    protected $perPage          = null;     // Number of results per page
    protected $page             = null;     // The number of the requested page
    protected $params           = null;     // Additional parameters to be passed to the API
    protected $token            = null;     // Individual user access tokem (required for access to some resources)
    protected $identifier       = null;     //


    /**
     * @param ConfigInterface $config
     * @param GrabberInterface $grabber
     * @throws \Exception
     */
    public function __construct($config, Grabber $grabber) {

        if ($config instanceof ConfigInterface) {

            $this->config = $config;
        } else { throw new \Exception($config . ' is not an instance of ConfigInterface'); }


        if ($grabber instanceof GrabberInterface) {

            $this->grabber = $grabber;
        } else { throw new \Exception($grabber . ' is not an instance of GrabberInterface'); }

        $this->url      .= $this->config->getApiUrl() . $this->resource;
        $this->token     = $this->config->getApiToken();

        return $this;
    }



    /**
     * Set additional search parameters - see http://www.discogs.com/developers/#page:database,header:database-search
     *
     * @param string $param
     * @param string $value
     * @return $this
     */
    public function addParam($param, $value) {

        $value= $this->formatParamValue($value);
        $this->params .= "&". "$param=$value";
        return $this;

    }



    /**
     * Set the identifer for the requested resource e.g. a release or artist id, a search string
     * Returns an instance of the relevant Resource child class
     *
     * @param mixed $identifier
     * @return $this
     */
    public function find($identifier) {

        if (empty ($this->identifier)) {
            $this->identifier = $identifier;
            $this->url .= "/$identifier";
        }
        return $this;

    }



    /**
     * Formats the $query so that it can be passed to discogs
     *
     * @param $query
     * @return string
     */
    protected function formatParamValue($value) {
        $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        $value = str_replace(' ', '+', $value);
        return $value;
    }



    /**
     * Return the resource as a PHP object
     *
     * @return mixed
     */
    public function get() {

        return json_decode($this->getResponse());

    }



    /**
     * Prepares the query url for the api, triggers the caller classes/functions and returns the response from the apo
     *
     * @return String discogs api response in json format
     */
    protected function getResponse() {

        if (!isset($this->response)) {
            $this->addParam('token', $this->token);
            $this->_prepare();
        }

        return $this->response;

    }



    /**
     * Return resource as JSON
     *
     * @return bool
     */
    public function json() {

        return $this->getResponse();

    }

    /**
     * Specify the results page number to be returned. Not all resources respond to this.
     *
     * @param int $pageNumber
     * @return $this
     */
    public function page($pageNumber) {

        $this->page = $pageNumber;
        return $this;
    }

    /**
     * Set the  number of results that should be returned per page. Not all resources respond to this.
     *
     * @param int $resultsPerPage
     * @return $this
     */
    public function perPage($resultsPerPage) {

        $this->perPage = $resultsPerPage;
        return $this;
    }


    /**
     * Apply any pagination parameters and any other query parameters to the API url
     */
    protected function _prepare() {

        $params = 0;

        if (isset($this->page) OR isset($this->perPage) OR isset($this->params)){
            $this->url .= '?';
        }

        if (isset($this->params)) {

            $this->url .= "$this->params";
            $params++;
        }

        if (isset($this->perPage)) {

            if ($params > 0) {
                $this->url .= '&';
            }

            $this->url .= "per_page=$this->perPage";
            $params++;
        }

        if (isset($this->page)) {

            if ($params > 0) {
                $this->url .= '&';
            }

            $this->url .= "page=$this->page";
            $params++;
        }


        $this->grabber->setUrl($this->url);
        $this->response = $this->grabber->get();
    }




}