<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HireflixService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.hireflix.com/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('HIREFLIX_API_KEY'),
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function createInterview($data)
    {
        dd($data);
        $response = $this->client->post('interviews', [
            'json' => $data
        ]);
        
        return json_decode($response->getBody(), true);
    }

    public function getInterview($interviewId)
    {
        $response = $this->client->get("interviews/{$interviewId}");

        return json_decode($response->getBody(), true);
    }
}
