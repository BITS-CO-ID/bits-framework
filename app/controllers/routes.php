<?php
use BITS\BITS;
use BITS\Auth;

/**
 * Uncomment if use database connections.
 * Please go to app/config/config.php & edit your database connection.
 */
//new BITS;

/*
 * Default Page Controller.
 */
$route->respond('/', function ($request, $response, $service) {
    // Title Tag
    $service->title = 'BITS Framework';

    // Master Layout
    $service->layout('app/views/layouts/default.php');

    // Content View
    $service->render('app/views/welcome.php');
});

/*
 * Login Page Controller.
 */
$route->respond('/login/?', function ($request, $response, $service) {
    $service->title = 'BITS Framework - System Login';
    $service->render('app/views/login.php');
});

/*
 * Check and Validate user login.
 * If user successfully logged in, redirect to dashboard.
 * If username or password not match in database, create flash message session.
 */
$route->respond('POST', '/login/?', function ($request, $response, $service) {
    if (isset($_POST['submit'])) {
        Auth::login("users", $_POST['username'], $_POST['password']);
        if (isset($_SESSION['salt']) && isset($_SESSION['username'])) {
            Auth::redirect('/system/dashboard/');
        } else {
            Auth::redirect('/login/');
        }
    }
});

/*
 * Logout Page Controller.
 * Destroy all session and redirect to login page.
 */
$route->respond('/logout/?', function ($request, $response, $service) {
    Auth::logout();
    Auth::redirect('/');
});

/*
 * Initialize controllers with some service and default layout.
 * Add controller to this block or separate use loop controllers.
 */
$route->respond(function ($request, $response, $service, $app) use ($route) {

    /*
     * Handle Error Exception message to all controllers.
     */
    $route->onError(function ($route, $err_msg) {
        $route->service()->flash($err_msg);
        $route->service()->back();
    });

    /*
     * Register default master layout to all controllers.
     */
    $service->layout('app/views/layouts/default.php');
});

/*
 * Asign controller using loop data to fetch all files.
 * Controller directory can access to "controllers".
 * Name of url and controller must same and separated by comma.
 *
 * Ex. foreach(array('users', 'article') as $controller)
 */
foreach (array('users', 'api') as $controller) {
    /*
     * Asign url and file controller.
     */
    $route->with("/$controller", "app/controllers/$controller.php");
}

if (isset($_SESSION['salt']) && isset($_SESSION['username'])) {
    foreach (array('dashboard', 'settings') as $controller) {
        $route->with("/system/$controller", "app/controllers/system/$controller.php");
    }
}

/*
 * Route all error request to error page.
 */
$route->onHttpError(function ($code, $router) {
    if ($code >= 400 && $code < 500) {
        include 'app/views/layouts/error.php';
    } elseif ($code >= 500 && $code <= 599) {
        include 'app/views/layouts/error.php';
    }
});
