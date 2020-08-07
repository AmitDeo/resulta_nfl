<?php

namespace Drupal\resulta_nfl\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;


/** 
* Defines NFL Controller class for heavy work.
* This class is simple for now and we could code the function in block file
* but we can extend this class for future needs. 
*/

class NFLController extends ControllerBase {
	private $apiurl;
	private $apikey;
  	private $nflteams;

	function __construct() {
		$this->apiurl = 'http://delivery.chalk247.com/';
	    $this->apikey = '74db8efa2a6db279393b433d97c2bc843f8e32b0';
	    $this->teams = [];
	}

	public function getTeamList()
	{

		//Using Drupal provided service to make HTTP Request which eventually uses Guzzle Client.
		$client = \Drupal::service('http_client_factory')->fromOptions([
	      'base_uri' => $this->apiurl,
	    ]);

	    $response = $client->get('team_list/NFL.JSON', [
	      'query' => [
	        'api_key' => $this->apikey,
	      ]
	    ]);

	    //Using Drupal Json class to convert Json to php array
	    $response = Json::decode($response->getBody());
	    
	    $teams = [];
	    //Check if we have the data or return empty
	    $teamList = isset($response['results']['data']['team']) && count($response['results']['data']['team']) ? $response['results']['data']['team'] : [];

	    //Aggregate the result
	    foreach ( $teamList as $team) 
	    {
	      $teams[] = $team;
	    }

	    $this->nflteams = $teams;

	    return $teams;
	}

	/**
	* Public function to get unique conferences for the filter
	*/
	public function getConferences()
	{
		$conferences = [];

		if(count($this->nflteams))
		{
			foreach($this->nflteams as $team)
			{
				if(!in_array($team['conference'], $conferences))
				{
					$conferences[] = $team['conference'];
				}
			}

			//Sort alphabetically
			sort($conferences);	
		}

		return $conferences;
	}

	/**
	* Public function to get unique Divisins for the filter
	*/
	public function getDivisions()
	{
		$divisions = [];

		if(count($this->nflteams))
		{
			foreach($this->nflteams as $team)
			{
				if(!in_array($team['division'], $divisions))
				{
					$divisions[] = $team['division'];
				}
			}

			//Sort alphabetically
			sort($divisions);

		}

		return $divisions;
	}

}
