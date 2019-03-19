<?php
require_once 'vendor/autoload.php';
require_once 'sys/start.php';

use App\Models\User;
use App\Models\ManualType;

$user_id = (integer) $_GET['id'];

$manualtypes = ManualType::with(['manuals' => function ($query) use ($user_id){
    return $query->with(['value' => function ($query) use ($user_id){
        return $query->whereUserId($user_id)->whereValue('Кот Вася');
    }]);
}])->get();

dd2($manualtypes->toArray());

$user = User::find($user_id);


echo view('user', compact('user'));