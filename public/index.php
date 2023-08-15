<?php

declare(strict_types = 1);
require __DIR__ . '/../vendor/autoload.php';


use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\TransactionsController;
use App\Router;

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;
define('FILES_PATH', $root . 'app\storage' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('APP_PATH',  $root . 'app\Transactions' . DIRECTORY_SEPARATOR);
define('DB_PATH',  $root . 'app\DB' . DIRECTORY_SEPARATOR);
define('UP_PATH',  $root . 'app\Uploads' . DIRECTORY_SEPARATOR);

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

//require DB_PATH . 'DBroutine.php';

$router = new Router();

$router
    ->get('/', [HomeController::class, 'home'])
    ->get('/transaction', [TransactionsController::class, 'transactions']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();