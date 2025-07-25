<?php

namespace Config;

use App\Controllers\Student;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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

/*
 * Routes for Auth
 */
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/password', 'Auth::password');
$routes->post('/auth/sendResetLink', 'Auth::sendResetLink');
$routes->get('/auth/resetPassword/(:any)', 'Auth::resetPassword/$1');

$routes->get('/twofa', 'Auth::twoFA');
$routes->post('/verify-2fa', 'Auth::verify2FA');
$routes->get('/resend-2fa-code', 'Auth::resend2FACode');

/*
 * Routes for Student
 */
$routes->get('/', 'Student::index');
$routes->get('/student', 'Student::show', ['filter' => 'authGuard']);
$routes->post('/student', 'Student::insert', ['filter' => 'authGuard']);
$routes->get('/student/edit/(:num)', 'Student::edit/$1', ['filter' => 'authGuard']);
$routes->post('/student/edit/(:num)', 'Student::update/$1', ['filter' => 'authGuard']);
$routes->delete('/student/delete/(:num)', 'Student::delete/$1', ['filter' => 'authGuard']);

$routes->get('/profile/edit/(:num)', 'Profile::edit/$1', ['filter' => 'authGuard']);
$routes->post('/profile/edit/(:num)', 'Profile::update/$1', ['filter' => 'authGuard']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);

$routes->get('/logbook', 'logbook::index', ['filter' => 'authGuard']);
$routes->get('/logbook', 'logbook::insert', ['filter' => 'authGuard']);
$routes->get('/logbook/(:num)', 'logbook::taskdetail/$1', ['filter' => 'authGuard']);

$routes->get('/task/new/(:any)', 'Task::index', ['filter' => 'authGuard', 'as' => 'task.new']);
$routes->post('/task/new/(:any)', 'Task::store/$1', ['filter' => 'authGuard', 'as' => 'task.store']);
$routes->get('/task/detail/(:any)', 'Task::edit/$1', ['filter' => 'authGuard', 'as' => 'task.edit']);
$routes->post('/task/detail/(:any)', 'Task::update/$1', ['filter' => 'authGuard', 'as' => 'task.update']);
$routes->post('/task/file/(:any)', 'Task::updatefile/$1', ['filter' => 'authGuard', 'as' => 'task.file']);
$routes->get('/task/show/(:any)', 'Task::show/$1', ['filter' => 'authGuard', 'as' => 'task.show']);
$routes->delete('/task/delete/(:any)', 'Task::delete/$1', ['filter' => 'authGuard', 'as' => 'task.delete']);

/*
 * Routes for Chats
 */
$routes->get('/chat/(:any)', 'Chat::index/$1', ['filter' => 'authGuard']);
$routes->get('/chatlect/(:any)', 'Chat::indexlect/$1', ['filter' => 'authGuard']);
$routes->post('/message', 'Chat::insert', ['filter' => 'authGuard']);
$routes->get('/chat/fetchMessages/(:num)', 'Chat::fetchMessages/$1', ['filter' => 'authGuard']);
$routes->get('/fetchMessages', 'Chat::fetchMessages', ['filter' => 'authGuard']);

$routes->post('/newmessage', 'Chat::new', ['filter' => 'authGuard']);

/*
 * Routes for Lecturer
 */
$routes->post('/update/task/(:any)', 'Task::remark/$1', ['filter' => 'authGuard']);
$routes->post('/intern/update/visit/(:num)', 'Student::updatevisit/$1', ['filter' => 'authGuard']);
$routes->post('/intern/update/report/(:num)', 'Student::updatereport/$1', ['filter' => 'authGuard']);

/*
 * Routes for Admin
 */
$routes->get('/admin/dashboard', 'Admin::dashboard', ['filter' => 'adminGuard']);
$routes->get('/admin/student', 'Admin::studentlist', ['filter' => 'adminGuard']);
$routes->get('/admin/deleteStudent/(:num)', 'Admin::deleteStudent/$1', ['filter' => 'adminGuard']);
$routes->get('/admin/lecturer', 'Admin::lecturerlist', ['filter' => 'adminGuard']);
$routes->get('/admin/deleteLecturer/(:num)', 'Admin::deleteLecturer/$1', ['filter' => 'adminGuard']);
$routes->post('admin/assignLecturer', 'Admin::assignLecturer', ['filter' => 'adminGuard']);
$routes->post('admin/changeStartDate', 'Admin::changeStartDate', ['filter' => 'adminGuard']);
$routes->post('admin/changeEndDate', 'Admin::changeEndDate', ['filter' => 'adminGuard']);
$routes->get('/admin/reset/(:num)', 'Admin::reset/$1', ['filter' => 'adminGuard']);
$routes->get('/admin/auditlog', 'Admin::auditLog', ['filter' => 'adminGuard']);
$routes->post('/admin/deleteActiveSession/(:num)', 'Admin::deleteActiveSession/$1', ['filter' => 'adminGuard']);

$routes->get('/register', 'Auth::register', ['filter' => 'adminGuard']);
$routes->post('/register', 'Auth::attemptRegister', ['filter' => 'adminGuard']);
$routes->get('/register/lecturer', 'Auth::registerlect', ['filter' => 'adminGuard']);
$routes->post('/register/lecturer', 'Auth::attemptRegisterlect', ['filter' => 'adminGuard']);
$routes->get('/register/lecturer/(:any)', 'Auth::registerlect/$1', ['filter' => 'adminGuard']);
$routes->post('/register/lecturer/(:any)', 'Auth::attemptRegisterlect', ['filter' => 'adminGuard']);

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
