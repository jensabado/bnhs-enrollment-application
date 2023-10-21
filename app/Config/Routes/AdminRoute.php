<?php 

$routes->group('admin', function($routes) {
  $routes->group('', ['filter' => 'admin:auth'], function($routes) {
    $routes->get('home', 'AdminController::index', ['as' => 'admin.home']);
    $routes->get('logout', 'AdminController::logout', ['as' => 'admin.logout']);
    $routes->get('building', 'BuildingController::index', ['as' => 'admin.building']);
    $routes->post('building-data', 'BuildingController::datatable', ['as' => 'admin.building-data']);
  });

  $routes->group('', ['filter' => 'admin:guest'], function($routes) {
    $routes->get('login', 'AdminController::login', ['as' => 'admin.login']);
    $routes->post('login-handler', 'AdminController::loginHandler', ['as' => 'admin.login-handler']);
  });
});