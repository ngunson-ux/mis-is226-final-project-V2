<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\CodeIgniter;


class Ping extends BaseController
{
    // This provides reusable utilities such as respond() and fail() to return consistent responses.
    use ResponseTrait;


    // This method will be called when the /ping route is accessed with a GET request.
    public function getIndex(): ResponseInterface
    {
        return $this->respond([
            'status'  => 'ok',
            'time'    => date('c'),
            'version' => CodeIgniter::CI_VERSION
        ], 200);
    }
}
