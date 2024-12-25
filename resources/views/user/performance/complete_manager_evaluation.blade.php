@extends('user.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">{{$sub_title}}</h4>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="allPerformanceTab(this, {{$performance->id}}, 'goals')"
                                class="nav-link remove-active active">
                                Goals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="allPerformanceTab(this, {{$performance->id}}, 'compet')" class="nav-link remove-active-other">
                                Competencies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="allPerformanceTab(this, {{$performance->id}}, 'develop')" class="nav-link remove-active-other">
                                Development Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="allPerformanceTab(this, {{$performance->id}}, 'overall')" class="nav-link remove-active-other">
                                Overall
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)"
                                onclick="allPerformanceTab(this, {{$performance->id}}, 'summary')" class="nav-link remove-active-other">
                                Summary
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="all-performance-tab">

                    </div> 
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->

    </div>

</div>

@endsection

@section('page-js-script')
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script> 
<script>
    var perform_id = {{$performance->id}}; 
    allPerformanceTab(this, perform_id ,'goals')
    function allPerformanceTab(e, performance_id, tab) {
        if(tab != 'goals'){
            $('.remove-active').removeClass('active');
        } 
        $('.remove-active-other').removeClass('active');
        $(e).addClass('active'); 
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: "POST",
            url: "{{route('performance.tab')}}",
            data: {
                'tab': tab,
                'performance_id': performance_id
            },
            success: function(res) {
                $("#all-performance-tab").html(res.view); 
            },
            error: function() {
                alert("Failed to load content.");
            }
        });
    }

    function formSubmit(e) {
        $confirm = confirm("Are you sure you want to complete manager evalution?");
        if ($confirm) {
            $('#formSubmit').find('.st_loader').show();
            event.preventDefault();
            var formData = new FormData($('#formSubmit')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('performance.manager.review.update') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                        window.setTimeout(function() {
                            $('#formSubmit').find('.st_loader').hide();
                            var performanceId = response.performance_id;
                            var redirectUrl =
                                "{{ route('performance.request.complete', ['id' => ':performanceId']) }}";
                            redirectUrl = redirectUrl.replace(':performanceId', performanceId);
                            window.location.href = redirectUrl;
                        }, 1000);
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
    }
</script>
@endsection