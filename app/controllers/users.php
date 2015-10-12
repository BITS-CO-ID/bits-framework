<?php
use BITS\BITS;

/**
 * POST Method Request
 */
$this->respond('POST', '/?', function ($request, $response, $service) {
    // Script POST Method add users.
    //BITS::add('users', ['username', 'password', 'name', 'address']);
});

/**
 * GET Method Request
 */
$this->respond('GET', '/?', function ($request, $response, $service) {
    // Title
    $service->title = 'Users Management';

    // Fetch users table database and return to $this->users
    $service->users = BITS::all('users');

    // Render User template views.
    $service->render('app/views/users.php');
});
