# monolog redis json handler

## Symfony configuartion

Service

    redis:
        class: Predis\Client
        arguments:
            -
                scheme: tcp
                host: "%redis_host%"
                port: "%redis_port%"
                password: "%redis_password%"

    monolog_redis_json_handler:
        class: MonologRedisJson\Handler
        arguments:
            - '@redis'
            - 'monolog'
            - 200
        calls:
            - [addMetaData, ['application', 'my_app']]
            
Config

    monolog:
        handlers:
            redis:
                type: service
                id: monolog_redis_json_handler
        
