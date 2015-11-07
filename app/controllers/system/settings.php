<?php
use BITS\BITS;

/**
 * GET Method Request
 */
$this->respond('GET', '/?', function ($request, $response, $service) {
    // Title
    $service->title = 'System Settings';

    // Fetch users table database and return to $this->users
    $service->users = BITS::all('users');

    // Render User template views.
    $service->render('app/views/welcome.php');
});
