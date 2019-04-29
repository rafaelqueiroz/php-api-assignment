<?php

namespace App\Http\Clients;

use GuzzleHttp\Client;

class NCAPHttpClient implements NCAPClient
{
    private $client;

    private $empty = ["Count" => 0,"Results" => []];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getSafetyRatings($vehicleId)
    {
        try {
            $result = json_decode($this->client->get(
                "VehicleId/{$vehicleId}",
                ['query' => ['format' => 'json']]
            )->getBody());

            return $result ? $result : (object) $this->empty;
        }
        catch (\Exception $e) {
            return (object) $this->empty;
        }
    }

    public function getVariants($modelYear, $maker, $model)
    {
        try {
            $result = json_decode($this->client->get(
                "modelyear/{$modelYear}/make/{$maker}/model/{$model}",
                ['query' => ['format' => 'json']]
            )->getBody());

            return $result ? $result : (object) $this->empty;
        }
        catch (\Exception $e) {
            return (object) $this->empty;
        }
    }
}
