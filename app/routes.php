<?php

$r->get('/', 'HomeController@index');

$r->addGroup('/pages/people', function (FastRoute\RouteCollector $r) {
  // {id} must be a number (\d+)
  $r->get('/{id:\d+}', 'UserController@show');
  $r->get('/{id:\d+}/edit', 'UserController@edit');
  $r->post('/{id:\d+}/edit', 'UserController@update');
});

$r->get('/manual/value/{user_id:\d+}/{value_id:\d+}/delete', 'ManualValueController@delete');

// The /{title} suffix is optional
$r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');

// https://github.com/nikic/FastRoute