@extends('user.layouts.app')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
          <div class="row">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="container">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link one active" id="tab1-tab" href="{{ route('employee_profile') }}"
                                        data-target="#tab1" role="tab" aria-controls="tab1"
                                        aria-selected="true">Employee</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-tab" href="{{ route('employee_skills') }}"
                                        data-target="#tab2" role="tab" aria-controls="tab2"
                                        aria-selected="false">Skills</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="tab3-tab" href="{{ route('wages-benefits') }}"
                                        data-target="#tab3" role="tab" aria-controls="tab3"
                                        aria-selected="false">Wages & Benefits</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="tab4-tab" href="{{ route('employee_certificate') }}"
                                        data-target="#tab4" role="tab" aria-controls="tab4"
                                        aria-selected="false">Certificates</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="tab5-tab" href="{{ route('employee_language') }}"
                                        data-target="#tab5" role="tab" aria-controls="tab5"
                                        aria-selected="false">Languages</a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="tab6-tab" href="{{ route('employee_dependents') }}"
                                        data-target="#tab6" role="tab" aria-controls="tab6"
                                        aria-selected="false">Dependents</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="tab7-tab" href="{{ route('employee_emergency') }}"
                                        data-target="#tab7" role="tab" aria-controls="tab7"
                                        aria-selected="false">Emergency
                                        Contacts</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabsContent">
                                <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                </div>
                                {{-- <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                </div> --}}
                                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                                </div>
                                <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
                                </div>
                                <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab7-tab">
                                </div>
                            </div>
                        </div>


                        <div class="container" id="second">
                            <div class="h-100">
                                <ul class="nav nav-tabs item2" id="myTabs2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab11-tab" href="{{ route('basic_info') }}"
                                            data-target="#tab11" role="tab" aria-controls="tab11"
                                            aria-selected="true">Basic Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab22-tab" href="{{ route('login_info') }}"
                                            data-target="#tab22" role="tab" aria-controls="tab22"
                                            aria-selected="false">Login Info</a>
                                    </li>
                                </ul>
                                <div class="profile-bottom" id="myTabsContent2">
                                    <div class="tab-info fade" id="tab11" aria-labelledby="tab11-tab"></div>
                                    <div class="tab-info fade" id="tab22" aria-labelledby="tab22-tab"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js-script')
<script>
    $(document).ready(function() {
        function loadTabContent(href, targetTab) {
            $.ajax({
                url: href,
                type: 'GET',
                success: function(data) {
                    $('#myTabsContent .tab-pane').html('').removeClass('show active');
                    $(targetTab).html(data).addClass('show active');
                    // console.error(targetTab);
                    // console.error(data);
                },
                error: function(error) {
                    // console.error(error);
                }
            });
        }
        $('#myTabs a').click(function(e) {
            e.preventDefault();
            var targetTab = $(this).attr('data-target');
            var href = $(this).attr('href');

            loadTabContent(href, targetTab);
            $('#myTabs a').removeClass('active');
            $(this).addClass('active');

            localStorage.setItem('activeTab', targetTab);
        });

        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $(activeTab).load('{{ route('employee_profile') }}');
            $(activeTab).addClass('show active');
        } else {
            $('#tab1').load('{{ route('employee_profile') }}');
             $('#tab1').addClass('show active');
        }
    });

    $(document).ready(function() {
        function openTab(routeName, tabId) {
            $.ajax({
                url: routeName,
                type: 'GET',
                success: function(data) {
                    $('#myTabsContent2 .tab-info').html('').removeClass('show active');
                    $(tabId).html(data).addClass('show active');
                    // console.error(tabId);
                    // console.error(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#myTabs2 a').click(function(e) {
            e.preventDefault();
            var tabId = $(this).attr('data-target');
            var href = $(this).attr('href');

            openTab(href, tabId);
            $('#myTabs2 a').removeClass('active');
            $(this).addClass('active');

            localStorage.setItem('active', tabId);
        });
        var active = localStorage.getItem('active');

        if (active) {
            $(active).load('{{ route('basic_info') }}');
            $(active).addClass('show active');
        } else {
            $('#tab11').load('{{ route('basic_info') }}');
            $('#tab11').addClass('show active');
        }

    });

    $(document).ready(function() {
        $('#myTabs .nav-link').click(function() {
            var target = $(this).attr('data-target');
            $('.tab-info').removeClass('show active');
            // alert('RR');
            $('.item2').hide();
            $(target).addClass('show active');
            // console.error(target);
            //   console.error(target);
        });

        $('#myTabs .one').click(function() {
            $('.tab-info').addClass('show active');
            $('.item2').show();
        });
    });

    function addcertificate(e) {
        var contentUrl = "{{ route('employee.add_certificate') }}";
        $.ajax({
            type: "GET",
            url: contentUrl,
            success: function(data) {
                $(".modal-body-data").html(data);
                $("#bs-example-modal-lg").modal("show");
            },
            error: function() {
                alert("Failed to load content.");
            }
        });
    }

    function certificateSubmit(e) {
        $('#formSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmit')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('employee.store_certificate') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) {
                    toastr.success(response.message, 'Success');
                    $('#formSubmit').find('.st_loader').hide();
                    $("#bs-example-modal-lg").modal("hide");
                    $("#certificate").html(response.view);

                } else {
                    toastr.error("Find some error", 'Error');
                    $('#formSubmit').find('.st_loader').hide();
                }


            },
            error: function(xhr, status, error) {
                $('#formSubmit').find('.st_loader').hide();
                var $err = ''
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $err = $err + value + "<br>"
                })
                toastr.error($err, 'Error')
            }
        });
    }

    function deletecertificate(id) {
   
        if (confirm("Are You sure want to delete this certificate!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('employee.delete_certificate')}}",
                type: "POST", 
                data:{'id':id},
                success: function(res) {

                    if (res.success == 1) {
                            toastr.success(res.message, 'Success');
                            $("#certificate").html(res.view);
                        } else {
                            toastr.error("Find some error", 'Error');
                            $('#formSubmit').find('.st_loader').hide();
                        }
                },
                error: function(data) {
                    if (typeof data.responseJSON.status !== 'undefined') {
                        toastr.error(data.responseJSON.error, 'Error');
                    } else {
                        $.each(data.responseJSON.errors, function(key, value) {
                            toastr.error(value, 'Error');
                        });
                    }
                    // console.log('Error:', data);
                }
            });
        }
   }

</script>

@endsection
