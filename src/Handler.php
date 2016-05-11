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
        parent::write($this->format($record));
    }

    protected function format(array $record)
    {
        unset($record['formatted']);
        $record['level'] = strtolower($record['level_name']);
        unset($record['level_name']);
        $record['formatted'] = json_encode(array_merge($record, $this->metaData));
        
        return $record;
    }
    
}
