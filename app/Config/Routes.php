<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

foreach(glob(APPPATH . 'Config/Routes/*.php') as $file) {
  include $file;
}
