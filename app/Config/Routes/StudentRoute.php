<?php

$routes->group('student', function($routes) {
  $routes->group('', ['filter' => 'student:auth'], function($routes) {
    $routes->get('', 'StudentController::index', ['as' => 'student.home']);
  });

  $routes->group('', ['filter' => 'student:guest'], function($routes) {
    $routes->get('login', 'StudentController::login', ['as' => 'student.login']);
    $routes->post('login-handler', 'StudentController::loginHandler', ['as' => 'student.login-handler']);
  });
});