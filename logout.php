<?php
require_once 'core/init.php';

$user = new User();
$user->logout();

Session::flash('logout', 'You have been successfully logged out!');
Redirect::to('login_process.php');