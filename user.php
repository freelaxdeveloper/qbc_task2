<?php
require_once 'vendor/autoload.php';
require_once 'sys/start.php';

use App\Models\User;
use App\Models\ManualType;
//dd2($_GET);
$manualtypes = ManualType::all();
$user_id = (integer) $_GET['id'];
$user = User::find($user_id);


echo view('user', compact('user'));