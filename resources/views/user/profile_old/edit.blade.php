@extends('user.layouts.app')

@section('content')



<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="bg-picture card-body">


                    <div class="mb-3 row"> 
                        <div class="clearfix col-6"><h4>Hi {{$uinfo->name}} ,</h4></div>
                        <div class="clearfix col-6 text-end">It's {{date('l')}} , {{date('F')}} {{date('d')}} ,{{date('Y')}}</div>
                    </div>
 
                    <div class="d-flex align-items-top deactive-all-tab">
                        <div class="mb-3 mx-2 text-center">
                            <a href="{{route('my_profile')}}" id="my-profile" >
                            <img src="{{asset('assets/icon/my_profile.png')}}"
                                class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start border-3 border-info"
                                alt="profile-image">
                            <div class="clearfix">My Profile</div>
                            </a>
                        </div>
                        <div class="mb-3 mx-2 text-center">
                            <a href="{{route('team.list')}}" id="my-team"">
                            <img src="{{asset('assets/icon/my_team.png')}}"
                                class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                alt="profile-image">
                            <div class="clearfix">My Team</div>
                        </a>
                        </div>
                        <div class="mb-3 mx-2 text-center">
                            <a href="{{route('perform.list')}}">
                            <img src="{{asset('assets/icon/my_performance.png')}}"
                                class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                alt="profile-image">
                            <div class="clearfix">My Performance</div>
                        </a>
                        </div>
                        <div class="mb-3 mx-2 text-center">
                            <a href="{{route('my_leave')}}">
                            <img src="{{asset('assets/icon/my_time_off.png')}}"
                                class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                alt="profile-image">
                            <div class="clearfix">My Time Off</div>
                        </a>
                        </div>
                        <div class="mb-3 mx-2 text-center">
                            <a href="{{route('training')}}" id="my-training">
                            <img src="{{asset('assets/icon/my_training.png')}}"
                                class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                alt="profile-image">
                            <div class="clearfix">My Training</div>
                        </a>
                        </div>
                    </div>

                    <div class="mydashboard-tab-show">
                      
                    </div> 
                    
                     {{-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body"> 
                                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Document Name</th>
                                                <th>Date Uploaded</th>
                                                <th>Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
               
                                        </tbody>
                                    </table>
                                </div>
                            </div>
               
                        </div>
                    </div> --}}

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
        $("#my-profile").trigger("click");
    });


     function clickMydashboards(e) { 
        $('.deactive-all-tab').find('img').removeClass('border-3 border-info');
       $(e).find('img').addClass('border-3 border-info');
        
         var contentUrl = "{{route('mydashboard.tabs')}}";
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
             type: "POST",
             url: contentUrl,
             data: {
                'tab':e.id
             },
             success: function(data) {
                $(".mydashboard-tab-show").html('');
                 $(".mydashboard-tab-show").html(data.view); 
             },
             error: function() {
                 alert("Failed to load content.");
             }
         });
     }


    function formSubmit(e) {
        $('#formSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmit')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('profile.update') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) {
                    toastr.success(response.message, 'Success');
                    window.setTimeout(function() {
                        window.location.reload();
                        $('#formSubmit').find('.st_loader').hide();
                    }, 500);
                } else {
                    $('#formSubmit').find('.st_loader').hide();
                    toastr.error("Find some error", 'Error');
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
      $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.table = $('#datatable').DataTable({
        ajax: {
            "url": "{{route('document-profile.list')}}",
            "type": "POST",
            "dataType": "json",

        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
            initComplete: function() {
                $("div.dataTables_length")
                    .html();
                    },
        columnDefs: [{
                targets: 0,
                mData: 'doc_name'
            },
            {
                targets: 1,
                mData: 'date'
            },
            {
                targets: 2,
                mData: 'categoryData'
            },
            {
                targets: 3,
                mData: 'action'
            }

        ]
    }); 
   
});

    
</script>
@endsection