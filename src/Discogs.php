<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    24/04/2015
 */

namespace shanecullinane\Discogs;

/**
 * Class Discogs
 * The main discogs class through which all interaction is done.
 *
 * @package shanecullinane\Discogs
 */
class Discogs {

    private $resource;

    /**
     * The constructor can be used to set the requested resource when the class is instantiated or else the setResource()
     * function can be used later
     *
     * @param string $resource optional name of resource e.g. 'Artist', 'Label'
     * @throws \Exception
     */
    public function __construct($resource = null) {

        Container::setup();

        if ($resource) {
            $this->resource = Container::get($resource);
        }

        return $this->resource;
    }

    /**
     * Primes and returns the requested discogs resource class.
     *
     * @param mixed $id string containing identifying data such as artist/label/release id or a search query string
     * @return Resource
     * @throws \Exception
     */
    public function find($id) {

        if (isset ($this->resource)) {
            $this->resource->find($id);
            return $this->resource;
        }
        else { throw new \Exception('Discogs resource is not set'); }

    }

    /**
     * Sets the required discogs resource (e.g. 'Artist')
     * The constructor can also be used to set the resource
     *
     * @param string $resource
     * @return $this
     * @throws \Exception
     */
    public function setResource($resource) {

        $this->resource = Container::get($resource);
        return $this->resource;
    }


}