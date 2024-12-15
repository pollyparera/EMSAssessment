<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
      name="viewport"
    />
    <meta
      name="description"
      content="Responsive Bootstrap 4 and web Application ui kit."
    />
    <title>Inventory Management</title>
   <link rel="icon" href="../assets/images/loader.png" type="image/x-icon" />
    <!-- Favicon-->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/charts-c3/plugin.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.min.css')}}" />
    <link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <!-- Custom Css -->

    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}" />
    <link rel ="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js" defer></script>
  </head>

  <body class="theme-blush">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
      <div class="loader">
        <div class="m-t-30">
          <img
            class="zmdi-hc-spin"
            src="../assets/images/loader.png"
            width="48"
            height="48"
            alt=""
          />
        </div>
        <p>Please wait...</p>
      </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Main Search -->
    <div id="search">
      <button
        id="close"
        type="button"
        class="close btn btn-primary waves-effect waves-light btn-icon btn-icon-mini btn-round"
      >
        x
      </button>
      <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary waves-effect waves-light">Search</button>
      </form>
    </div>

    <!-- Right Icon menu Sidebar -->

    @include('layouts.reviewer-left-sidebar')

    <!-- Main Content -->

    @yield('content')

      <!-- Jquery Core Js -->
      <script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script>
      <!-- Lib Scripts Plugin Js -->
      <script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script>
      <!-- Lib Scripts Plugin Js -->
  
      <!-- Jquery DataTable Plugin Js -->
      <script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
      <script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
      <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
      <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js')}}"></script>
      <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
      <script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js')}}"></script>
  
      <script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>
      <!-- Custom Js -->
      <script src="{{asset('assets/js/pages/tables/jquery-datatable.js')}}"></script>
    </body>

    <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
    </script>
  </html>
