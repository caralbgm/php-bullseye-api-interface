<?php
namespace Bullseye;

require_once "Connection.php";
include_once "modules/Location.php";
include_once "modules/Search.php";

/**
 * Front controller to handle all requests make to Bullseye API. This class loads other modules
 * based on requests to the API.
 */
class Bullseye{

  /**
   * Connection to Bullseye REST API
   */
  private $connection;

  /**
   * Create Bullseye object to make requests to the REST API.
   *
   * @param $clientId integer ID of client in Bullseye.
   * @param $searchKey string Search key of client in Bullseye.
   * @param $adminKey string Admin key of client in Bullseye.
   * @param $staging boolean if true, then a connection to staging server instead production server is created.
   */
  function __construct($clientId, $searchKey, $adminKey = null, $staging = false){
    //create connection
    $this->connection = new Connection($clientId, $searchKey, $adminKey, $staging);
  }

  /**
   * Enable or disable debug messages for Bullseye connections.
   *
   * @param $activate boolean if true, then debug messages are activated. Otherwise, debug messages are disabled.
   */
  function debug($activate = true){
    $this->connection->debug = $activate;
  }
  
  /**
   * Returns the error in last request made to Bullseye.
   *
   * @return mixed if there was an error in last request made, then an array with error info is returned. Otherwise null is returned.
   */
  function getLastError(){
    return $this->connection->getLastError();
  }

  /**
   * http://api.bullseyelocations.com/services/getlocation-method-0
   */
  function getLocation($locationId){
    return Location::getLocation($this->connection, $locationId);
  }

  /**
   * http://api.bullseyelocations.com/services/addlocation-method
   */
  function addLocation($locationData){
    return Location::addLocation($this->connection, $locationData);
  }

  /**
   * http://api.bullseyelocations.com/services/updatelocation-method
   *
   * @return mixed false if there is an error. Otherwise the request response.
   */
  function updateLocation($locationId, $locationData){
    return Location::updateLocation($this->connection, $locationId, $locationData);
  }

  /**
   * http://api.bullseyelocations.com/services/deletelocations-method
   */
  function deleteLocation($locationId){
    return Location::deleteLocation($this->connection, $locationId);
  }
  
  /**
   * http://api.bullseyelocations.com/services/dosearch2-method
   */
  function searchLocations($args){
    return Search::search($this->connection, $args);
  }
}
