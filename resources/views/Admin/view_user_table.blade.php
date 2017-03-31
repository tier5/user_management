@extends('Admin.master')

@section('content')
<script>

$(document).ready(function(){
$('#search_username_input').val("");
if("{{Session::has('update_error')}}")
{
    alert("{{Session::get('update_error')}}");
}
if("{{Session::has('update_success')}}")
{
    alert("{{Session::get('update_success')}}");
}

$('#search_button').click(function(){
    name=$('#search_username_input').val().trim();

    if(name)
    {
        $.ajax({
            url:"{{route('search_user')}}",
            type:"post",
            data:{username:name, _token:"{{Session::token()}}"},

            success:function(response)
            {
                
                if(response!="error")
                {
                    data=JSON.parse(response);
                    $('#username').html(data.user_name);
                            $('#row_first_name').html(data.first_name);
                            $('#row_last_name').html(data.last_name);
                            $('#row_email').html(data.email);
                            $('#row_phone_number').html(data.phone_number);
                            $('#row_address').html(data.address);
                            $('#row_city').html(data.city);
                            $('#row_state').html(data.state);
                            $('#row_zip').html(data.zip);

                            $('#view_user_details_modal').modal('toggle');
                }
                else if(response=="error")
                {
                    alert("User Not Found");
                }
            }

        });  
    }
    else
    {
        alert("Enter User Name");
    }
});

});
    
function viewuser(id)
{
    if(id)
    {
        $.ajax({

            url:"{{route('view_users')}}",
            type:"post",
            data:{id:id, _token:"{{Session::token()}}"},

            success:function(response)
                    {
                        if(response!="error")
                        {
                            data=JSON.parse(response);
                            $('#username').html(data.user_name);
                            $('#row_first_name').html(data.first_name);
                            $('#row_last_name').html(data.last_name);
                            $('#row_email').html(data.email);
                            $('#row_phone_number').html(data.phone_number);
                            $('#row_address').html(data.address);
                            $('#row_city').html(data.city);
                            $('#row_state').html(data.state);
                            $('#row_zip').html(data.zip);

                            $('#view_user_details_modal').modal('toggle');
                        }
                        else
                        {
                            alert(response);
                        }
                    }

        });
    }
    else
    {
         alert('id not set');
    }

}



function deleteuser(id)
{
    if(confirm('Are You Sure To Delete This User?')){
        if(id)
        {
            $.ajax({
                url:"{{route('delete_users')}}",
                type:"post",
                data:{id:id, _token:"{{Session::token()}}"},

                success:function(response)
                {
                    if(response=="success")
                    {
                        alert('User Deleted SuccessFully');
                        $('#table_users_row').load(window.location+" #table_users_row");
                    }
                    else if(response=="error")
                    {
                          alert('User Not Deleted');
                    }
                }
    
            });
        }
        else
        {
            alert("id not set");
        }
    }
}


function blockuser(id)
{
    if(confirm('Are You Sure To Block This User?')){
        if(id)
        {
            $.ajax({
                url:"{{route('block_users')}}",
                type:"post",
                data:{id:id, _token:"{{Session::token()}}"},

                success:function(response)
                {
                    if(response=="success")
                    {
                        alert('User Blocked SuccessFully');
                        $('#table_users_row').load(window.location+" #table_users_row");
                        $('#table_blocked_users_row').load(window.location+" #table_blocked_users_row");
                        
                    }
                    else if(response=="error")
                    {
                          alert('User Not Blocked');
                    }
                }
    
            });
        }
        else
        {
            alert("id not set");
        }
    }
}

function unblockuser(id)
{
    if(confirm('Are You Sure To Unblock This User?')){
        if(id)
        {
            $.ajax({
                url:"{{route('unblock_users')}}",
                type:"post",
                data:{id:id, _token:"{{Session::token()}}"},

                success:function(response)
                {
                    if(response=="success")
                    {
                        alert('User Unblocked SuccessFully');
                        $('#table_users_row').load(window.location+" #table_users_row");
                        $('#table_blocked_users_row').load(window.location+" #table_blocked_users_row");
                        
                    }
                    else if(response=="error")
                    {
                          alert('User Not Unblocked');
                    }
                }
    
            });
        }
        else
        {
            alert("id not set");
        }
    }
}


