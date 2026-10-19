<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->match(['get', 'post'], '/store', 'UserController::store');
$routes->match(['get', 'post'], '/', 'UserController::signin');
$routes->match(['get', 'post'], '/login', 'UserController::login');
$routes->match(['post'], '/logout', 'UserController::logout');
$routes->match(['get', 'post'], '/workers', 'WorkerController::workerDashboard');
$routes->match(['get', 'post'], '/user', 'CustomerController::userDashboard');
$routes->match(['get', 'post'], '/head_admin', 'HeadAdminController::index');
$routes->match(['get', 'post'], '/head_admin/add_worker', 'HeadAdminController::add_worker');
$routes->match(['get', 'post'], '/head_admin/delete/(:num)', 'HeadAdminController::delete/$1');
$routes->match(['get', 'post'], '/head_admin/edit/(:num)', 'HeadAdminController::edit/$1');
$routes->match(['get', 'post'], '/head_admin/update/(:num)', 'HeadAdminController::update/$1');
$routes->match(['get', 'post'], '/head_admin/edit_menu/(:num)', 'HeadAdminController::edit_menu/$1');
$routes->match(['get', 'post'], '/head_admin/update_menu/(:num)', 'HeadAdminController::update_menu/$1');
$routes->match(['get', 'post'], '/head_admin/delete_menu/(:num)', 'HeadAdminController::delete_menu/$1');
$routes->match(['get', 'post'], '/head_admin/add_menu/(:num)', 'HeadAdminController::add_menu/$1');
$routes->post('head_admin/add_menu', 'HeadAdminController::add_menu');
$routes->match(['get', 'post'], '/head_admin/edit_booking/(:num)', 'HeadAdminController::edit_booking/$1');
$routes->match(['get', 'post'], '/head_admin/update_booking/(:num)', 'HeadAdminController::update_booking/$1');
$routes->match(['get', 'post'], '/head_admin/delete_booking/(:num)', 'HeadAdminController::delete_booking/$1');
$routes->get('head_admin/edit_user/(:num)', 'HeadAdminController::edit_user/$1');
$routes->post('head_admin/delete/(:num)', 'HeadAdminController::delete_user/$1');
$routes->post('head_admin/update_user/(:num)', 'HeadAdminController::update_user/$1');
$routes->get('head_admin/update_user/(:num)', 'HeadAdminController::update_user/$1');
$routes->get('head_admin/edit_booking/(:num)', 'HeadAdminController::edit_booking/$1');
$routes->post('head_admin/delete_booking/(:num)', 'HeadAdminController::delete_booking/$1');
$routes->match(['get', 'post'], '/customers/update/', 'CustomerController::update');
$routes->post('/customer/updateProfile', 'CustomerController::updateProfile');
$routes->get('customer/addBookingForm', 'CustomerController::addBookingForm');
$routes->post('customer/addBooking', 'CustomerController::addBooking');
$routes->get('user', 'CustomerController::userDashboard');
$routes->get('customer/addBookingForm', 'CustomerController::addBookingForm');
$routes->post('customer/addBooking', 'CustomerController::addBooking');

