<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('404', 'Dashboard::error404');
$routes->get('dashboard-admin', 'Dashboard::admin');
$routes->get('dashboard-guru', 'Dashboard::guru');
$routes->get('dashboard-siswa', 'Dashboard::siswa');

$routes->set404Override(function () {
    echo view('404');
});
