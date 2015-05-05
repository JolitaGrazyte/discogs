<?php



namespace shanecullinane\Discogs\Contracts;

use shanecullinane\Discogs\Config\Config;

interface GrabberInterface {

    public function __construct($config);

    public function get();
    public function setHeader($header, $value);
    public function status();



}