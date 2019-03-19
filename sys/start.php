<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Jenssegers\Blade\Blade;
use App\Services\EloquentLoader;

$dotenv = Dotenv\Dotenv::create(__DIR__ . '../../');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

$eloquentLoader = new EloquentLoader([
  'DATABASE_HOST'     => getenv('DB_HOST'),
  'DATABASE_NAME'     => getenv('DB_NAME'),
  'DATABASE_USER'     => getenv('DB_USER'),
  'DATABASE_PASSWORD' => getenv('DB_PASS'),
]);
$eloquentLoader->load();

define('USER_ID', 1);


/**
 * Returns the connected template
 *
 * @param  string $view   template name
 * @param  array  $params array of parameters
 * @return string         generated code
 */
function view($view, $params = [], $append = [])
{
  $blade = new Blade(
    $_SERVER['DOCUMENT_ROOT'] . '/resources/views',
    $_SERVER['DOCUMENT_ROOT'] . '/resources/views/cache');

  return $blade->render($view, $params);
}

function dd2($array, $exit = true)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
  if ($exit) {
    exit;
  }
}