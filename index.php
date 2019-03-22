<?php
require_once 'vendor/autoload.php';
require_once 'sys/start.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  require_once 'app/routes.php';
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
      echo view('404');
      // ... 404 Not Found
      break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
      $allowedMethods = $routeInfo[1];
      // ... 405 Method Not Allowed
      break;
  case FastRoute\Dispatcher::FOUND:
      list ($controller, $method) = explode('@', $routeInfo[1]);
      $controller = "App\\Controllers\\{$controller}";
      $controller = new $controller;
      $vars = $routeInfo[2];

      echo call_user_func_array([$controller, $method], $vars);
      // ... call $handler with $vars
      break;
}