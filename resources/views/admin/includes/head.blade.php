<!-- Title -->
<title> Badia ENaql - Vehicle Management System </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">


@if (LaravelLocalization::getCurrentLocale() == 'ar')
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
@else
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
    <!--- Style css -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet">
@endif
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}">


@yield('css')

<!-- Cairo Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}">
<!--  Select2 -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!-- Toastr -->
@toastr_css
<style>
    *{
        font-family: 'Cairo', sans-serif;
    }
    .main-footer{
        position: absolute;
        width: 100%;
        right: 0;
        bottom: 0;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        position: relative;
        margin-top: 5px;
        margin-right: 4px;
        padding: 3px 10px 3px 20px;
        border-color: transparent;
        border-radius: 0;
        background-color: #0162e8;
        color: #fff;
        line-height: 1.45;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-weight: bold;
        margin-right: 2px;
    }
    .sidebar__icon{
        margin-right: 20px !important;
        font-size: 20px;
    }
    .side-menu__label , .angle{
        margin-top: 13px;
    }
    .select2-container--default .select2-selection--single{
        height: 39px;
        padding-top: 5px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        margin: 5px;
    }
    .justifiy-content-between{
        justify-content: space-between
    }
    .dt-button{
        background: #737f9e !important;
        color: #fff !important;
        border-color: #737f9e !important;
        padding: 8px 20px !important;
        font-size: 15px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current{
        padding: 6px 14px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous , .dataTables_wrapper .dataTables_paginate .paginate_button.next{
        border: solid 1px;
        padding: 6px 14px;
    }
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
