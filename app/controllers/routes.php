<?php

use BITS\BITS;
/**
 * Uncomment if use database connections.
 * Please go to app/config/config.php & edit your database connection.
 */
//new BITS;

/*
 * Default Page.
 */
$route->respond('/', function ($request, $response, $service) {
    // Title Tag
    $service->title = 'BITS Framework';

    // Master Layout
    $service->layout('app/views/layouts/default.php');

    // Index View
    $service->render('app/views/welcome.php');
});

/*
 * Initialize controllers with some service and default layout.
 * Add controller to this block or separate use loop controllers.
 */
$route->respond(function ($request, $response, $service, $app) use ($route) {

    /*
     * Register some services such CRUD Service or other services to controllers.
     * All services can access with "$app->nameofservices".
     */
    //$app->register('data', function () {
        //$db = new BITS();
        //return $db;
    //});

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
foreach (array('users') as $controller) {
    /*
     * Asign url and file controller.
     */
    $route->with("/$controller", "app/controllers/$controller.php");
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
