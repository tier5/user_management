<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
   	return view('Login.login');
   }

    public function homepageadmin()
   {
   	return view('Admin.master');
   }

   public function homepageuser()
   {
   	return view('User.user_home');
   }
    
}
