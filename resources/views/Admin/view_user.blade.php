@extends('Admin.master')

@section('content')


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-users"></i>VIEW USER</h3>
                            </div>

                        <div class="panel-body">

                             @if(isset($id))    
                
                                  <div class="row">
                                    <div class="col-lg-6">
                                        <h2>{{$id->user_name}}</h2>
                                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <tbody>
                                
                                <tr>
                                <td><label>First Name:</label></td>
                                <td>{{$id->first_name}}</td>
                                </tr>

                               <tr>
                                <td><label>Last Name:</label></td>
                                <td>{{$id->last_name}}</td>
                               </tr>

                               <tr>
                                <td><label>Email:</label></td>
                                <td>{{$id->email}}</td>
                                </tr>

                                <tr>
                                <td><label>Phone Number:</label></td>
                                <td>{{$id->phone_number}}</td>
                                </tr>

                                <tr>
                                <td><label>Address:</label></td>
                                <td>{{$id->address}}</td>
                                </tr>

                                <tr>
                                <td><label>City:</label></td>
                                <td>{{$id->city}}</td>
                                </tr>

                                <tr>
                                <td><label>State:</label></td>
                                <td>{{$id->state}}</td>
                                </tr>

                                <tr>
                                <td><label>Zip:</label></td>
                                <td>{{$id->zip}}</td>
                                </tr>

                              </tbody>
                              </table>

                            

                        </div>
                    </div>
                </div>
                @endif
                <!-- /.row -->
</div>
</div>
</div>
</div>

@endsection