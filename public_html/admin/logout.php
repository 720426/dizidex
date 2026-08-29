<?php
require_once '../includes/auth.php';
logoutUser();
header('Location: /admin/login.php');
exit;
