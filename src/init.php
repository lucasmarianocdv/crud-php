<?php

session_start();

require_once __DIR__ . '/config/database.php';       
require_once __DIR__ . '/services/DatabaseService.php';
require_once __DIR__ . '/helpers/Validation.php'; 
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/controllers/UserController.php';

$controller = new UserController();

require_once __DIR__ . '/routes/web.php';           
