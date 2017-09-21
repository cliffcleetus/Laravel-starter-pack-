<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/AdminLTE.min.css') }}" rel="stylesheet">

     <link href="{{ asset('css/_all-skins.min.css') }}" rel="stylesheet">

      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="https://use.fontawesome.com/9712be8772.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>LSP</b></span>

      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Laravel</b>Starter Pack</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user-menu">
          <a href="#"><i class="fa fa-btn fa-unlock"> 
          <span class="">{{ Auth::user()->name }}</span></i></a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
         

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>


   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
       <!--  <div class="pull-left image">
          <img src="" class="img-circle" alt="User Image">
        </div> -->
       <!--  <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div> -->
      </div>
      <ul class="sidebar-menu" data-widget="tree">
      
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
       <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a></li>

        @if (!Auth::guest())
          <li><a href="{{ route('users.index') }}"><i class="fa fa-user"></i> <span>Admin Users</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          </a></li>

          <li><a href="{{ route('customer') }}"><i class="fa fa-user"></i> <span>Customers</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a></li>

        @endif
             
        <!-- <li><a href="{{ route('posts.create') }}"><i class="fa fa-book"></i> <span>New Post</span></a></li> -->
        
        @if (!Auth::guest())
         @if(Auth::user()->hasPermissionTo('Administer roles & permissions'))
          <li><a href="{{ route('roles.index') }}"><i class="fa fa-users"></i> <span>Roles</span>
 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a></li>
          @endif
        @endif 

        @if (!Auth::guest())
          <li><a href="{{ route('emailcontents.index') }}"><i class="fa fa-envelope"></i> <span>Email Contents</span>
 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          </a></li>
        @endif

        @if (!Auth::guest())
          <li><a href="{{ route('emailqueues.index') }}"><i class="fa fa-envelope"></i> <span>Email Queues</span>
 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a></li>
        @endif

       
        @if (!Auth::guest())
           @if(Auth::user()->hasPermissionTo('Administer roles & permissions'))
            <li><a href="{{ route('permissions.index') }}"><i class="fa fa-key"></i> <span>Permissions</span>
 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            </a></li>
          @endif
        @endif

        @if (!Auth::guest())
            <li><a href="{{ route('settings.index') }}"><i class="fa fa-wrench"></i> <span>Site Settings</span>

 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a></li>
        @endif    

        @if (!Auth::guest())
            <li><a href="{{ route('pages.index') }}"><i class="fa fa-book"></i> <span>Pages</span>
 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a></li>
        @endif 
           
        @if (!Auth::guest())
            <li><a href="{{ route('faq.index') }}"><i class="fa fa-question-circle"></i> <span>FAQ</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a></li>
        @endif    
        @if (!Auth::guest())
          <li><a href="{{ route('helps.index') }}"><i class="fa fa-info-circle"></i><span>Helps</span>
 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

          </a></li>
        @endif   

                    @if (Auth::guest())
                            <li><a href="{{ route('login') }}"><span>Login</span></a></li>
                            <!-- <li><a href="{{ route('register') }}"><span>Register</span></a></li> -->
                    @else
                           <li>
                                   @role('Admin') {{-- Laravel-permission blade helper --}}
                                    <a href="#"><i class="fa fa-btn fa-unlock"></i>Admin</a>
                                    @endrole
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                    @endif

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

       <div class="row">
            <div class="col-md-8 col-md-offset-2">              
                @include ('errors.list') {{-- Including error file --}}
            </div>

             <div class="col-md-8 col-md-offset-2">      
             @if(Session::has('flash_message'))
             
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
           
           @endif
            </div>

        </div>

   @yield('content')

      </div>
   

    </section>
    <!-- /.content -->
  </div>


<body>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
</body>
</html>
