@extends('Admin.master')

@section('content')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-users"></i>ADD USERS</h3>
                            </div>

                        <div class="panel-body">

                                
                           <div class="row">
                           <div class="col-lg-6">

                            <form role="form" method="post" action="{{route('insert_user')}}">
                                {{csrf_field()}}
                            <div class="form-group">
                                <label>First Name:</label>
                                <input class="form-control" placeholder="First Name" name="first_name" required>
                            </div>

                             <div class="form-group">
                                <label>Last Name:</label>
                                <input class="form-control" placeholder="Last Name" name="last_name" required>
                            </div>

                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <label>Phone Number:</label>
                                <input class="form-control" placeholder="Phone Number" name="phone_number" required>
                            </div>

                            <div class="form-group">
                                <label>Address:</label>
                                <textarea class="form-control" placeholder="Address" name="address" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>City:</label>
                                <input class="form-control" placeholder="City" name="city" required>
                            </div>

                            <div class="form-group">
                                <label>State:</label>
                                <input class="form-control" placeholder="State" name="state" required>
                            </div>

                            <div class="form-group">
                                <label>Zip:</label>
                                <input class="form-control" placeholder="Zip" name="zip" required>
                            </div>
                            
                              <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>

                            <div class="form-group"> 
                      <center><button type="submit" class="btn btn-primary">Submit Button</button></center>  
                        </div>

                        </form>


                        

                            @if(count($errors)>0)
                             <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                   <p><center>{{$error}}</center></p>
                                @endforeach
                            </div>
                            @endif

                            @if(Session::has('error'))
                           
                             <div class="alert alert-danger">
                               <p><center> {{Session::get('error')}}</center></p>
                            </div>
                            @endif
                        

                        
                            @if(Session::has('success'))
                             <div class="alert alert-success">
                               <p><center>{{Session::get('success')}}</center></p>
                            </div>
                            @endif
                         

                        </div>
                    </div>
                </div>
                <!-- /.row -->
</div>
</div>
</div>

@endsection