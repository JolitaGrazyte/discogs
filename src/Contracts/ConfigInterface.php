<?php

namespace shanecullinane\Discogs\Contracts;

interface ConfigInterface {

    public function getApiToken();
    public function getApiUrl();
    public function getDefaultHeader();
    public function getUserAgent();

}