</script>

  
    
                <div class="row">
               
                    <div class="col-lg-12">
                        <h2>Search Box</h2>
                         <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="  search-query form-control" id="search_username_input" placeholder="Search Username" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" id="search_button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        </div>
                 
                        <hr>

                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users"></i> USERS</h3>
                            </div>
                            <div class="panel-body">
                                
                     <div class="row" >
                    <div class="col-lg-6">
                        <h2>USERS</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table_users_row">
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
                                                @if($user->deleted_status!=1)
                                    	<tr>
                                        	<td>{{$user->user_name}}</td>
                                        	<td>{{$user->email}}</td>
                                        	<td>{{$user->phone_number}}</td>
                                        	<td>{{$user->address}}</td>
                                        	<td>{{$user->city}}</td>

                       <td><a onclick="viewuser({{$user->id}})" type="button" class="btn btn-primary"><i class="fa fa-sm fa-eye"> VIEW</i></a></td>


                       <td><a href="{{route('edit_users',['id'=>$user->id])}}" type="button" class="btn btn-warning"><i class="fa fa-sm fa-pencil"> EDIT</i></a></td>

                        <td><a onclick="deleteuser({{$user->id}})" type="button" class="btn btn-danger"><i class="fa fa-sm fa-trash"> DELETE</i></a></td>

                           <td><a onclick="blockuser({{$user->id}})" type="button" class="btn btn-danger"><i class="fa fa-sm fa-ban"> BLOCK</i></a></td>

                                    	</tr>
                                                @endif
                                    		@endif
                                    	@endif
                                    @endforeach
                                   @endif
                                   
                                </tbody>

                            </table>

                            <center> @if(isset($users))
                                {{$users->links()}}
                                @endif
                            </center>

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
                            <table class="table table-bordered table-hover table-striped" id="table_blocked_users_row">
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

                       <td><a onclick="viewuser({{$user->id}})" type="button" class="btn btn-primary"><i class="fa fa-sm fa-eye"> VIEW</i></a></td>


                       <td><a href="{{route('edit_users',['id'=>$user->id])}}" type="button" class="btn btn-warning"><i class="fa fa-sm fa-pencil"> EDIT</i></a></td>

                        <td><a onclick="deleteuser({{$user->id}})" type="button" class="btn btn-danger"><i class="fa fa-sm fa-trash"> DELETE</i></a></td>

                        <td><a onclick="unblockuser({{$user->id}})" type="button" class="btn btn-success"><i class="fa fa-sm fa-undo"> UNBLOCK</i></a></td>

                                    	</tr>
                                    		
                                    @endforeach
                                   @endif
                                   
                                </tbody>
                            </table>
                            <center> @if(isset($blocked))
                                {{$blocked->links()}}
                                @endif
                            </center>

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


<div id="view_user_details_modal" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title">USER DETAILS</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-users"></i>VIEW USER</h3>
                            </div>

                        <div class="panel-body">

                            
                
                                  <div class="row">
                                    <div class="col-lg-6">
                                        <h2 id="username"></h2>
                                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <tbody>
                                
                                <tr>
                                <td><label>First Name:</label></td>
                                <td id="row_first_name"></td>
                                </tr>

                               <tr>
                                <td><label>Last Name:</label></td>
                                <td id="row_last_name"></td>
                               </tr>

                               <tr>
                                <td><label>Email:</label></td>
                                <td id="row_email"></td>
                                </tr>

                                <tr>
                                <td><label>Phone Number:</label></td>
                                <td id="row_phone_number"></td>
                                </tr>

                                <tr>
                                <td><label>Address:</label></td>
                                <td id="row_address"></td>
                                </tr>

                                <tr>
                                <td><label>City:</label></td>
                                <td id="row_city"></td>
                                </tr>

                                <tr>
                                <td><label>State:</label></td>
                                <td id="row_state"></td>
                                </tr>

                                <tr>
                                <td><label>Zip:</label></td>
                                <td id="row_zip"></td>
                                </tr>

                              </tbody>
                              </table>

                            

                        </div>
                    </div>
                </div>
             
                <!-- /.row -->
</div>
</div>
</div>
</div>

      </div>
    </div>
  </div>
</div>


@endsection