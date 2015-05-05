<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    24/04/2015
 */

namespace shanecullinane\Discogs\Resources;


/**
 * Class Artist
 * Extends Resource class with additional functionality related to Discogs Release resource.
 *
 * @package shanecullinane\Discogs\Resources
 */
class Artist extends Resource {

    protected $resource = 'artists';

    /**
     * Returns the releases associated with an artist
     *
     * @return $this
     */
    public function releases() {

        $this->url .= '/releases';
        return $this;
    }

}