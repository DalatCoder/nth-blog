<?php

namespace Ninja;

use Ninja\NJTrait\Jsonable;

class RequestHelper
{
    use Jsonable;
    private array $data;
    
    public function __construct()
    {
        $this->data = $this->parse_json_from_request();
    }
    
    public function get($key, $default_value = null)
    {
        if (!array_key_exists($key, $this->data)) return $default_value;
        return $this->data[$key];
    }
}
