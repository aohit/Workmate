<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Workmate') }}</title>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
      <!--favicon-->
      <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/png">
      <!--plugins-->
      <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
      <!-- loader-->
      <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
      <script src="{{ asset('assets/js/pace.min.js') }}"></script>
      <!-- Bootstrap CSS -->
      <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
      <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
      <!-- Theme Style CSS -->
      <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
  
      <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
      {{-- <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" /> --}}
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
      
      @yield('style')
   </head>
   <body>
      <div class="wrapper">
        <!-- Topbar Start -->
        @include('user.common.header')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('user.common.sidebar')
        <!-- Left Sidebar End -->

           <div class="page-wrapper">
        <div class="page-content">
          
           
            @yield('content')
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

            @include('user.common.footer')
            <!-- end Footer -->

        </div>
        </div>
    </div>
         
      {{-- </div>
     --}}


      <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content modal-body-data">
                 
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <!---------------|| Js Files ||--------------->
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <!--plugins-->
      <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
      <!--app JS-->
      <script src="{{ asset('assets/js/app.js') }}"></script>
      <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
      <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
      <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
      <!--Morris JavaScript -->
      <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
      <script src="{{ asset('assets/plugins/morris/js/morris.js') }}"></script>
      {{-- <script src="{{ asset("assets/js/index2.js") }}"></script> --}}
      <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }} "></script>
      <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
      <script src="{{ asset('assets/js/crud.js') }} "></script>
      <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
      {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">

      {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
      {{-- <script src="{{asset('assets/js/index2.js')}}"></script> --}}

      {{-- <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
      <script src="{{asset('assets/libs/spectrum-colorpicker2/spectrum.min.js')}}"></script>
      <script src="{{asset('assets/libs/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
  <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script> --}}

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>  --}}

    <script>
    $(document).ready(function() { 

        var current = window.location.href;
        // current = current.endsWith('/') ? current.slice(0, -1) : current;
        // document.querySelectorAll(`.sidebar-menu-item li a[href="${current}"]`).forEach(elem => {
        //     var liElem = elem.closest('li a');
        //     liElem.classList.add("active")
        // });
        // document.querySelectorAll(`.sidebar-menu-item. li a[href="${current}"]`).forEach(elem => {
        //     var liElem = elem.closest('li');
        //     liElem.classList.add("current")
        // });


        $('#submitButton').click(function(event) {
            event.preventDefault();
            var formData = new FormData($('#myForm')[0]);
            $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
            $.ajax({
                type: 'POST',
                url: "{{ route('logout') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    toastr.success('LogOut Successful!', 'Success');
                    setTimeout(function() {
                        window.location.href = "login";
                    }, 2000);
                    // console.log(response);
                },
                errors: function(xhr, status, error) {

                    toastr.error('An error occurred during the operation.', 'Error');
                    // console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
    @yield('page-js-script')
   </body>
</html>