<?php

/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    25/04/2015
 */

namespace shanecullinane\Discogs\Resources;

/**
 * Class MasterRelease
 * Extends Resource class with additional functionality for Discogs MasterRelease resource
 * @package shanecullinane\Discogs\Resources
 */
class MasterRelease extends Resource {

    protected $resource = 'masters';

    /**
     * Returns the all versions of a master release
     *
     * @return $this
     */
    public function versions() {

        $this->url .= '/versions';
        return $this;

    }




}