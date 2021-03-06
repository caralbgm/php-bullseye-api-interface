<?php
//1. Include Bullseye library
require_once '../Bullseye.php';

//2. Create Bullseye object
$clientId = 1234;
$searchKey = null; //'cf623cdf-1090-43ba-8b0f-9fa67fcf9d57';
$adminKey = '123456';
$useStagingServer = true;
$bullseye = new Bullseye\Bullseye($clientId, $searchKey, $adminKey, $useStagingServer);

//2.1 activate debug mode
//$bullseye->debug(true);

//3. Call method to delete the location
$searchArgs = array(
  "City" => "New York",
  "State" =>  "NJ",
  "CountryId" => 1,
  "Radius" => 10
);
$response = $bullseye->searchLocations($searchArgs);

//4. Check response
if($response)
  print_r($response);
else{
  //if location was not found
  print_r($bullseye->getLastError());
}

