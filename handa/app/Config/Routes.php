<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('handa/','Home::index');
$routes->get('/handa/registration/event/(:any)', 'Registration::event/$1');
$routes->post('handa/reg-process', 'Registration::registerProccess');
$routes->get('handa/qr-code/(:any)', 'Registration::QRCode');
$routes->get('handa/find-qr', 'Registration::findQR');
$routes->post('handa/find-qr-process', 'Registration::findQRProcess');
$routes->get('handa/get-provinces-list', 'Registration::getProvincesList');


# WALK-IN REGISTRATION
$routes->get('/handa/w-registration/event/(:any)', 'Registration::walkinRegistration/$1');
$routes->post('handa/w-reg-process', 'Registration::walkinRegistrationProcess');


$routes->get('handa/participants', 'Participants::index',['filter' => 'authGuard']);
$routes->get('handa/participants/delete', 'Participants::deleteParticipant');

$routes->get('handa/attendance', 'Attendance::index',['filter' => 'authGuard']);
$routes->get('handa/attendance/delete', 'Attendance::deleteAttendance');

$routes->get('handa/81525e75be630cc750ea7beeb81f2de1', 'Attendance::scanQRCode',['filter' => 'authGuard']);
$routes->post('handa/confirm-attendance', 'Attendance::AttendanceConfirm');     
$routes->post('handa/save-attendance', 'Attendance::AttendanceSave');     

$routes->get('handa/admin/dashboard','Dashboard::index',['filter' => 'authGuard']);

$routes->match(['get','post'],'handa/login','Home::login');
$routes->match(['get','post'],'handa/logout','Home::logout');


$routes->get('handa/registration/links','Admin::registrationList',['filter' => 'authGuard']);
$routes->get('/handa/registration/w-list','Admin::registrationWalkInList',['filter' => 'authGuard']);
$routes->get('handa/evaluation/links','Admin::evaluationList',['filter' => 'authGuard']);

# EVALUATION
$routes->get('/handa/evaluation', 'Evaluation::index');
$routes->post('handa/evaluation-process', 'Evaluation::evaluationProccess');
$routes->get('handa/evaluation-test', 'Evaluation::test');
$routes->get('handa/export-db', 'Home::exportDB');




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

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
