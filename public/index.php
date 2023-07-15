<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\ErrorController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\ErrorHandler\Debug;


Debug::enable();

$dotenv = new Dotenv();

if (file_exists(__DIR__ . '/../.env')) {
    $dotenv->load(__DIR__ . '/../.env');
} else {
    $dotenv->load(__DIR__ . '/../.env.dist');
}

$container = require("./../config/container.php");
$routes = require("./../config/routes.php");


$request = Request::createFromGlobals();

$context = new RequestContext();

$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $match = $matcher->match($request->getPathInfo());
} catch (ResourceNotFoundException)  {
    $response = $container->get(ErrorController::class)->show404();
    $response->send();
    exit;
}

echo $request->getRealMethod();
$firstMatch = $match[0];

$controllerClass = $firstMatch[0];
$controllerAction = $firstMatch[1];

$controller = $container->get($controllerClass);

$response = $controller->$controllerAction($request);

$response->send();
