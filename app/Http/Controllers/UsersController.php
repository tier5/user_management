<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
public function adduserview()
{
	return view('Admin.adduser');
}

public function viewusertable()
{
	if(count(User::all())>1){
		$users=User::all();
		$blocked=User::where('blocked_status','=',1)->get();

		return view('Admin.view_user_table',compact('users','blocked'));
	}
	else
	{
		return view('Admin.view_user_table');
	}
}

public function insertuser(Request $request)
{

	$this->validate($request,[
		'first_name'=>'required',
        'last_name'=>'required',
       	'email'=>'required|email|unique:users',
       	'phone_number'=>'required|unique:users|size:10',
       	'address'=>'required',
       	'city'=>'required',
       	'state'=>'required',
       	'zip'=>'required',
       	'password'=>'required'
		]);
	$user=new User();
	$user->first_name=$request->first_name;
	$user->last_name=$request->last_name;
	$user->user_name=$request->first_name.rand(0,100);
	$user->email=$request->email;
	$user->phone_number=$request->phone_number;
	$user->address=$request->address;
	$user->city=$request->city;
	$user->state=$request->state;
	$user->zip=$request->zip;
	$user->password=bcrypt($request->password);
	$user->role=2;
	$user->blocked_status=0;
	if($user->save())
	{
		return redirect()->route('add_user_admin')->with('success','user added successfully');
	}
	else
	{
		return redirect()->route('add_user_admin')->with('error','user not added');
	
	}
}

public function viewuser(User $id)
{

return view('Admin.view_user',compact('id'));
}

public function deleteuser(User $id)
{

$user=User::find($id->id);

if($user->delete())
{
	return redirect()->route('view_table_user_admin');
}
else
{
	return redirect()->route('view_table_user_admin')->with('error','Not Deleted');
}
}

public function edituser(User $id)
{

return view('Admin.updateuser',compact('id'));
}

public function updateuser(Request $request)
{

	$this->validate($request,[
		'first_name'=>'required',
        'last_name'=>'required',
       	'email'=>'required|email|unique:users,id',
       	'phone_number'=>'required|unique:users,id|size:10',
       	'address'=>'required',
       	'city'=>'required',
       	'state'=>'required',
       	'zip'=>'required'
    
		]);
	$user=User::find($request->id);
	$user->first_name=$request->first_name;
	$user->last_name=$request->last_name;
	$user->user_name=$request->first_name.rand(0,100);
	$user->email=$request->email;
	$user->phone_number=$request->phone_number;
	$user->address=$request->address;
	$user->city=$request->city;
	$user->state=$request->state;
	$user->zip=$request->zip;
	$user->password=bcrypt($request->password);
	$user->role=2;
	$user->blocked_status=0;
	if($user->update())
	{
		return redirect()->route('view_table_user_admin')->with('success','user added successfully');
	}
	else
	{
		return redirect()->route('view_table_user_admin')->with('error','user not added');
	
	}
}

public function blockuser(User $id)
{

$user=User::find($id);
$user->blocked_status=1;
if($user->update())
	{
		return redirect()->route('view_table_user_admin')->with('success','user blocked successfully');
	}
	else
	{
		return redirect()->route('view_table_user_admin')->with('error','user not blocked');
	
	}
}



}
