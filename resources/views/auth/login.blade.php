<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Tazweed </title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/icon.svg')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/custom-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style-rtl.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <svg id="svgexport-6_-_2022-07-22T211411.842" data-name="svgexport-6 - 2022-07-22T211411.842" xmlns="http://www.w3.org/2000/svg" width="130.914" height="131.229" viewBox="0 0 130.914 131.229">
                                        <g id="Group_6192" data-name="Group 6192" transform="translate(0 0)">
                                            <g id="Group_6190" data-name="Group 6190" transform="translate(8.446 10.57)">
                                            <path id="Path_990" data-name="Path 990" d="M105.353,85.387a18.942,18.942,0,0,1,4.223.488V24.8L56.788,5.006,4,24.8V95.3l52.788,19.8L86.368,104a19,19,0,0,1,18.985-18.613Z" transform="translate(-4 -5.006)" fill="#ffa64d"/>
                                            </g>
                                            <g id="Group_6191" data-name="Group 6191">
                                            <path id="Path_991" data-name="Path 991" d="M52.889,60.474l-2.61-2.612-2.986,2.986,5.836,5.836L67.281,50.172l-3.205-2.749Z" transform="translate(52.567 52.712)"/>
                                            <path id="Path_992" data-name="Path 992" d="M122.468,93.1V24.057L61.234,0,0,24.057v83.116l61.234,24.057L91,119.533A21.1,21.1,0,1,0,122.468,93.1ZM61.234,126.691l-57.011-22.4V26.935l57.011-22.4,57.011,22.4V90.614a20.96,20.96,0,0,0-21.06,2.447H93.448c.068-.19.146-.376.2-.574l.912-3.649H97.13a8.455,8.455,0,0,0,8.446-8.446V67.723a8.458,8.458,0,0,0-6.7-8.26l-.04-.186h2.517a4.227,4.227,0,0,0,4.223-4.223V50.831a4.227,4.227,0,0,0-4.223-4.223H96.121L94.647,39.73A12.735,12.735,0,0,0,82.261,29.715H40.208A12.733,12.733,0,0,0,27.821,39.73l-1.474,6.877H21.115a4.227,4.227,0,0,0-4.223,4.223v4.223a4.227,4.227,0,0,0,4.223,4.223h2.517l-.04.186a8.462,8.462,0,0,0-6.7,8.262V80.394a8.455,8.455,0,0,0,8.446,8.446h2.576l.912,3.649c.051.2.129.384.2.574H16.892v4.223H92.949A20.853,20.853,0,0,0,89.474,115.6ZM32.921,91.463l-.655-2.623H43.751L43.1,91.463a2.112,2.112,0,0,1-2.05,1.6H34.971a2.11,2.11,0,0,1-2.05-1.6Zm64.106-40.63h4.327v4.223H97.932Zm-2.508,8.446h-4.1L87.21,43.257A6.349,6.349,0,0,0,81,38.164H41.47a6.347,6.347,0,0,0-6.21,5.093L32.055,59.279h-4.1l4-18.662a8.492,8.492,0,0,1,8.258-6.677H82.261a8.49,8.49,0,0,1,8.258,6.677ZM84.208,71.948h8.7v4.223H79.457ZM73.1,76.171H49.367L35.115,63.5H87.354Zm-30.089,0H29.561V71.948h8.7ZM54.9,55.056V50.833H42.23v4.223h4.223v4.223H36.36L39.4,44.084a2.115,2.115,0,0,1,2.069-1.7H81a2.112,2.112,0,0,1,2.069,1.7l3.038,15.195H50.677V55.056Zm-30.364,0H21.115V50.833h4.327Zm.8,8.446h3.421l4.751,4.223H29.561a4.227,4.227,0,0,0-4.223,4.223v4.223a4.227,4.227,0,0,0,4.223,4.223H92.907a4.227,4.227,0,0,0,4.223-4.223V71.948a4.227,4.227,0,0,0-4.223-4.223H88.958L93.709,63.5H97.13a4.227,4.227,0,0,1,4.223,4.223V80.394a4.227,4.227,0,0,1-4.223,4.223H25.338a4.227,4.227,0,0,1-4.223-4.223V67.725A4.227,4.227,0,0,1,25.338,63.5ZM47.19,92.489,48.1,88.84H74.368l.912,3.649c.051.2.129.384.2.574H46.994c.068-.19.146-.376.2-.574Zm32.184-1.026L78.72,88.84H90.2l-.655,2.623a2.112,2.112,0,0,1-2.05,1.6H81.425a2.11,2.11,0,0,1-2.05-1.6ZM109.8,126.848a16.892,16.892,0,1,1,16.892-16.892A16.912,16.912,0,0,1,109.8,126.848Z" transform="translate(0 0)"/>
                                            </g>
                                        </g>
                                    </svg>
                                </a>

                                <h4 class="card-title mb-1 text-center">مرحباً بك في تطبيق تزويد</h4>

                                <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="form-label">البريد الالكتروني</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" aria-describedby="email" tabindex="1" autofocus />
                                                                        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">كلمة المرور</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                                                            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4"> تسجيل الدخول </button>
                                </form>

                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>