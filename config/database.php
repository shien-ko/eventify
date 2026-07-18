<?php
declare(strict_types=1);

if (!defined('DB_HOST')) {
    define('DB_HOST', '127.0.0.1');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'eventify');
}

if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}

function db(bool $withDatabase = true): PDO
{
    static $connections = [];

    $key = $withDatabase ? 'database' : 'server';

    if (isset($connections[$key])) {
        return $connections[$key];
    }

    $dsn = 'mysql:host=' . DB_HOST . ($withDatabase ? ';dbname=' . DB_NAME : '') . ';charset=utf8mb4';

    $connections[$key] = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $connections[$key];
}
