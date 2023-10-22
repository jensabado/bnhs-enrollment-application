<?php 

$routes->group('admin', function($routes) {
  $routes->group('', ['filter' => 'admin:auth'], function($routes) {
    $routes->get('', 'AdminController::index', ['as' => 'admin.home']);
    $routes->get('logout', 'AdminController::logout', ['as' => 'admin.logout']);
    $routes->get('building', 'BuildingController::index', ['as' => 'admin.building']);
    $routes->post('building-data', 'BuildingController::datatable', ['as' => 'admin.building-data']);
    $routes->post('add-building', 'BuildingController::addBuilding', ['as' => 'admin.add-building']);
    $routes->post('get-building-data', 'BuildingController::getBuildingData', ['as' => 'admin.get-building-data']);
    $routes->post('edit-building', 'BuildingController::editBuilding', ['as' => 'admin.edit-building']);
    $routes->post('delete-building', 'BuildingController::deleteBuilding', ['as' => 'admin.delete-building']);
  });

  $routes->group('', ['filter' => 'admin:guest'], function($routes) {
    $routes->get('login', 'AdminController::login', ['as' => 'admin.login']);
    $routes->post('login-handler', 'AdminController::loginHandler', ['as' => 'admin.login-handler']);
  });
});