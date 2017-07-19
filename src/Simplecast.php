<?php

namespace Clizaola\Simplecast;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Simplecast wrapper
 * 
 * @package    clizaola/simplecast
 * @author     Original Author <carlos@lizaola.net>
 * @copyright  2017 Carlos Lizaola
 */

class Simplecast
{
    /**
     * $podcastId The podcast ID from Simplecast
     * @var int
     */
    private $podcastId;

    /**
     * $apiKey Simplecast API Key
     * @var string
     */
    private $apiKey;

    /**
     * $url Root URL for API endponit
     * @var string
     */
    private $url;

    public function __construct()
    {
        $this->apiKey = config('services.simplecast.key');
        $this->url = 'https://api.simplecast.com/v1/';
    }

    /**
     * Get all the podcast for the user
     * @method podcasts
     * @author Carlos Lizaola
     * @return array   Array of all the podcasts
     */
    public function podcasts()
    {
        return $this->request("podcasts");
    }

    /**
     * Get the Podcast with the provided ID
     * @method podcast
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @return object	Podcast Details
     */
    public function podcast($podcastId)
    {
        return $this->request("podcasts/{$podcastId}");
    }

    /**
     * Get all the episodes form the podcast ID
     * @method episodes
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @return array   Collection of all the episodes of the podcast
     */
    public function episodes($podcastId)
    {
        return $this->request("podcasts/{$podcastId}/episodes");
    }

    /**
     * Get the Podcast Episode info
     * @method episode
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @param  int  $episodeId The Podcast Episode ID
     * @return object Information from the episode
     */
    public function episode($podcastId, $episodeId)
    {
        return $this->request("podcasts/{$podcastId}/episodes/{$episodeId}");
    }

    /**
     * Get the Podcast Episode Embed HTML code
     * @method episodeEmbed
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @param  int  $episodeId The Podcast Episode ID
     * @return string   HTML for the embed code of the episode
     */
    public function episodeEmbed($podcastId, $episodeId)
    {
        return $this->request("podcasts/{$podcastId}/episodes/{$episodeId}/embed");
    }

    /**
     * Get the Podcast Statisticas
     * @method statistics
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @return object   statisticas of the podcast
     */
    public function statistics($podcastId)
    {
        return $this->request("podcasts/{$podcastId}/statistics");
    }

    /**
     * Get the Podcast Episode Statisticas with the filtes requested
     * @method statisticsOverall
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @param  int  $episodeId The Podcast Episode ID
     * @param  array   $options   Array with the options
     * @return array   Collection of all the statistics for the podcast
     */
    public function statisticsOverall($podcastId, $episodeId, $options=[])
    {
        return $this->request("podcasts/{$podcastId}/statistics/overall",$options);
    }

    /**
     * Get the Podcast Episode Statisticas
     * @method episodeStatistics
     * @author Carlos Lizaola
     * @param  int  $podcastId The podcast ID
     * @param  int  $episodeId The Podcast Episode ID
     * @return array   Collection of all the statistics for the podcast episode
     */
    public function episodeStatistics($podcastId, $episodeId)
    {
        return $this->request("podcasts/{$podcastId}/statistics/episode", [
                'episode_id' => $episodeId
            ]);
    }

    /**
     * Created the request for the endpont passed by
     * @method request
     * @author Carlos Lizaola
     * @param  string  $endpoint The specific Enpoint url
     * @param  array   $options  Extra options for the request
     * @return array Collection or object eith the expect information requested
     */
    private function request($endpoint, $options=[])
    {
        $client = new GuzzleClient();
        $response = $client->get($this->endpoint($endpoint, $options));

        return json_decode($response->getBody());
    }

    /**
     * Creates a string with the endpoint for the request
     * @method endpoint
     * @author Carlos Lizaola
     * @param  string  $endpoint The specific Enpoint url
     * @param  array   $options  Extra options for the request
     * @return string URL with the query string options and API Key
     */
    private function endpoint($endpoint, $options=[])
    {
    	$query = $this->resolveQuery($options);

        return $this->url.$endpoint.'.json?'.$query;
    }

    /**
     * Creates a query string with the options from an array
     * @method resolveQuery
     * @author Carlos Lizaola
     * @param  array    $options Array of query options
     * @return string   String with the query options
     */
    private function resolveQuery($options=[])
    {
    	$options = $this->resolveApiKey($options);
    	
    	return http_build_query($options);
    }

    /**
     * Resolve if the API Key has been pass as an option if not set the default
     * @method resolveApiKey
     * @author Carlos Lizaola
     * @param  array   $options Array of query options
     * @return array   with the API Key as a Key-Value pair
     */
    private function resolveApiKey($options=[])
    {
    	if(!isset($options['api_key'])){
    		$options['api_key'] = $this->apiKey;
    	}

    	return $options;
    }
}
