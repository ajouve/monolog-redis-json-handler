<?php

namespace MonologRedisJson;

use Monolog\Handler\RedisHandler;

class Handler extends RedisHandler {

    private $metaData = [];

    public function addMetaData($key, $value)
    {
        $this->metaData[$key] = $value;
    }

    protected function write(array $record)
    {
        unset($record['formatted']);

        $record['formatted'] = json_encode(array_merge($record, $this->metaData));

        parent::write($record);
    }
    
}
