<?php

/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    26/04/2015
 */

namespace shanecullinane\Discogs\Resources;

/**
 * Class Search
 * Extends Resource class with functionality for accessing the discogs Search resource
 *
 * @package shanecullinane\Discogs\Resources
 */
class Search extends Resource {

    protected $resource = 'database/search';

    /**
     * Sets the user's search query and the application access token which is required with discogs Search resource
     *
     * @param string $q a user search query
     * @return $this
     */
    public function find($q) {

        $q = $this->formatParamValue($q);
        $this->addToken();
        $this->addParam('q', $q);
        return $this;

    }



}