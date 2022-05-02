<?php

namespace Ninja;

use Exception;
use Ninja\NJTrait\Jsonable;

class ResponseHelper
{
    use Jsonable;
    
    private static array $instances = [];
    protected function __construct() { }
    protected function __clone() { }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): ResponseHelper
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
    
    public function success($data, $msg = '')
    {
        $this->responseWithCode(200, 'success', $data, $msg);
    }

    public function createdSuccess($data, $msg = '')
    {
        $this->responseWithCode(201, 'success', $data, $msg);
    }
    
    public function badRequest($msg)
    {
        $this->responseWithCode(400, 'failure', null, $msg);
    }
    
    public function serverError($msg = 'Lỗi không xác định, liên hệ đội ngũ phát triển')
    {
        $this->responseWithCode(500, 'error', null, $msg);
    }
    
    public function responseWithCode($code, $status, $data, $msg)
    {
        $this->response_json($this->buildResponseObject($status, $data, $msg), $code);
    }
    
    public function buildResponseObject($status, $data, $msg): array
    {
        return [
            'status' => $status,
            'data' => $data,
            'msg' => $msg
        ];
    }
}

