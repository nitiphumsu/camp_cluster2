<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('TRS_C_Clicknext');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->get('TRS_V_login', 'TRS_C_Clicknext::login');
$routes->get('TRS_V_logout', 'TRS_C_Clicknext::logout');
$routes->post('check_login', 'TRS_C_Clicknext::check_login');
$routes->get('TRS_V_status', 'TRS_C_Clicknext::status');
$routes->get('TRS_V_dashboard', 'TRS_C_Clicknext::dashboard');
$routes->get('TRS_V_withdraw', 'TRS_C_Clicknext::withdraw');
$routes->get('TRS_V_approve', 'TRS_C_Clicknext::approve');
$routes->get('add_approve', 'TRS_C_Clicknext::add_approve');
$routes->get('edit', 'TRS_C_Clicknext::edit');
$routes->get('pdf', 'TRS_C_Clicknext::pdf');
$routes->get('template_w', 'TRS_C_Clicknext::template_w');
$routes->get('template_og', 'TRS_C_Clicknext::template_og');
$routes->post('insert_user', 'TRS_C_Clicknext::insert_user');
$routes->get('TRS_V_history', 'TRS_C_Clicknext::history');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
