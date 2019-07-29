<?php

namespace App\traits;

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
        return \response()->json(['data' => $data], $code);
    }

    /**
     * @param string $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code){
        return \response()->json(['error' => $message, 'code' => $code], $code);
    }
}