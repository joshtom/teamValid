<?php
session_start();
require "./config/connection.php";
include "controllers/validation.php";
include "controllers/user.php";
$errors = array();
$log_errors = array();

?>