<style>
    :root{
        --primary-color: #d4202c;
        --secondry-color: #d4202c;
    }
    /* .vertical-layout.vertical-menu-modern .main-menu .navigation .menu-content li a{
        background: linear-gradient(-118deg, var(--primary-color), var(--secondry-color));
        box-shadow: 0 0 1px 1px var(--primary-color);
    } */
</style>

<link rel="apple-touch-icon" href="{{url('assets/markrise-favicon.png')}}">
<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/markrise-favicon.png')}}">
@if (\App::getLocale() == "en")
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    {!! assetAdmin('app-assets/css/bootstrap.css','css') !!}
    {!! assetAdmin('app-assets/css/bootstrap-extended.css','css') !!}
    {!! assetAdmin('app-assets/css/colors.css','css') !!}
    {!! assetAdmin('app-assets/css/components.css','css') !!}
    {!! assetAdmin('app-assets/css/themes/dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css/themes/bordered-layout.css','css') !!}
    {!! assetAdmin('app-assets/css/themes/semi-dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css/core/menu/menu-types/vertical-menu.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/vendors.min.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css','css') !!}
    {!! assetAdmin('assets/css/style.css','css') !!}
    <style>
        .main-menu.menu-light .navigation>li ul li>a {
            padding: 10px 15px 10px 50px !important;
        }
        .button_in_navbar {
            float: right;
            padding: 10px 15px;
        }
        .button_in_navbar svg.feather.feather-arrow-left{
            transform: rotate(180deg);
        }
    </style>
@else
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    {!! assetAdmin('app-assets/css-rtl/bootstrap.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/bootstrap-extended.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/colors.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/components.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/themes/dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/themes/bordered-layout.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/themes/semi-dark-layout.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css','css') !!}
    {!! assetAdmin('app-assets/vendors/css/vendors-rtl.min.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/custom-rtl.css','css') !!}
    {!! assetAdmin('assets/css/style-rtl.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/components.css','css') !!}
    {!! assetAdmin('app-assets/css-rtl/components.css','css') !!}
    <style>
        body {
            font-family: 'Cairo', sans-serif !important;
        }
        .navigation {
            font-family: 'Cairo', sans-serif !important;
        }
        .main-menu.menu-light .navigation>li ul li>a {
            padding: 10px 50px 10px 15px !important;
        }
        .button_in_navbar {
            float: left;
            padding: 10px 15px;
        }
    </style>
@endif
<link rel="preconnect" href="https://fonts.gstatic.com">
{!! assetAdmin('app-assets/vendors/css/extensions/toastr.min.css','css') !!}
{!! assetAdmin('app-assets/vendors/css/forms/select/select2.min.css','css') !!}
{!! assetAdmin('app-assets/css-rtl/plugins/extensions/ext-component-toastr.css','css') !!}
<!-- BEGIN: tag input-->
{!! assetAdmin('app-assets/InputTags/InputTags.css','css') !!}
<!-- END: tag input-->
<style>
    /* .toast{
        position: absolute !important;
        top: 70px !important;
        left: 0 !important;
    }
    .toast:before{
        right: 86% !important;
    } */
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
    html .content.app-content {
        padding: calc(1rem + 4.45rem + 1.3rem) 2rem 0;
    }
    .select2-selection__arrow b{
        height: 100% !important;
        border: none !important;
    }
    .error-help-block{
        color: red
    }
    .text-danger{
        color: red
    }
    .form-group{
        padding: 7px;
    }
    .pagination-section ul.pagination {
        background: linear-gradient(
        -118deg
        , var(--primary-color), var(--secondry-color));
        min-width: 9% !important;
        padding: 0 5px;
        border-radius: 20PX;
        display: inline-block;
        margin: 15px 0 0 0;
    }
    .pagination-section .pagination li {
        margin-right: 3px !important;
        font-size: 13px;
        padding: 6px 6px;
        display: inline-block;
        color:#fff
    }
    .pagination-section .pagination li.active {
        background: linear-gradient(
        -118deg
        , #de6d0c, #de6d0c);
    }
    .pagination-section li a{
        color: #fff
    }
    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
    }
    .nav-tabs .nav-item.active {
        background: linear-gradient(-118deg, var(--primary-color), var(--secondry-color));
    }
    .nav-tabs .nav-item.active a {
        color: #fff;
    }
    .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove{
        margin-left: 5px !important;
        margin-right: 5px !important;
    }
    .table > :not(caption) > * > *{
        padding: 0.72rem 1rem !important;
    }
    .navbar-container .bookmark-input{
        width: 15% !important;
    }
    ul.nav.navbar-nav.bookmark-icons {
        min-height: 200px !important;
        max-height: 500px !important;
        max-width: 100% !important;
        overflow-y: scroll;
    }
    ul.nav.navbar-nav.bookmark-icons li a {
        font-size: 15px;
        font-weight: bold;
    }
    .vertical-layout.vertical-menu-modern.menu-collapsed .main-menu:not(.expanded) .navigation li.active a{
        background: linear-gradient(-118deg, var(--primary-color), var(--secondry-color)) !important;
        color: #fff !important;
    }
    svg.feather.feather-x.d-block.d-xl-none.text-primary.toggle-icon.font-medium-4{
        color: #fff !important;
    }
    .table-responsive tr th, .table-responsive tr td{
        text-align: center;
    }
