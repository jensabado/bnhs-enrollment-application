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
    $routes->get('room', 'RoomController::room', ['as' => 'admin.room']);
    $routes->post('room-data', 'RoomController::datatable', ['as' => 'admin.room-data']);
    $routes->post('add-room', 'RoomController::addRoom', ['as' => 'admin.add-room']);
    $routes->post('get-room-data', 'RoomController::getRoomData', ['as' => 'admin.get-room-data']);
    $routes->post('edit-room', 'RoomController::editRoom', ['as' => 'admin.edit-room']);
    $routes->post('delete-room', 'RoomController::deleteRoom', ['as' => 'admin.delete-room']);
    $routes->get('section', 'SectionController::section', ['as' => 'admin.section']);
    $routes->post('get-room-option', 'SectionController::getRoomOption', ['as' => 'admin.get-room-option']);
    $routes->post('section-data', 'SectionController::datatable', ['as' => 'admin.section-data']);
    $routes->post('add-section', 'SectionController::addSection', ['as' => 'admin.add-section']);
    $routes->post('get-section-data', 'SectionController::getSectionData', ['as' => 'admin.get-section-data']);
  });

  $routes->group('', ['filter' => 'admin:guest'], function($routes) {
    $routes->get('login', 'AdminController::login', ['as' => 'admin.login']);
    $routes->post('login-handler', 'AdminController::loginHandler', ['as' => 'admin.login-handler']);
  });
});