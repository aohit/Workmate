<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Workmate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />-->
    <!--<meta content="Coderthemes" name="author" />-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->

    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="loading authentication-bg authentication-bg-pattern">
    @php
    $admin =  App\Models\Admin::with('logoimage','prfileImage')->find(1);
    @endphp
    <div class="account-pages my-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                         @if($admin->logoimage)
                        <a href="#">
                            <img src="{{asset('uploads/employee/'.$admin->logoimage->file)}}" alt="" height="40" class="mx-auto">
                        </a>
                    @else
                        <a href="#">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="22" class="mx-auto">
                        </a>
                    @endif
                        <p class="text-muted mt-2 mb-4">Employee Login</p>

                    </div>
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>

                            <form id="myForm" method="POST">
                                @csrf
                                <input type="hidden" name="is_login" value="1">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress" required=""
                                        placeholder="Enter your email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required=""
                                        id="password" placeholder="Enter your password">
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                            name="remember" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary" id="submitButton" type="submit"> Log In <i
                                        class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                        style="display:none;"></i></button>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    {{--<div class="row mt-3">
                        <div class="col-12 text-center">
                            <p> <a href="pages-recoverpw.html" class="text-muted ms-1"><i
                                        class="fa fa-lock me-1"></i>Forgot your password?</a></p>
                            <p class="text-muted">Don't have an account? <a href="pages-register.html"
                                    class="text-dark ms-1"><b>Sign Up</b></a></p>
                        </div> <!-- end col -->
                    </div>--}}
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>

    <script>
    $(document).ready(function() {
        // Assuming you have a button with id "submitButton"
        $('#submitButton').click(function(event) {
            event.preventDefault();
            $('#myForm').find('.st_loader').show();
            var formData = new FormData($('#myForm')[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('login') }}",
                data: formData,
                // dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                   
                    toastr.success('LogIn successful!', 'Success');
                    setTimeout(function() {
                        $('#myForm').find('.st_loader').hide();
                        window.location.href = "dashboard";
                    }, 1000);
                    
                },
                error: function(xhr, status, error) { 
                    $('#myForm').find('.st_loader').hide();
                    var $err = ''
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $err = $err + value + "<br>"
                    })
                    toastr.error($err, 'Error')
                }
            });
        });
    });
    </script>


</body>

</html>