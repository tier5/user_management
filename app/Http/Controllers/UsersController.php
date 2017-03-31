<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

class UsersController extends Controller
{
	public function adduserview()
	{
		return view('Admin.adduser');
	}



	public function viewusertable()
	{
			if(count(User::all())>1)
			{
				$users=User::paginate(5);
				$blocked=User::where([['blocked_status','=',1],['deleted_status','=',0]])->paginate(5);

				return view('Admin.view_user_table',compact('users','blocked'));
			}
			else
			{
				return view('Admin.view_user_table');
			}
	}



	public function insertuser(Request $request)
	{

		if($request->hasFile('image_upload'))
		{

			$file=$request->file('image_upload');
			$file_name=File::name($file->getClientOriginalName()).uniqid().time().".".$file->getClientOriginalExtension();
			
			if(!file_exists(public_path().'/image/'))
				{
					mkdir(public_path().'/image/',0777,true);
				}


			if(!file_exists(public_path().'/image/fullsize/'))
				{
					mkdir(public_path().'/image/fullsize/',0777,true);
				}


			$file->move(public_path().'/image/fullsize/',$file_name);


			if(!file_exists(public_path().'/image/100x100/'))
			{
				mkdir(public_path().'/image/100x100/',0777,true);
			}


			$image1=Image::make(public_path('/image/fullsize/'.$file_name))->resize(100,100)->save(public_path('image/100x100/'.$file_name));


			if(!file_exists(public_path().'/image/500x500/'))
			{
				mkdir(public_path().'/image/500x500/',0777,true);
			}


			$image2=Image::make(public_path().'/image/fullsize/'.$file_name)->resize(500,500)->save(public_path('image/500x500/'.$file_name));
			
			
			

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
		$user->deleted_status=0;
		if($user->save())
			{

				Mail::to($user->email)->send(new Welcome($user));

				return redirect()->route('add_user_admin')->with('success','user added successfully');
			}
		else
			{
				return redirect()->route('add_user_admin')->with('error','user not added');
			
			}
		}
		else
			{
				return redirect()->route('add_user_admin')->with('error','No Files Present');	
			}
	}


	public function viewuser(Request $request)
	{
		if($request->id)
			{
				$user=User::find($request->id);
				return json_encode($user);
			}
		else
			{
				return 'error';
			}
	}



	public function deleteuser(Request $request)
	{

		if($request->id){

			$user=User::find($request->id);
			$user->deleted_status=1;
			if($user->update())
				{
					return 'success';
				}
			else
				{
					return 'error';
				}
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
	       	'zip'=>'required',
	   		'password'=>'required'
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
		$user->deleted_status=0;
		if($user->update())
		{
			return redirect()->route('view_table_user_admin')->with('update_success','user updated successfully');
		}
		else
		{
			return redirect()->route('view_table_user_admin')->with('update_error','user not updated');
		
		}
	}

	public function blockuser(Request $request)
		{
			if($request->id)
			{
				$user=User::find($request->id);
				$user->blocked_status=1;
				if($user->update())
					{
						return 'success';
					}
				else
					{
						return 'error';
					}

			}

		}



	public function unblockuser(Request $request)
	{
		if($request->id)
		{
			$user=User::find($request->id);
			$user->blocked_status=0;
			if($user->update())
				{
					return 'success';
				}
			else
				{
					return 'error';
				}

		}

	}	



	public function searchuser(Request $request)
	{

		if($request->username)
		{
			$user=User::where('user_name','=',$request->username)->first();
			if($user)
				{
					return json_encode($user);
				}
			else
				{
					return "error";
				}
		}

	}

}
