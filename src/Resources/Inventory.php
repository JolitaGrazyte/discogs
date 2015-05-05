<?php
/**
 * Created by PhpStorm.
 * User:    Shane Cullinane
 * Email:   shane@cosmictones.org
 * GitHub:  https://github.com/ShaneCullinane 
 * Date:    28/04/2015
 */

namespace shanecullinane\Discogs\Resources;


/**
 * Class Inventory (info from http://www.discogs.com/developers/#page:marketplace,header:marketplace-listing)
 *
 * Returns the list of listings in a user’s inventory. Accepts Pagination parameters.
 * Basic information about each listing and the corresponding release is provided, suitable for display in a list. For detailed information about the release, make another API call to fetch the corresponding Release.
 *
 * If you are not authenticated as the inventory owner, only items that have a status of For Sale will be visible.
 * If you are authenticated as the inventory owner you will get additional weight, format_quantity, external_id, and location keys.
 *
 * @package shanecullinane\Discogs\Resources
 */
class Inventory extends Resource{

    protected $resource = 'users/{username}/inventory';

    /**
     * Set additional query parameters. Inventory status parameters need to be ucwords case, hence the override
     *
     * @param string $param
     * @param string $value
     * @return $this
     */
    public function addParam($param, $value) {

        $value = ucwords($value);
        $value= $this->formatParamValue($value);
        $this->params .= "&". "$param=$value";
        return $this;

    }

    public function find($username) {

        $this->url = str_replace('{username}', $username, $this->url);
        $this->addToken();
        return $this;
    }



}