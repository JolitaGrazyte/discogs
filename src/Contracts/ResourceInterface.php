<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shan@cosmictones.org
 * Github:  https://github.com/ShaneCullinane
 * Date:    24/04/2015
 */


namespace shanecullinane\Discogs\Contracts;

/**
 * Interface ResourceInterface
 * Defines the Resource class
 *
 * @package shanecullinane\Discogs\Contracts
 */
interface ResourceInterface {

    function find($identifier);

    function get();

    function json();

    function page($pageNumber);

    function perPage($resultsPerPage);

}