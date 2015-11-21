<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shane@cosmictones.org
 * GitHub:  https://github.com/ShaneCullinane 
 * Date:    28/04/2015
 */

namespace shanecullinane\Discogs\Resources;


class Listing extends Resource {

    protected $resource = '/marketplace/listings/{listing_id}';

    public function find($listingId) {

        $this->url = str_replace('{listing_id}', $listingId, $this->url);
        return $this;
    }

}