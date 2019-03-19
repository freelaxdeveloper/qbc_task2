<?php
require_once '../../vendor/autoload.php';
require_once '../../sys/start.php';

use App\Models\User;
use App\Models\ManualType;

$user_id = (integer) $_GET['id'];

$manualtypes = ManualType::valueByUser($user_id)->get();

$user = User::find($user_id);


echo view('people.view', compact('user', 'manualtypes'));