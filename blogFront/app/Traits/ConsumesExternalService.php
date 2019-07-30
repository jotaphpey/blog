<?php
/**
 * Created by PhpStorm.
 * User: jp
 * Date: 28/07/2019
 * Time: 11:39 PM
 */
namespace App\Traits;

use GuzzleHttp\Client;
use Mockery\Exception;


trait ConsumesExternalService{

    /**
     * Return a request o eny service
     * @return string
     */
    public function performeRequest($method, $requestUri, $formParams = [], $headers = []){

        $client = new Client([
            'base_url' => $this->baseUri,
        ]);

        if(isset($this->secret)){
            $headers["Authorization"] = $this->secret;
        }

        $form = [
            'headers' => $headers
        ];

        $form['form_params'] = $formParams;

        $response = $client->request($method, $this->baseUri . $requestUri, $form);

        return $response->getBody()->getContents();
    }
}