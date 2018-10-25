<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    
    <!-- Bootstrap Core CSS -->
    <link href='{{asset("content/css/bootstrap.min.css")}}' rel="stylesheet">

    <!-- Progress Bar -->
    <link href='{{asset("content/css/style.css")}}' rel="stylesheet">

    <!-- Custom Css for Admin Panel -->
    <link href='{{asset("content/css/adminpanel.css")}}' rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset('content/unicat/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <li class="nav-item"> 
                        <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)">
                        <div class="navbar-brand">
                        	<!-- Menu icon in mobile phone -->
                        	<i class="fa fa-navicon"></i>
                        </div>
                        </a> 
                    </li>

                    <li class="nav-item m-l-10"> 
                        <a class="nav-link  hidden-sm-down text-muted  ">
                            <div class="navbar-brand">
                        		<h3>Admin Panel</h3>
                            </div>
                        </a>
                    </li>
                </div>

                <!-- End Logo -->
                <div class="navbar-collapse">

                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <p class='school-name'>BD Wallet</p>
                    </ul>

                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Logout -->
                        <li class="nav-item hidden-sm-down"> 
                            <a class="nav-link hidden-sm-down text-muted"  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">

                                <i class="fa fa-power-off"></i></a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>

        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>

                        <li> <a class="email-compose.html" href="{{asset('/')}}"><i class="fa fa-home"></i>Home</a>

                        <li> <a class="email-compose.html" href="{{asset('/adminpanel/news')}}"><i class="fa fa-info-circle"></i>News and Notice</a>

                        <li> <a class="email-compose.html" href="{{asset('/adminpanel/exchangerequest')}}"><i class="fa fa-exchange"></i>Exchange Request</a>
                        </li>
                        <li> <a class="email-compose.html" href="{{asset('/adminpanel/depositrequest')}}"><i class="fa fa-arrow-circle-down"></i>Deposit Request</a>
                        </li>
                        <li> <a class="email-compose.html" href="{{asset('/adminpanel/withdrawrequest')}}"><i class="fa fa-arrow-circle-up"></i>Withdraw Request</a>
                        </li>
                        <li> <a class="email-compose.html" href="{{asset('/adminpanel/gateway')}}"><i class="fa fa-paypal"></i>Gateway and Reserve</a>
                        </li>
                        <li> <a class="email-compose.html" href="{{asset('adminpanel/exchangerate')}}"><i class="fa fa-money"></i>Exchange Rate</a>
                        </li>
                        <li> <a class="email-compose.html" href="{{asset('adminpanel/messages')}}"><i class="fa fa-envelope-o"></i>Messages</a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">@yield('title')</h3> 
                </div>
            </div>

            <div class="container-fluid">
                @if($errors->has('message'))
                <div class="col-sm-12" id="success-alert">
                    <div class="alert  alert-success alert-dismissible fade show text-dark" role="alert">
                      <span class="badge badge-pill badge-info">Success</span>
                        {{$errors->first("message")}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @elseif(count($errors)>0)
                    <div class="col-sm-12" id="error-alert">
                        <div class="alert  alert-danger alert-dismissible fade show text-dark" role="alert">
                          <span class="badge badge-pill badge-danger">Error</span>
                            @foreach($errors->all() as $error)
                             {{$error}}
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2018 All rights reserved. 
                <span class="pull-right"> Developed by <a class="text-primary" href="https://banglasofttech.com">Bangla Soft Tech</a></span></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->


    <!-- Additional Modal -->

    <!-- All Jquery -->
    <script src="{{asset('content/js/jquery.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src='{{asset("content/js/bootstrap.js")}}'></script>

    <!--Custom JavaScript for progressbar and menu -->
    <script src='{{asset("content/js/scripts.js")}}'></script>

    <!-- Custom JS -->
    <script src='{{asset("content/js/main.js")}}'></script>

    <!-- Sidebar response for Mobile Version -->
    <script src='{{asset("content/js/sticky-kit.min.js")}}'></script>

    <script src="{{asset('content/js/adminpanel.js')}}"></script>

</body>

</html>