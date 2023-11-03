@extends('frontend.layouts.main')

@section('main-section')
@push('title')
<title>Profile - Hassan Graphics & Printing</title>
@endpush
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-4 offset-8"id="alert" >
    @if(session()->has('msg'))
        <div class="alert alert-success" >{{ session('msg') }}</div>
    @endif
</div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('frontend/dist/img/avatar5.png')}}"
                       alt="{{Auth::user()->name}} profile pic">
                </div>

                <h3 class="profile-username text-center">{{Auth()->user()->name}}</h3>

                <p class="text-muted text-center">CEO of HN Wedding Shop</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Admin</b> <a class="float-right">{{$user}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Customers</b> <a class="float-right">{{$customer}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Products</b> <a class="float-right">{{$productcount}}</a>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Edit Profile</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 
                
                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal" action="{{route('submit')}}" method="post">
                        @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="hidden" class="form-control" name="id" value="{{Auth::user()->id}}">

                          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName" placeholder="Name" value="{{Auth::user()->name}}">
                            <span class="text-danger">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}">
                          <span class="text-danger">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword" placeholder="Password" >
                          <span class="text-danger">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control @error('confirmpassword') is-invalid @enderror" name="confirmpassword" id="inputConfirmPassword" placeholder="Confirm Password">
                          <span class="text-danger">
                            @error('confirmpassword')
                            {{ $message }}
                            @enderror
                        </span>
                        </div>
                      </div>
                     
                     
                      
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary rounded-pill ">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>

$(document).ready(function() {
            setTimeout(function() {
                $("#alert").animate({
                    opacity: 0,
                    height: 0,
                    padding: 0
                }, 1000, function() {
                    $(this).hide();
                });
            }, 1000);
        });
    </script>
@endsection