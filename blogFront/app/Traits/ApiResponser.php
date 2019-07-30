<?php

namespace App\Traits;

use Illuminate\Http\Response;


/**
 * Created by PhpStorm.
 * User: jp
 * Date: 28/07/2019
 * Time: 04:52 AM
 */
trait ApiResponser{

    /**
     * @param string|array | $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK){
        $result =  \response($data, $code)->header('Content-Type', 'application/json');

        $data = json_decode($result->getContent());

        if(isset($data->data) && $data->data){
            return $data;
        }

        if($result->getStatusCode() == 200){
            return true;
        }

        return false;
    }

    /**
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code){
        return ["success" => false, "message" => $message, "code" => $code];
    }

    /**
     * @param string $message
     * @param int $code
     * @return Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function errorMessage($message, $code){
        return \response($message, $code)->header('Content-Type', 'application/json');
    }
}