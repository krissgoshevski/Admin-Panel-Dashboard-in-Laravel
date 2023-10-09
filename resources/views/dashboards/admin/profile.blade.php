@extends('dashboards.layouts.admin-dash-layout')
<style>
  #admin_image {
    opacity: 0;
    height: 1px;
    display: none;
  }
</style>
@section('title', 'Admin Profile')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle admin_picture"
                       src="{{ Auth::user()->picture }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center admin_name">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">{{ auth()->user()->role->name }}</p>

                <!-- edit admin user image -->
                <input type="file" name="admin_image" id="admin_image"/>

                <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Change Picture</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>



          <!-- /.col -->
<div class="col-md-9">
    <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Personal Informations</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a></li>
                </ul>
            </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="personal_info">

                 
                    <form class="form-horizontal" id="AdminPersonalInfo-form" method="POST" action="{{ route('adminUpdateInfo') }}">               

                        @if(session()->has('message'))
                            <p class="alert {{ session()->get('alert-class', 'alert-info') }}">
                                {{ session()->get('message') }}
                            </p>
                        @endif

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ Auth::user()->name }}">

                          <span class="text-danger error-text name_error"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}">
                          <span class="text-danger error-text email_error"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label" value="{{ Auth::user()->name }}">Favorite Color</label>
                        <div class="col-sm-10">
                          <input type="text" name="favoritecolor" class="form-control" id="inputName2" placeholder="Favorite Color" value="{{ Auth::user()->favoriteColour }}">
                          <span class="text-danger error-text favoritecolor_error"></span>
                        </div>
                      </div> 

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Save Changes</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->

                  


                <div class="tab-pane" id="change_password">
                  <form action="{{ route('adminChangePassword') }}" method="POST" class="form-horizontal" id="changePasswordAdminForm" >
                      <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Old password </label>
                            <div class="col-sm-10">
                              <input type="password" name="oldpassword" class="form-control" id="inputName" placeholder="Enter current password">
                            
                              <span class="text-danger error-text oldpassword_error"></span> <!-- for showing the errors on page -->
                      
                            </div>
                      </div>
                                        
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                          <div class="col-sm-10">
                            <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Enter new pasword">
                            <span class="text-danger error-text newpassword_error"></span> <!-- for showing the errors on page -->
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Confirm New Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" name="cnewpassword" id="cnewpassword" placeholder="Re-enter new password"/>
                            <span class="text-danger error-text cnewpassword_error"></span>
                          </div>
                      </div>
                                    
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update Password</button>
                        </div>
                      </div>
                  </form>   
                </div> <!-- /.tab-pane -->         

            </div>  <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div> <!-- /.card -->      
      </div><!-- /.col -->
    </div> <!-- /.row -->
 </div><!-- /.container-fluid -->
</section><!-- /.content -->

<script>
    $(document).ready(function() {
        // Hide the password change form initially
        $("#changePasswordAdminForm").hide();

        // Listen for tab change events
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var targetTab = $(e.target).attr("href");
            if (targetTab === "#change_password") {
                // Show the password change form when the "Change Password" tab is active
                $("#changePasswordAdminForm").show();
            } else {
                // Hide the password change form for other tabs
                $("#changePasswordAdminForm").hide();
            }
            // AdminPersonalInfo-form
            if (targetTab === "#personal_info") {
                $("#AdminPersonalInfo-form").show();
            }  else {
                // Hide the password change form for other tabs
                $("#AdminPersonalInfo-form").hide();
            }

        });
    });
</script>
@endsection