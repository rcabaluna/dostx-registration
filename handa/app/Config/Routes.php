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
// $routes->get('/handa','Home::index');
$routes->get('/registration/event/(:any)', 'Registration::event/$1');
$routes->post('/reg-process', 'Registration::registerProccess');
$routes->get('/qr-code/(:any)', 'Registration::QRCode');
$routes->get('/find-qr', 'Registration::findQR');
$routes->post('/find-qr-process', 'Registration::findQRProcess');
$routes->get('/get-provinces-list', 'Registration::getProvincesList');


# WALK-IN REGISTRATION
$routes->get('/w-registration/event/(:any)', 'Registration::walkinRegistration/$1');
$routes->post('/w-reg-process', 'Registration::walkinRegistrationProcess');


$routes->get('/participants', 'Participants::index',['filter' => 'authGuard']);
$routes->get('/participants/delete', 'Participants::deleteParticipant');


# ATTENDANCE
$routes->get('/attendance', 'Attendance::index',['filter' => 'authGuard']);
$routes->get('/attendance/delete', 'Attendance::deleteAttendance');

$routes->get('attendance/m-scan-qr', 'Attendance::scanQRCode',['filter' => 'authGuard']);
$routes->post('/confirm-attendance', 'Attendance::AttendanceConfirm');     
$routes->post('/save-attendance', 'Attendance::AttendanceSave');     

# ATTENDANCE BY SEARCH
$routes->get('/attendance/search-user', 'Attendance::AttendanceSearchUser');     
$routes->post('/attendance/confirm-att-search', 'Attendance::AttendanceConfirmBySearch');     
$routes->post('/attendance/confirm-other-forum', 'Attendance::ConfirmOtherForum');     

# DASHBOARD
$routes->get('/admin/dashboard/reg-att','Dashboard::regAtt',['filter' => 'authGuard']);
$routes->get('/admin/dashboard/evaluation','Dashboard::evaluation',['filter' => 'authGuard']);


$routes->match(['get','post'],'/login','Home::login');
$routes->match(['get','post'],'/logout','Home::logout');


$routes->get('/registration/links','Admin::registrationList',['filter' => 'authGuard']);
$routes->get('/registration/w-list','Admin::registrationWalkInList',['filter' => 'authGuard']);
$routes->get('/registration/change-status/(:any)','Admin::changeRegistrationStatus/$1',['filter' => 'authGuard']);

# EVALUATION
$routes->get('/evaluation', 'Evaluation::index');
$routes->post('/evaluation-process', 'Evaluation::evaluationProccess');
$routes->get('/evaluation-success/','Evaluation::evaluationSuccess');
$routes->get('/evaluation/links','Admin::evaluationList',['filter' => 'authGuard']);
$routes->get('/evaluation/participants', 'Evaluation::participants',['filter' => 'authGuard']);
$routes->get('/evaluation/delete', 'Evaluation::deleteEvaluation');

#CERTIFICATES
$routes->get('/certificates/cp','Certificates::certParticipation');
$routes->get('/certificates/ca','Certificates::certApperance');


#FOOD
$routes->get('food-redeem', 'Food::index',['filter' => 'authGuard']);
$routes->get('food/m-scan-qr', 'Food::scanQRCode',['filter' => 'authGuard']);
$routes->post('/confirm-food', 'Food::FoodConfirm');     
$routes->post('/save-redeem', 'Food::RedeemSave');  
$routes->get('/food/delete', 'Food::deleteRedeem');


$routes->get('user-links','Admin::userLinksDeck',['filter' => 'authGuard']);




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
