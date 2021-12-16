<?php

namespace App\Http\Controllers;


class ResponseHelperController extends Controller
{
    public function middleware($middleware, array $options = [])
    {
        $this->middleware('firebase');
    }

    public function successResponse($data,$message): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                "data" => $data,
                "date" => date("Y-m-d h:i:sA"),
                "errors" => [],
                "info" => [
                    "message" => $message
                ],
                "warnings" => [],
            ]
        );
    }
    public function failResponse($msg,$code): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                "data" => [],
                "date" => date("Y-m-d h:i:sA"),
                "errors" => [
                    "error_code" => $code,
                    "message" => $msg,
                ],
                "info" => [],
                "warnings" => [],
            ]
        );
    }
}
