<?php

$r->get('/', 'HomeController@index');

// {id} must be a number (\d+)
$r->get('/pages/people/{id:\d+}', 'UserController@show');
$r->get('/pages/people/{id:\d+}/edit', 'UserController@edit');
$r->post('/pages/people/{id:\d+}/edit', 'UserController@update');

$r->get('/manual/value/{user_id:\d+}/{value_id:\d+}/delete', 'ManualValueController@delete');

// The /{title} suffix is optional
$r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
