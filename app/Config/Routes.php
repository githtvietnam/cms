<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Frontend/Homepage/Home::index');
$routes->get('lich-tong-hop.html', 'Frontend\Homepage\Router::list/$1');
$routes->get('lich-tong-hop/trang-([0-9]+).html', 'Frontend\Homepage\Router::list/$1/$2');
$routes->get('/admin', 'Backend/Authentication/Auth::login',['filter' => 'login' ]);
$routes->get('([a-zA-Z0-9-]+).html', 'Frontend\Homepage\Router::index/$1');
$routes->get('([a-zA-Z0-9-]+)/trang-([0-9]+).html', 'Frontend\Homepage\Router::index/$1/$2');


$routes->get('([a-zA-Z0-9-]+)/([a-zA-Z0-9-]+).html', 'Frontend\Homepage\Router::silo/$1/$2');

$routes->get(BACKEND_DIRECTORY, 'Backend/Authentication/Auth::login', ['filter' => 'login' ]);
$routes->get('backend/authentication/auth/forgot', 'Backend/Authentication/Auth::forgot', ['filter' => 'login' ]);
$routes->get('backend/authentication/auth/logout', 'Backend/Authentication/Auth::logout', ['filter' => 'auth' ]);
$routes->match(['get','post'],'backend/dashboard/dashboard/index', 'Backend/Dashboard/Dashboard::index', ['filter' => 'auth']);

/*USER*/
$routes->group('backend/user/user', ['filter' => 'auth'] , function($routes){
    $routes->add('index', 'Backend/User/User::index');
    $routes->add('create', 'Backend/User/User::create');
    $routes->add('update', 'Backend/User/User::update');
    $routes->add('delete', 'Backend/User/User::delete');
});
/*Slide*/
$routes->group('backend/slide/slide', ['filter' => 'auth'] , function($routes){
    $routes->add('index', 'Backend/Slide/Slide::index');
    $routes->add('create', 'Backend/Slide/Slide::create');
    $routes->add('update', 'Backend/Slide/Slide::update');
    $routes->add('delete', 'Backend/Slide/Slide::delete');
});






/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
