<?php namespace App\Controllers;

use App\Models\User;

class HomeController {

  public function index()
  {
    $users = User::get();

    return view('home', ['users' => $users]);
  }
}