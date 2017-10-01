<?php
require_once 'dbconfig.php';

$user->logout();
$user->redirect('login.php');
?>