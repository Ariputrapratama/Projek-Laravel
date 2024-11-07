<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>
    
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/app-dark.css')}}">
    <link rel="stylesheet" href="{{asset('dist/assets/compiled/css/iconly.css')}}">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <script src="{{asset('dist/assets/static/js/initTheme.js')}}"></script>
    <div id="app">
        <!-- sidebar -->
        @extends('partials/sidebar')
        <div id="main">
            <header class="mb-3 d-flex justify-content-between align-items-center">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User Menu
                    </button>
                    <div class="dropdown-content" aria-labelledby="dropdownMenuButton">
                        <a href="#">Profile</a>
                        <a href="#">Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </header>
            
            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div> 
            <div class="page-content"> 
                <section class="row">
                    @section('content')
                    @show 
                    ini adalah konten
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{asset('dist/assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('dist/assets/compiled/js/app.js')}}"></script>
    <!-- Need: Apexcharts -->
    <script src="{{asset('dist/assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('dist/assets/static/js/pages/dashboard.js')}}"></script>
</body>

</html>