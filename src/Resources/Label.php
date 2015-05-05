<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    24/04/2015
 */

namespace shanecullinane\Discogs\Resources;


class Label extends Resource{

    protected $resource = 'labels';

    /**
     * Returns the releases associated with an label
     *
     * @return $this
     */
    public function releases() {

        $this->url .= '/releases';
        return $this;

    }
}