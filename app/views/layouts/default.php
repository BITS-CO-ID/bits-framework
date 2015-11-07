<?php
/**
* Header
*/
$this->partial('app/views/layouts/partials/header.php');

/**
* Page Content
*/
$this->yieldView();

/**
* Footer
*/
$this->partial('app/views/layouts/partials/footer.php');
