<?php

$routes->get('/', 'HomeController::index', ['as' => 'home']);

$routes->group('', [], function($routes) {
  $routes->get('/login', 'HomeController::login', ['as' => 'home.login']);
  $routes->get('/enroll', 'HomeController::enroll', ['as' => 'home.enroll']);
  $routes->post('enroll-submit', 'HomeController::enrollSubmit', ['as' => 'home.enroll-submit']);
});