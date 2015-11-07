<?php
use BITS\BITS;

/**
 * POST API Method Request
 */
$this->respond('POST', '/users/?', function ($request, $response, $service) {
    // Script POST Method add users.
    //BITS::add('users', ['username', 'password', 'name', 'address']);
});

/**
 * GET API Method Request
 */
$this->respond('GET', '/users/?', function ($request, $response, $service) {
    // Fetch users table database and return to $this->users
    $service->users = BITS::allApi('users');
    return $service->users;
});
