@extends('Admin.master')

@section('content')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users"></i> USERS</h3>
                            </div>
                            <div class="panel-body">
                                
                     <div class="row">
                    <div class="col-lg-6">
                        <h2>USERS</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th colspan="3"><center>ACTION</center></th>
                                        <th>Block</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @if(isset($users))
                                	@foreach($users as $user)
                                		@if($user->id!=1)
                                			@if($user->blocked_status!=1)
                                    	<tr>
                                        	<td>{{$user->user_name}}</td>
                                        	<td>{{$user->email}}</td>
                                        	<td>{{$user->phone_number}}</td>
                                        	<td>{{$user->address}}</td>
                                        	<td>{{$user->city}}</td>

                       <td><a href="{{route('view_users',['id'=>$user->id])}}" type="button" class="btn btn-primary"><i class="fa fa-sm fa-eye"> VIEW</i></a></td>


                       <td><a href="{{route('edit_users',['id'=>$user->id])}}" type="button" class="btn btn-warning"><i class="fa fa-sm fa-pencil"> EDIT</i></a></td>

                        <td><a href="{{route('delete_users',['id'=>$user->id])}}" type="button" class="btn btn-danger"><i class="fa fa-sm fa-trash"> DELETE</i></a></td>

                           <td><a href="{{route('block_users',['id'=>$user->id])}}" type="button" class="btn btn-danger"><i class="fa fa-sm fa-ban"> BLOCK</i></a></td>

                                    	</tr>
                                    		@endif
                                    	@endif
                                    @endforeach
                                   @endif
                                   
                                </tbody>
                            </table>

                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                            	{{Session::has('error')}}
                            </div>
                            @endif

                            
                        </div>
                    </div>

                            </div>
                        </div>
                    </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users"></i>BLOCKED USERS</h3>
                            </div>
                            <div class="panel-body">
                                
                     <div class="row">
                    <div class="col-lg-6">
                        <h2>USERS</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th colspan="3"><center>ACTION</center></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                @if(isset($blocked))
                                	@foreach($blocked as $user)
                                		
                                    	<tr>
                                        	<td>{{$user->user_name}}</td>
                                        	<td>{{$user->email}}</td>
                                        	<td>{{$user->phone_number}}</td>
                                        	<td>{{$user->address}}</td>
                                        	<td>{{$user->city}}</td>

                       <td><a href="{{route('view_users',['id'=>$user->id])}}" type="button" class="btn btn-primary"><i class="fa fa-sm fa-eye"> VIEW</i></a></td>


                       <td><a href="{{route('edit_users',['id'=>$user->id])}}" type="button" class="btn btn-warning"><i class="fa fa-sm fa-pencil"> EDIT</i></a></td>

                        <td><a href="{{route('delete_users',['id'=>$user->id])}}" type="button" class="btn btn-danger"><i class="fa fa-sm fa-trash"> DELETE</i></a></td>

                          

                                    	</tr>
                                    		
                                    @endforeach
                                   @endif
                                   
                                </tbody>
                            </table>

                            @if(Session::has('error'))
                            <div class="alert alert-danger">
                            	{{Session::has('error')}}
                            </div>
                            @endif

                           
                        </div>
                    </div>

                            </div>
                        </div>
                    </div>
                    </div>








                </div>
                <!-- /.row -->

@endsection