
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- i included this -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
        </script>
  <title>  @yield ('title')  </title>
  <base href="{{ URL::to('/') }}"> <!-- what means ?-->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <!-- for edit image on the admin user -->
  <link rel="stylesheet" href="{{ asset('/plugins/ijaboCropTool/ijaboCropTool.min.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login') }}" class="nav-link">Log In</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('register') }}" class="nav-link">Register</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
      <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
      </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
           </form>
        
         
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ \URL::to('/') }}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Back to Site</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      @auth
        <div class="image">
          <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 admin_picture" alt="User Image">
        </div>
      @endauth



        <div class="info">
          <a href="{{ route('admin.profile') }}" class="d-block admin_name">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Profile</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings</p>
            </a>
        </li>
    </ul>
</nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <div>@yield('content')</div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>



 <!-- for edit image on the admin user -->
 <!-- Include ijaboCropTool -->
<script src="{{ asset('/plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
<script>

  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
      }
  });

  /**UPDATE ADMIN PERSONAL INFO */

  $(function() {

    $('#AdminPersonalInfo-form').on('submit', function(e) {
      e.preventDefault();

      $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
            $(document).find('span.error-text').text('');
        },
        success: function(data) {
            if(data.status == 0) {
              $.each(data.error, function(prefix, val) {
                  $('span.'+prefix+'_error').text(val[0]);
              });
            } else {
              $('.admin_name').each(function() {
                  $(this).html($('#AdminPersonalInfo-form').find($('input[name="name"]')).val());
              });
              alert(data.message);
            }
        }
      })

    });



    $(function(){

      $('#changePasswordAdminForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
            $(document).find('span.error-text').text('');
        },  
        success: function(data) {
            if(data.status == 0) {
              $.each(data.error, function(prefix, val) {
                  $('span.'+prefix+'_error').text(val[0]);
              });
            } else {
           
           $('#changePasswordAdminForm')[0].reset();
              alert(data.message);
            }
      }
    });
  })
});






// change user admin picture
          $(document).on('click', '#change_picture_btn', function () {
            // admin_image 
            console.log("Change picture button clicked.");
            $('#admin_image').click(); 
      // when we click on this change_picture_btn button we put value here in the admin_image 
          });

    
 //   preview: '.admin_picture', without refreshing page we have updated picture 
$('#admin_image').ijaboCropTool({
    preview: '.admin_picture',
    setRatio: 1,
    allowedExtensions: ['jpg', 'jpeg', 'png'],
    buttonsText: ['CROP', 'QUIT'],
    buttonsColor: ['#30bf7d', '#ee5155', -15],
    processUrl: '{{ route("adminPictureUpdate") }}',
    onSuccess: function (response, element, status) {
     
       if (response && response.message) {
            alert("Success: " + response.message);
        } else {
            alert("Success: Image updated successfully.");
        }
    },
    onError: function (message, element, status) {
        alert("Error: " + message);
    }
});

  });

</script>
</body>
</html>
