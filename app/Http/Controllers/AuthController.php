<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    
    	$name=$request->name;
    	$password=$request->password;

    	if($name&&$password){
    	  $validate=[
    	    	'user_name'=>$name,	
    	    	'password'=>$password
    	    	    ];
    	  if(Auth::validate($validate))
    	    {
    	      if(Auth::attempt($validate))
    	    	 {
    	    	 	if(Auth::user()->role==1)
    	    	 		{return redirect()->intended("/adminhome");}
    	    	 	else if(Auth::user()->role==2)
    	    	 		{
    	    	 		if(Auth::user()->blocked_status==1){
    	    	 		 return redirect()->route("login_page")->with("error","Blocked User");
    	    	 		}
    	    	 		else
    	    	 		{
    	    	 			return redirect()->intended("/home");
    	    	 		}
    	    	 		}
    	    	 	else
    	    	 		{
    	    	 		return redirect()->route("login_page")->with("error","Invalid Username Or Password");
    	    	 		}
    	
    	    	 }
    		  else
    	    	 {
    	    	 	return redirect()->route("login_page")->with("error","Invalid Username Or Password");
    	    	 }
    		}
    		else
    		{
    			return redirect()->route("login_page")->with("error","Invalid Username Or Password");
    		}   

    	}
    	else if(!$name)
    		{
    			return redirect()->route("login_page")->with("error","Insert Username");
    		}  
    	else if(!$address)
    		{
    			return redirect()->route("login_page")->with("error","Insert Password");
    		}
    	else 
    		{
    			return redirect()->route("login_page")->with("error","Invalid Username And Password");
    		}  	  

	}

public function logout()
{
	Auth::logout();
	return redirect()->route("login_page");
}

public function back()
{
	return redirect()->route('login_page');
}
}