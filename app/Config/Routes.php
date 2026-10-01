<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('app-data', 'Home::appData');
$routes->get('app-list', 'Home::appList');
$routes->get('drafts', 'Home::drafts');
$routes->get('returned-app', 'Home::returnedApp');