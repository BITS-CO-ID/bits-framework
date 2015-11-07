<?php
/**
* Header
*/
$this->partial('app/views/themes/default/header.php');

/**
* Page Content
*/
$this->yieldView();

/**
* Footer
*/
$this->partial('app/views/themes/default/footer.php');
