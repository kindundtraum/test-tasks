<?php

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Phpfastcache\CacheManager;
use Phpfastcache\Config\ConfigurationOption;
use Solution\ExternalServiceData;
use Solution\ExternalServiceAdapter;

$logFilePath = __DIR__ . '/solution/logs/external_service.log';
$logger = new Logger(
    'test_logger',
    [
        new StreamHandler($logFilePath, Logger::DEBUG)
    ]
);

$cachePath = __DIR__ . '/solution/cache';
CacheManager::setDefaultConfig(
    new ConfigurationOption(["path" => $cachePath])
);
$cache = CacheManager::getInstance('files');

$client = new ExternalServiceAdapter('testHost','testLogin','testPassword');
$dataProvider = new ExternalServiceData($client, $cache, $logger);

$dataProvider->get(["Hello, world!"]);

print_r("OK: got data from external service\n");
