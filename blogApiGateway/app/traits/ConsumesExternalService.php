<?php
/**
 * Created by PhpStorm.
 * User: jp
 * Date: 28/07/2019
 * Time: 11:39 PM
 */
namespace App\traits;

use GuzzleHttp\Client;

trait ConsumesExternalService{

    /**
     * Return a request o eny service
     * @return string
     */
    public function performeRequest($method, $requestUri, $formParams = [], $headers = []){

        $client = new Client([
            'base_url' => $this->baseUri,
        ]);

        $response = $client->request($method, $this->baseUri . $requestUri, [
            'form_params' => $formParams,
            'headers' => $headers
        ]);

        return $response->getBody()->getContents();
    }
}