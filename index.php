<?php
require_once 'vendor/autoload.php';
require_once 'sys/start.php';

use App\Models\User;

$users = User::get();

echo view('home', ['users' => $users]);