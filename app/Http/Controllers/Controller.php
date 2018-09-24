<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $response = [
        "success" => true,
    ];
    public $response_code = 200;

    public function setResponseFailed($error, $error_code = 200, $data = [])
    {
        $this->response_code = $error_code;
        $this->response['error'] = $error;
        $this->response['data'] = $data;
        $this->response['success'] = false;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setResponseField($key, $value)
    {
        $this->response[$key] = $value;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function response()
    {
        return response()->json($this->response, $this->response_code);
    }
}
