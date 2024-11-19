<?php

require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../Model/Users.php";


$users = new Users();
$users->logout();

header("Location: login.php");
exit;