</style>
<link rel="stylesheet" href="{{url('assets/bootstrap-icons-1.5.0/bootstrap-icons.css')}}" crossorigin="anonymous">
{!! assetAdmin('app-assets/fileinput/css/fileinput.min.css','css') !!}
<!-- END: Custom CSS-->
{{--<!-- /global stylesheets -->--}}
@stack('styles')
@if (app()->getLocale() == 'en')
<style>
    @media only screen and (min-width: 992px) {
        .note-editable .left-50{
            right:50%;
        }
    }
    .note-editable .fes7-text-cont{
        left: 0;
    }
    .col-sm-12.blog-main-posts {
        height: 583px;
        overflow: hidden;
    }
</style>
@endif
<style>
    .col-sm-12.blog-main-posts {
        height: 583px;
        overflow: hidden;
    }
    .note-editor.note-airframe.fullscreen, .note-editor.note-frame.fullscreen{
        background: #fff;
    }
    .main-menu .navbar-header .navbar-brand{
        margin: 0 !important;
    }
    .main-menu.menu-light .navigation > li.active > a{
        box-shadow: none !important;
    }
    .bg-label-secondary {
    background-color: #ebebed !important;
    color: #808390 !important
    }

    .bg-label-success {
        background-color: #ddf6e8 !important;
        color: #28c76f !important;
    }

    .bg-label-info {
        background-color: #d6f4f8 !important;
        color: #00bad1 !important
    }

    .bg-label-warning {
        background-color: #fff0e1 !important;
        color: #ff9f43 !important
    }

    .bg-label-danger {
        background-color: #ffe2e3 !important;
        color: #ff4c51 !important
    }

    .bg-label-light {
        background-color: #fafafb !important;
        color: #dfdfe3 !important
    }

    .bg-label-dark {
        background-color: #e2e2e2 !important;
        color: #4b4b4b !important
    }

    .bg-label-gray {
        background-color: rgba(243,242,243,.92) !important;
        color: rgba(47,43,61,.5) !important
    }

    .bg-label-hover-secondary {
        background-color: #ebebed !important;
        color: #808390 !important
    }

    .bg-label-hover-secondary:hover {
        background-color: #808390 !important;
        color: #fff !important
    }

    .bg-label-hover-success {
        background-color: #ddf6e8 !important;
        color: #28c76f !important
    }

    .bg-label-hover-success:hover {
        background-color: #28c76f !important;
        color: #fff !important
    }

    .bg-label-hover-info {
        background-color: #d6f4f8 !important;
        color: #00bad1 !important
    }

    .bg-label-hover-info:hover {
        background-color: #00bad1 !important;
        color: #fff !important
    }

    .bg-label-hover-warning {
        background-color: #fff0e1 !important;
        color: #ff9f43 !important
    }

    .bg-label-hover-warning:hover {
        background-color: #ff9f43 !important;
        color: #fff !important
    }

    .bg-label-hover-danger {
        background-color: #ffe2e3 !important;
        color: #ff4c51 !important
    }

    .bg-label-hover-danger:hover {
        background-color: #ff4c51 !important;
        color: #fff !important
    }

    .bg-label-hover-light {
        background-color: #fafafb !important;
        color: #dfdfe3 !important
    }

    .bg-label-hover-light:hover {
        background-color: #dfdfe3 !important;
        color: #fff !important
    }

    .bg-label-hover-dark {
        background-color: #e2e2e2 !important;
        color: #4b4b4b !important
    }

    .bg-label-hover-dark:hover {
        background-color: #4b4b4b !important;
        color: #fff !important
    }

    .bg-label-hover-gray {
        background-color: rgba(243,242,243,.92) !important;
        color: rgba(47,43,61,.5) !important
    }

    .bg-label-hover-gray:hover {
        background-color: rgba(47,43,61,.5) !important;
        color: #fff !important
    }

    .bg-gradient-secondary {
        background-image: linear-gradient(45deg, #808390, #c0c1c8) !important
    }

    .bg-gradient-success {
        background-image: linear-gradient(45deg, #28c76f, #94e3b7) !important
    }

    .bg-gradient-info {
        background-image: linear-gradient(45deg, #00bad1, #80dde8) !important
    }

    .bg-gradient-warning {
        background-image: linear-gradient(45deg, #ff9f43, #ffcfa1) !important
    }

    .bg-gradient-danger {
        background-image: linear-gradient(45deg, #ff4c51, #ffa6a8) !important
    }

    .bg-gradient-light {
        background-image: linear-gradient(45deg, #dfdfe3, #efeff1) !important
    }

    .bg-gradient-dark {
        background-image: linear-gradient(45deg, #4b4b4b, #a5a5a5) !important
    }

    .bg-gradient-gray {
        background-image: linear-gradient(45deg, rgba(47, 43, 61, 0.5), #97959e) !important
    }

    a.bg-dark:hover,a.bg-dark:focus {
        background-color: rgba(47,43,61,.9) !important
    }

    a.bg-light:hover,a.bg-light:focus {
        background-color: rgba(47,43,61,.12) !important
    }

    a.bg-lighter:hover,a.bg-lighter:focus {
        background-color: rgba(47,43,61,.1) !important
    }

    a.bg-lightest:hover,a.bg-lightest:focus {
        background-color: rgba(47,43,61,.06) !important
    }
</style>
<script>
    var _token_ = "{{ csrf_token() }}";
    // var _url_ = "{!! url('/') . '/' . app()->getLocale() . '/' !!}";
    var _url_ = "{!! url('/') . '/' !!}";
    var base_url = "{{asset("/")}}";
</script>

