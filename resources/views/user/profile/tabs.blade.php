@extends('user.layouts.app')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="bg-picture card-body">


                        <div class="mb-3 row align-items-baseline">
                            <div class="clearfix col-md-6">
                                <h5>Hi {{ $uinfo->name }} ,</h5>
                            </div>
                            <div class="clearfix col-md-6 text-md-end">It's {{ date('l') }} , {{ date('F') }}
                                {{ date('d') }} ,{{ date('Y') }}</div>
                        </div>

                        <div class="d-flex flex-wrap gap-sm-0 gap-3">
                            <div class="mb-3 mx-2 text-center">
                                <a href="{{ route('my_profile') }}" id="my-profile">
                                    <img src="{{ asset('assets/icon/my_profile.png') }}"
                                        class="flex-shrink-0 rounded-circle img-thumbnail float-start border-3 border-info"
                                        alt="profile-image" height="100px" width="100px">
                                    <div class="clearfix">My Profile</div>
                                </a>
                            </div>
                            <div class="mb-3 mx-sm-2 text-center">
                                <a href="{{ route('team.list') }}" id="my-team"">
                                    <img src="{{ asset('assets/icon/my_team.png') }}"
                                        class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                        alt="profile-image" height="100px" width="100px">
                                    <div class="clearfix">My Team</div>
                                </a>
                            </div>
                            <div class="mb-3 mx-sm-2 text-center">
                                <a href="{{ route('user.appraisal') }}">
                                    <img src="{{ asset('assets/icon/my_performance.png') }}"
                                        class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                        alt="profile-image" height="100px" width="100px">
                                    <div class="clearfix">My Performance</div>
                                </a>
                            </div>
                            <div class="mb-3 mx-sm-2 text-center">
                                <a href="{{ route('my_leave') }}">
                                    <img src="{{ asset('assets/icon/my_time_off.png') }}"
                                        class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                        alt="profile-image" height="100px" width="100px">
                                    <div class="clearfix">My Leave</div>
                                </a>
                            </div>
                            <div class="mb-3 mx-sm-2 text-center">
                                <a href="{{ route('user.myTraining') }}" id="my-training">
                                    <img src="{{ asset('assets/icon/my_training.png') }}"
                                        class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start"
                                        alt="profile-image" height="100px" width="100px">
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
            <div class="col-lg-8">
                <div class="row">
                    
                    <div class="col-12">

                        @if (auth('web')->user()->hasPermissionTo('manager-disciplinary') || auth('web')->user()->hasPermissionTo('hr-disciplinary'))
                        <div class="card ">
                            <div class="container 
                            mt-2" id="second">
                                <div class="h-100">
                                    <ul class="nav nav-tabs item2" id="myTabs2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab11-tab" href="{{ route('myPrformanceReview') }}" data-target="#tab11"
                                                role="tab" aria-controls="tab11" aria-selected="true">My Performance Review</a>
                   
                                        </li>
                                        <li class="nav-item">
                                            @if(auth('web')->user()->hasPermissionTo('hr-disciplinary'))
                                                <a class="nav-link" id="tab22-tab" href="{{ route('hrTeamPerformanceReview') }}" data-target="#tab22"
                                                    role="tab" aria-controls="tab22" aria-selected="false">My Team Performance Review</a>
                                            @else
                                            <a class="nav-link" id="tab22-tab" href="{{ route('myTeamPerformanceReview') }}" data-target="#tab22"
                                            role="tab" aria-controls="tab22" aria-selected="false">My Team Performance Review</a>
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="profile-bottom" id="myTabsContent2">
                                        <div class="tab-info fade" id="tab11" aria-labelledby="tab11-tab"></div>
                                        <div class="tab-info fade" id="tab22" aria-labelledby="tab22-tab"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h6 class=""> My Performance Review</h6>
                                    </div>
                                    {{-- <div class="col-3">
                                        @if(auth('web')->user()->hasPermissionTo('performance'))
                                            <a href="{{ route('user.appraisal') }}">Go to My Performance</a>
                                        @endif
                                    </div> --}}
                                </div>
                                <div class="tab-content py-3">
                                    <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-2 rounded-3 text-center py-1">
                                                <div class="rounded-circle mx-auto pt-2" style="background-color:#4c08a5;height: 90px;width: 90px;">
                                                    @php
                                                        $user = $tasks->count();
                                                        $manager = $mantaks->count();
                                                        $pendingtask = $user + $manager;
                                                    @endphp
                                                    <h4 class="text-center text-white  m-0">{{ $pendingtask }}</h4>
                                                    <h5 class="text-center text-white  m-0">Pending</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-10 text-md-start text-center">
                                                <p>
                                                    You have tasks pending completion. Go to @if (auth('web')->user()->hasPermissionTo('performance'))
                                                        <a href="{{ route('user.appraisal') }}"> My Performance </a>
                                                    @endif to complete before the due date
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-9">
                                        <h6 class="">Manage Goals</h6>
                                    </div>
                                    <div class="col-3">
                                        {{-- @if (auth('web')->user()->hasPermissionTo('performance'))
                                            {{-- <a href="{{ route('user.appraisal') }}">Go to My Performance</a> --}}
                                        {{-- @endif --}} 
                                    </div>
                                </div>
                                <div class="tab-content py-3">
                                    <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-2 rounded-3 text-center py-1">
                                                <div class="rounded-circle mx-auto pt-2" style="background-color:#9761dd;height: 90px;width: 90px;">
                                                    @php
                                                        $userreview = $goalreview->count();
                                                        $managerreview = $managergoalreview->count();
                                                        $pendingreview = $userreview + $managerreview;
                                                        // echo "<pre>";print_r($user);die;
                                                    @endphp
                                                    <h4 class="text-center text-white  m-0">{{ $pendingreview }}</h4>
                                                    <h5 class="text-center text-white  m-0">Pending</h5>
                                                </div>
                                            </div>
                                            <div class="col-md-10 text-md-start text-center">
                                                <p>
                                                    You have tasks pending completion. Go to @if (auth('web')->user()->hasPermissionTo('goal'))
                                                        <a href="{{ route('goalreview') }}">Manage Goals</a>
                                                    @endif to complete before the due date
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-12">
                        <div class="card">

                            <div class="card-body ">
                                <h4 class="">My Goals</h5>
                                <div class="tab-content py-3">
                                    <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="row d-flex ">
                                                    <div class="col-sm-5"><h5>Review Cycle</h5></div>
                                                    <div class="col-sm-7">
                                                        <select class="form-select" id="reviewCycle" onchange="goals(this)" >
                                                            @foreach ($reviewCycles as $reviewCycle)
                                                            <option value="{{ $reviewCycle->id }}">{{  $reviewCycle->title }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="" id="paichart">
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row d-flex ">
                                                    <div class="col-md-6"><h5>Quick Overview(max 5)</h5></div>
                                                    <div class="col-md-6">
                                                        <select class="form-select" id="quickoverciew" onchange="quickoverview(this)">
                                                            <option value="updaterecently">Update Recently</option>
                                                            <option value="duesoon">Due Soon </option>
                                                            <option value="overdue">Overdue</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mt-4" id="quickview">
                                                 
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

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background: #fff; w-100">
                            <div class="">
                                <h4 class="p-3 mx-2">Company Announcement</h4>
                                <div class="tab-content py-2 " style="height: 400px; overflow: auto">
                                    <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                                        {{-- <div class="row"> --}}

                                            @foreach ($announcements as $announcement)
                                            <div class="card w-75 mx-3 overdata" style="box-shadow: none !important;">
                                                <div class="card-body" style="background-color: {{ $announcement->background_color_id }}; border-radius:5%;">
                                                    <h5 class="card-title" style="color:{{ $announcement->text_color_id }};">
                                                        {{ $announcement->title }}</h5>
                                                    <h6 class="" style="color:{{ $announcement->text_color_id }};">
                                                        {{ date('d-m-Y', strtotime($announcement->created_at)) }}</h6>
                                                    <p class="card-text" style="color:{{ $announcement->text_color_id }};">
                                                        {{  substr($announcement->description, 0, 49) }}
                                                        <span id="readMore{{ $announcement->id }}" style="display:none;">
                                                        {{  substr($announcement->description, 49) }}
                                                        </span>
                                                        <a href="#" onclick="toggleReadMore({{ $announcement->id }})"
                                                           id="readMoreBtn{{ $announcement->id }}">Read More</a>
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
            goals();
            quickoverview();
        });


        function clickMydashboards(e) {
            $('.deactive-all-tab').find('img').removeClass('border-3 border-info');
            $(e).find('img').addClass('border-3 border-info');

            var contentUrl = "{{ route('mydashboard.tabs') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {
                    'tab': e.id
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
                    "url": "{{ route('document-profile.list') }}",
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

        function toggleReadMore(id) {
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

        function goals(e){

            var contentUrl = "{{ route('dashboardchart') }}";
            var reviewCycle = $('#reviewCycle').val();
    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {
                   'reviewcycle' :reviewCycle
                },
                success: function(data) {
                    $('#paichart').html(data.view);
                     const ctx = document.getElementById('pieChart').getContext('2d');
                    const goalStatus = (data.goalstatus);

                        const GoalTitle = [];
                        const Goalcolor = [];
                        const percent = [];

                        goalStatus.forEach(element => {
                            GoalTitle.push(element.title);
                            Goalcolor.push(element.background_color);
                             percent.push(parseFloat(element.totalProgressPercentage).toFixed(2));
                        });
                    const pieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: GoalTitle,
                            datasets: [{
                                data: percent,
                                backgroundColor: Goalcolor,
                            }],
                        },
                       options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            datalabels: {
                                formatter: (value, context) => {
                                    return value + '%';
                                },
                                color: '#fff',
                                labels: {
                                    title: {
                                        font: {
                                            weight: 'bold'
                                        }
                                    },
                                },
                            },
                        }
                    },
                    });
                    
                },
                error: function() {
                    alert("Failed to load content.");
                }
            });
        }

        function quickoverview(e){
            
            var contentUrl = "{{ route('dashboardorverview') }}";
            var quickoverciew = $('#quickoverciew').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {
                    'quickoverciew': quickoverciew
                },
                success: function(data) {
                    $('#quickview').html(data.view);
                },
                error: function() {
                    alert("Failed to load content.");
                }
            });
        }

       

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
                 $(active).load('{{ route('myPrformanceReview') }}');
                 $(active).addClass('show active');
             } else {
                 $('#tab11').load('{{ route('myPrformanceReview') }}');
                 $('#tab11').addClass('show active');
             }

         });

    </script>
@endsection
