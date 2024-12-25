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

       <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                           <h4 class="breadcrumb-title">Pending Task</h4>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('task') }}">Go to My Tasks</a>
                    </div>
                </div>
             <div class="tab-content py-3">
                 <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                     <div class="row">
                        <div class="col-2 rounded-3" style="background-color:#0029f3 ">
                            <h4 class="text-center text-white mt-1">{{ $tasks }}</h4>
                            <h5 class="text-center text-white mb-1">Task</h5>
                        </div>
                        <div class="col-10">
                            <p>
                                you have <span class="bg-danger px-1 rounded-2 text-white"> {{ $tasks }} </span> task to complete.Make sure you go to you tasks list and complete your pending tasks as soon as possible.
                            </p>
                        </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
    </div>

    <div class="col-12">
        <div class="card">
           
            <div class="card-body h-100">
             <h4 class="breadcrumb-title">My Goals</h4>
             <div class="tab-content py-3">
                 <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                     <div class="row">
 
                     </div>
                 </div>
             </div>
         </div>
     </div>
    </div> 
</div>
</div>
<div class="col-4">
    <div class="row">
        <div class="col-12">
            <div class="card" style="background: #fff; w-100">
                <div class="">
                 <h4 class="breadcrumb-title p-2">Company Announcement</h4>
                 <div class="tab-content py-3" style="height: 400px; overflow: auto">
                    <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                        {{-- <div class="row"> --}}
                        
                            @foreach($announcements as $announcement)
                            <div class="card w-75 mx-3 overdata">
                                <div class="card-body" style="background-color: {{$announcement->background_color_id}}; border-radius:5%;">
                                    <h4 class="card-title" style="color:{{ $announcement->text_color_id }};">{{ $announcement->title }}</h4>
                                    <h6 class="" style="color:{{ $announcement->text_color_id }};">{{ date('Y-m-d',strtotime( $announcement->created_at ))}}</h6>
                                    <p class="card-text" style="color:{{ $announcement->text_color_id }};">
                                        {{ substr($announcement->description, 0, 50) }}
                                        <span id="readMore{{$announcement->id}}" style="display:none;">{{ substr($announcement->description, 2) }}</span>
                                        <a href="#" onclick="toggleReadMore({{$announcement->id}})" id="readMoreBtn{{$announcement->id}}">Read More</a>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        {{-- </div> --}}
                    </div>
                    
                 </div>
             </div>
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

function toggleReadMore(id)
 {
    var readMoreElement = $("#readMore" + id);
    var btnText = $("#readMoreBtn" + id);

    if (readMoreElement.is(":visible")) {
        readMoreElement.hide();
        $('.overdata').removeClass('over');
        btnText.text("Read More");
    } else {
       // alert();
        readMoreElement.show();
        $('.overdata').addClass('over');
        btnText.text("Read Less");
    }
}
    
</script>
@endsection