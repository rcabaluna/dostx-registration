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
$routes->get('/rhrc','Home::index');
$routes->get('/rhrc/registration/', 'Registration::event');
$routes->post('rhrc/reg-process', 'Registration::registerProccess');
$routes->get('rhrc/qr-code/(:any)', 'Registration::QRCode');
$routes->get('rhrc/find-qr', 'Registration::findQR');
$routes->post('rhrc/find-qr-process', 'Registration::findQRProcess');
$routes->get('rhrc/get-provinces-list', 'Registration::getProvincesList');


# WALK-IN REGISTRATION
$routes->get('/rhrc/w-registration/event/(:any)', 'Registration::walkinRegistration/$1');
$routes->post('rhrc/w-reg-process', 'Registration::walkinRegistrationProcess');


$routes->get('rhrc/participants', 'Participants::index',['filter' => 'authGuard']);
$routes->get('rhrc/participants/delete', 'Participants::deleteParticipant');

$routes->get('rhrc/attendance', 'Attendance::index',['filter' => 'authGuard']);
$routes->get('rhrc/attendance/delete', 'Attendance::deleteAttendance');

$routes->get('rhrc/81525e75be630cc750ea7beeb81f2de1', 'Attendance::scanQRCode',['filter' => 'authGuard']);
$routes->post('rhrc/confirm-attendance', 'Attendance::AttendanceConfirm');     
$routes->post('rhrc/save-attendance', 'Attendance::AttendanceSave');     

$routes->get('rhrc/admin/dashboard','Dashboard::index',['filter' => 'authGuard']);

$routes->match(['get','post'],'rhrc/login','Home::login');
$routes->match(['get','post'],'rhrc/logout','Home::logout');


$routes->get('rhrc/registration/links','Admin::registrationList',['filter' => 'authGuard']);
$routes->get('/rhrc/registration/w-list','Admin::registrationWalkInList',['filter' => 'authGuard']);
$routes->get('rhrc/evaluation/links','Admin::evaluationList',['filter' => 'authGuard']);

# EVALUATION
$routes->get('/rhrc/evaluation', 'Evaluation::index');
$routes->post('rhrc/evaluation-process', 'Evaluation::evaluationProccess');
$routes->get('rhrc/evaluation-test', 'Evaluation::test');



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
