<?php
/**
 * Created by PhpStorm.
 * User: Tom Gribbins
 * Date: 27/04/2015
 * Time: 10:47
 */

namespace shanecullinane\Discogs;

use shanecullinane\Discogs\Config\Config;
use shanecullinane\Discogs\Http\Curl;
use shanecullinane\Discogs\Resources\Artist;
use shanecullinane\Discogs\Resources\Inventory;
use shanecullinane\Discogs\Resources\Label;
use shanecullinane\Discogs\Resources\Listing;
use shanecullinane\Discogs\Resources\MasterRelease;
use shanecullinane\Discogs\Resources\Release;
use shanecullinane\Discogs\Resources\Search;


/**
 * Class Register
 *
 *
 * @package shanecullinane\Discogs
 */
class Register {

    /**
     * Register classes and dependencies here
     */
    public function __construct() {

        /*
         * Discogs\Config
         */
        Container::register('Config', function() {
            $config = new Config();
            return $config;
        });


        /*
         * Discogs\Http
         */
        Container::register('Grabber', function() {
            $grabber = new Curl(Container::get('Config'));
            return $grabber;
        });


        /*
         * Discogs\Resources
         */
        Container::register('Artist', function() {
            $artist = new Artist(Container::get('Config'), Container::get('Grabber'));
            return $artist;
        });

        Container::register('Inventory', function() {
            $inventory = new Inventory(Container::get('Config'), Container::get('Grabber'));
            return $inventory;
        });

        Container::register('Label', function() {
            $label = new Label(Container::get('Config'), Container::get('Grabber'));
            return $label;
        });

        Container::register('Listing', function() {
            $listing = new Listing(Container::get('Config'), Container::get('Grabber'));
            return $listing;
        });

        Container::register('MasterRelease', function() {
            $master = new MasterRelease(Container::get('Config'), Container::get('Grabber'));
            return $master;
        });

        Container::register('Release', function() {
            $release = new Release(Container::get('Config'), Container::get('Grabber'));
            return $release;
        });

        Container::register('Search', function() {
            $search = new Search(Container::get('Config'), Container::get('Grabber'));
            return $search;
        });
    }

}