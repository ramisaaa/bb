<?php

namespace Functions;

class Response
{
    /**
     * @param array $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    static public function ok($data = [], $message = '')
    {

        return response()->json([
            'ok' => true,
            'messages' => $message,
            'data' => $data
        ]);
    }

    /**
     * @param $message
     * @param array $data
     * @param $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    static public function fail($message, $statusCode=422, $data = [])
    {
        return response()->json([
            'ok' => false,
            'messages' => $message,
            'data' => $data
        ], $statusCode);
    }
}
