<!DOCTYPE html>
<html
        class="loading"
        lang="{{app()->getLocale()}}"
        dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}"
        data-textdirection="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}"
>
    <!-- BEGIN: Head-->
    <head>
        <style>
            :root{
                --primary-color: #d4202c;
                --secondry-color: #d4202c;
            }
            .text-end{
                text-align: end !important;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="My Site Dashboard">
        <meta name="keywords" content="My Site">
        <meta name="author" content="Sadoma">
        <title> @lang('My Site Dashboard') - @yield('auth_title') </title>
        <link rel="apple-touch-icon" href="{{url('assets/markrise-favicon.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/markrise-favicon.png')}}">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/vendors/css/vendors-rtl.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/themes/bordered-layout.css')}}">
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/plugins/forms/form-validation.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/pages/page-auth.css')}}">
        <!-- END: Page CSS-->
        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/custom-rtl.css')}}">
        {{-- <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css/style-rtl.css')}}"> --}}
        <!-- END: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/vendors/css/extensions/toastr.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/admin/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css')}}">
        <style>
            .toast-title{
                float: left;
                padding-right: 40px !important;
            }
            #toast-container>div{
                width: 350px !important;
                padding: 15px !important;
            }
            .toast-close-button{
                display: none;
            }
        </style>
        {{-- <style>
            .toast{
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
            }
            .toast:before{
                right: 86% !important;
            }
            .error-help-block{
                color: red
            }
            .ms-1{
                margin-right: 5rem !important;
            }
        </style> --}}
    </head>
    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
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
                                    <a href="{{ route('app.dashboard') }}" class="brand-logo" style="margin: 0;">
                                        <img src="{{app_settings()->logo_path}}" style="max-height: 100px;" alt="{{ env('APP_NAME') }}">
                                        {{-- <h2 class="brand-text text-primary ms-1" style="margin: 0;line-height: 3;">@lang("Administrators")</h2> --}}
                                    </a>
                                    <h4 class="card-title mb-1 {{ (\App::getLocale() == "en") ? 'text-end' : ''}}">@lang("Welcome to Themarkrise!") 👋</h4>
                                    <p class="card-text mb-2 {{ (\App::getLocale() == "en") ? 'text-end' : ''}}">@lang("Please sign-in to your account and start the adventure")</p>
                                    @yield('auth_content')
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
        <script src="{{url('assets/admin/app-assets/vendors/js/vendors.min.js')}}"></script>
        <!-- BEGIN Vendor JS-->
        <!-- BEGIN: Page Vendor JS-->
        <script src="{{url('assets/admin/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
        <!-- END: Page Vendor JS-->
        <!-- BEGIN: Theme JS-->
        <script src="{{url('assets/admin/app-assets/js/core/app-menu.js')}}"></script>
        <script src="{{url('assets/admin/app-assets/js/core/app.js')}}"></script>
        <!-- END: Theme JS-->
        <!-- BEGIN: Page JS-->
        <script src="{{url('assets/admin/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
        <!-- END: Page JS-->
        <script src="{{url('assets/admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
        <script>
            function AlertMe(type = 'success',message) {
                if(message != undefined) {
                    toastr[type]("",message, { timeOut: 5000,closeButton:true,positionClass: "toast-top-center",});
                }
            }
        </script>
        @if(session()->has('success'))
            <script>
               AlertMe('success',"{{ session()->get("success") }}");
            </script>
        @endif
        @if(session()->has('error'))
            <script>
               AlertMe('error',"{{ session()->get("error") }}");
            </script>
        @endif
        <script>
            $(window).on('load', function () {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            })
        </script>
        @stack('scripts')
    </body>
    <!-- END: Body-->
</html>


