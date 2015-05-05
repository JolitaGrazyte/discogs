# Discogs

## Overview

A work-in-progress PHP package for interacting with the Discogs API.

Artist, Inventory, Label, MasterRelease, Release and Search resources are largely functional. More to do.

## Install

**Laravel**
* require "shanecullinane/discogs": "@dev" in your composer.json
* composer update
* add the service provider to the 'provides' array  in config/app.php

    'shanecullinane\Discogs\DiscogsServiceProvider',

* run composer dump-autoload
* set the following variables in your .env file

    DISCOGS_URL=https://api.discogs.com/
    DISCOGS_TOKEN=your-personal-discogs-token
    DISCOGS_DEFAULT_ACCEPT_HEADER='HTTP_ACCEPT: application/vnd.discogs.v2.plaintext+json'
    DISCOGS_USER_AGENT='user-agent: your-app +https://example.com/myprofilepage'

**Not Laravel**
* require "shanecullinane/discogs": "@dev" in your composer.json
* composer update
* composer dump-autoload
* figure out some way to get the discogs url, your api token, user agent and accept-header values into the Config class (src/Config/Config.php).


**Personal settings**

You need a token to access some (not all) resources.
You get more data if you identify yourself with a user-agent.
Change the accept header if you want - read the discogs documentation.

## Usage

    $discogs = new Discogs('Artist');

or

    $discogs = new Discogs()->setResource('Label');


The get() method returns Discogs data as a PHP object.
The json() method returns Discogs data as json.
These methods should be used at the end of the chain.


## DATABASE

### Release
*"The Release resource represents a particular physical or digital object released by one or more Artists."*
http://www.discogs.com/developers/#page:database,header:database-release

    $discogs        = new Discogs('Release');
    $release        = $discogs->find(6880946);              // returns an Release class with id set
    $release_info   = $release->get();                      // returns release as PHP stdClass
    $release_json   = $release->json();                     // returns release as json

    // Alternative...
    $discogs        = new Discogs('Release');
    $release        = $discogs->find(6880946)->get();


### Master Release
*"The Master resource represents a set of similar Releases. Masters (also known as “master releases”) have a “main release” which is often the chronologically earliest."*
http://www.discogs.com/developers/#page:database,header:database-master-release

    $discogs                = new Discogs('MasterRelease');
    $master_release         = $discogs->find(800726);               // returns a MasterRelease class with id set
    $master_release_info    = $master_release->get();               // returns master release as PHP stdClass
    $master_release_json    = $master_release->json();              // returns master release as json
    $versions               = $master_release()->versions()->get(); // returns all versions of a master release


### Master Release Versions
*"Retrieves a list of all Releases that are versions of this master. Accepts Pagination parameters."*
http://www.discogs.com/developers/#page:database,header:database-master-release-versions

    $discogs                 = new Discogs('MasterRelease');
    $master_release_versions = $discogs->find(800726)->versions()->get();       // returns master release versions as PHP stdClass

    // with pagination
    $discogs                 = new Discogs('MasterRelease');
    $master_release_versions = $discogs->find(800726)->versions()->perPage(5)->page(1)->get(); // returns page 1 of master release versions as PHP stdClass, with 5 versions per page


### Artist
*"The Artist resource represents a person in the Discogs database who contributed to a Release in some capacity."*
http://www.discogs.com/developers/#page:database,header:database-artist

    $discogs            = new Discogs('Artist');
    $artist             = $discogs->find('544221');         // returns an Artist class with id set
    $profile            = $artist->get();                   // returns artist profile as PHP stdClass
    $profile_json       = $artist->json();                  // returns artist profile as json
    $releases           = $artist->releases()->get();       // returns artist releases as PHP stdClass
    $releases_json      = $artist->releases()->json();      // returns artist releases as json

    // alternative approach
    $discogs    = new Discogs('Artist');
    $profile    = $discogs->find('544221')->get();


### Artist Releases
*"Returns a list of Releases and Masters associated with the Artist. Accepts Pagination."*
http://www.discogs.com/developers/#page:database,header:database-artist-releases

    $discogs           = new Discogs('Artist');
    $artist_releases   = $discogs->find('544221')->releases()->perPage(5)->page(2)->json();  // with pagination


### Label
*"The Label resource represents a label, company, recording studio, location, or other entity involved with Artists and Releases."*

http://www.discogs.com/developers/#page:database,header:database-label

    $discogs                = new Discogs('Label');
    $label                  = $discogs->find('74093');          // returns a Label class with label_id set
    $label_profile          = $label->get();                    // returns label profile as PHP stdClass
    $label_profile_json     = $label->json();                   // returns label profile as json
    

### Label Releases
*"Returns a list of Releases associated with the label. Accepts Pagination parameters."*
http://www.discogs.com/developers/#page:database,header:database-all-label-releases

    $discogs            = new Discogs('Label');
    $label_releases     = $discogs->find('74093')->releases()->perPage(6)->page(2)->get();


### Search
*"Issue a search query to our database. This endpoint accepts pagination parameters.
Authentication (as any user) is required."*


**You must have set your personal discogs api token to use the Search resource.**


    $discogs                = new Discogs('Search');
    $search                 = $discogs->find('united bible studies');   // returns a Search class with search terms set
    $results                = $search->get();                           // returns label profile as PHP stdClass
    $results_pagination     = $search->perPage(5)->page(1)->json();     // returns label profile as json


## Marketplace

## Inventory
*"Returns the list of listings in a user’s inventory. Accepts Pagination parameters.
Basic information about each listing and the corresponding release is provided, suitable for display in a list. For detailed information about the release, make another API call to fetch the corresponding Release.

If you are not authenticated as the inventory owner, only items that have a status of For Sale will be visible.
If you are authenticated as the inventory owner you will get additional weight, format_quantity, external_id, and location keys."*

    $discogs                = new Discogs('Inventory');
    $inventory              = $discogs->find('Shane477');               // returns a Search class with search terms set
    $listings               = $inventory->get();                        // returns label profile as PHP stdClass
    $listings_pagination    = $listings->perPage(5)->page(1)->get();    // returns label profile as json


## To-Do
* finish off implementing other resources
* make it better
* see if it can work without laravel
* find out how to label versions sensibly


## Versions

**v0.1.0** : 05/05/2015 :
* Artist, Inventory, Label, MasterRelease, Release and Search resources are largely functional.

**v0.1.1** : 05/05/2015 :
* updated README a little bit