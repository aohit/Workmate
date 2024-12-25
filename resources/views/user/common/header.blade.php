
@php
use App\Models\{Appraisal };
@endphp
@php
$admin =  App\Models\Admin::with('logoimage','prfileImage')->find(1);
@endphp
<style>
.badgeoutlinesuccess {
    background: rgb(251,186,63);
    background: radial-gradient(circle, rgba(251,186,63,1) -27%, rgba(252,70,107,1) 100%);
    font-size: 15px;
    font-family: system-ui;
    padding: 8px 20px;
    /* margin-top: 16px; */
    border-radius: 50px;
	font-weight: 600;
}
</style>

<header>
    <div class="navbar-custom">
    <div class="topbar d-flex align-items-center">
       <nav class="navbar navbar-expand">
          <div class="mobile-toggle-menu"><i class="bx bx-menu"></i>
          </div>
          <div class="search-bar flex-grow-1">
         
          </div>
          <div class="top-menu ms-auto">
             <ul class="navbar-nav align-items-center">

                @php

                $sessionValu =Session::get('AppraisalTaskdate');
            if(isset($sessionValu)){
                $storedDate = Session::get('AppraisalTaskdate');
                $currentDate = Carbon\Carbon::now()->format('Y/m/d');
                if($storedDate){
                    $storedDateTime = Carbon\Carbon::createFromFormat('Y/m/d', $storedDate);
                    $currentDateTime = Carbon\Carbon::createFromFormat('Y/m/d', $currentDate);
                    if ($currentDateTime->diffInHours($storedDateTime) >= 24) {
                        $afterOneDay = 1;
                         Session::put('isSelfShow','hidden');
                    }else{
                        $afterOneDay = 0;
                    }
                }
            } 
    
            $employee_id =  Auth::guard('web')->user()->id; 
            $rolesArr =  Auth::guard('web')->user()->getRoleNames(); 
                                $roles = '';
                                foreach($rolesArr as $role){
                                   $roles .= '<span class="badge badgeoutlinesuccess"><i class="fa fa-user-o pe-1" aria-hidden="true"></i>
                                      '.$role.'</span>';
                                }
                                  
                                
            $pendingRequest = App\Models\LeaveRequest::with('employee','leaveType')->where('is_leave',0)->whereHas('employee', function ($query) use($employee_id){
                            $query->where('reporting_to', $employee_id);
                           })->get(); 
    
               $leaveRequests = App\Models\LeaveRequest::with('employee','leaveType')->whereHas('employee', function ($query) use($employee_id){
                            $query->where('reporting_to', $employee_id);
                           })->get(); 
            $performanceReview = App\Models\Performance::with('employee','reviewTemp')->where('assign_manager_id', $employee_id)->get(); 
     
                $appraisalTasks = Appraisal::where('self_review',0)->where('user_id',$employee_id)->get();
                $appraisalTasksManager = Appraisal::where('self_review',1)->where('manager_review',0)->where('manager_id',$employee_id)->get();
    
                $goals = App\Models\GoalReview::with('user')->where('self_review',0)->where('employee_id', $employee_id)->get();
                $goalReviewManager = App\Models\GoalReview::where('self_review',1)->where('manager_review',0)->where('manager_id',$employee_id)->get();
                $sessionyear = App\Models\Session::where('is_default', 1)->first();
                $startyear = \DateTime::createFromFormat('m-Y', $sessionyear->start_year)
                ->modify('first day of this month') // Set to the first day of the month
                ->format('d M Y');
                $endyear = \DateTime::createFromFormat('m-Y', $sessionyear->end_year)
                            ->modify('last day of this month') // Set to the last day of the month
                            ->format('d M Y');
    
                $dateyear = $startyear . ' TO ' . $endyear;
                
                           @endphp 
    
           
    
            <li class="align-items-center me-2">
                {!! $roles !!}
            </li>
            <li class="dropdown d-none align-items-center mt-3 me-2">
                <span class="mb-0 badge bg-info">{{ $dateyear }}</span>
            </li>

                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">
                        @php
                        $pendingRequestCount = !empty($pendingRequest) ? count($pendingRequest) : 0;
                        $performanceReviewCount = !empty($performanceReview) ? count($performanceReview) : 0;
                        $appraisalTaskCount = !empty($appraisalTasks) ? count($appraisalTasks) : 0;
                        $appraisalTasksManagerCount = !empty($appraisalTasksManager) ? count($appraisalTasksManager) : 0;
                        $goalReviewCount = !empty($goals) ? count($goals) : 0;
                        $goalReviewManagerCount = !empty($goalReviewManager) ? count($goalReviewManager) : 0;
                        $totalSum = $pendingRequestCount + $performanceReviewCount + $appraisalTaskCount + $appraisalTasksManagerCount + $goalReviewCount + $goalReviewManagerCount;
                        @endphp 
                    {{ $totalSum }}
                    </span>
                    <i class="bx bx-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                       <a href="javascript:;">
                          <div class="msg-header">
                             <p class="msg-header-title">Notifications</p>
                             <p class="msg-header-clear ms-auto">Marks all as read</p>
                          </div>
                       </a>
                       <div class="header-message-list ps" style="height: 250px !important">
                        
                         
                        @if((!empty(count($leaveRequests))))
                        @foreach($leaveRequests as $leaveRequest)
                        @if($leaveRequest->is_leave == 0)
                      
                         <a class="dropdown-item" href="javascript:;"  onclick="viewLeaveRequest({{$leaveRequest->id}});return;false;">
                           <div class="d-flex align-items-center"> 
                               <div class="user-online">
                                 <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px">
                              </div>
                              <div class="flex-grow-1">
                                 <h6 class="msg-name">{{$leaveRequest->employee->name}}
                                 </h6>
                                 <p class="msg-info">{{$leaveRequest->leaveType->type}}</p>
                              </div>
                              </div>
                            </a> 

                        @endif
                        @endforeach
                        @endif
                        @if((!empty(count($performanceReview))))
                        @foreach($performanceReview as $review)
                        @if($review->status == 1)
                        {{-- <a href="javascript:void(0)" class="dropdown-item notify-item active"
                            onclick="viewPerformanceReview({{$review->id}});return;false;">
                            <div class="notify-icon">
                                <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                            <p class="notify-details">{{$review->employee->name}}</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>{{$review->reviewTemp->temp_name}}</small>
                            </p>
                        </a> --}}
                       
                      
                        <a class="dropdown-item" href="{{route('performance.request', ['id' => $review->id])}}" >
                            <div class="d-flex align-items-center"> 
                                <div class="user-online">
                                  <img src="assets/images/users/user-1.jpg" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">{{$review->employee->name}}
                                  </h6>
                                  <p class="msg-info">{{$review->reviewTemp->temp_name}}</p>
                               </div>
                               </div>
                             </a> 
                        @endif
                        @endforeach
                        @endif
                        @php
                        // for employee;
                        @endphp
                           @if(!empty($appraisalTasks))
                           @foreach($appraisalTasks as $appraisalTask)
                         
                           {{-- <a href="{{ route('user.appraisal') }}" class="dropdown-item notify-item active">
                               <div class="notify-icon"> <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" /> </div>
                               <p class="notify-details">You have a New Task</p>
                               <p class="text-muted mb-0 user-msg">
                                   <small>complete it before <b> {{ Carbon\Carbon::createFromFormat('Y-m-d', $appraisalTask->self_review_deadline)
                                       ->format('d/M/Y');}} </b> </small>
                               </p>
                               </a>  --}}
                               <a class="dropdown-item" href="{{ route('user.appraisal') }}" >
                                <div class="d-flex align-items-center"> 
                                    <div class="user-online">
                                      <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px">
                                   </div>
                                   <div class="flex-grow-1">
                                      <h6 class="msg-name">You have a New Task
                                      </h6>
                                      <p class="text-muted mb-0 user-msg">
                                        <small>complete it before <b> {{ Carbon\Carbon::createFromFormat('Y-m-d', $appraisalTask->self_review_deadline)
                                            ->format('d/M/Y');}} </b> </small>
                                    </p>
                                   </div>
                                   </div>
                                 </a>
                           @endforeach
                              @endif

                              @if(!empty($goals))
                              @foreach($goals as $goal)
                            
                              <a href="{{ route('goalreview') }}" class="dropdown-item notify-item active">
                                  <div class="notify-icon"> <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px"/> </div>
                                  <p class="notify-details">You have a New Goals Review</p>
                                  <p class="text-muted mb-0 user-msg">
                                      <small>complete it. 
                                       {{-- <b>{{  $goal->self_review_submitted  }} </b> --}}
                                        </small>
                                  </p>
                                  </a> 
                              @endforeach
                                 @endif 

                               @php
                                     // for manager;
                               @endphp

                               @if(!empty($appraisalTasksManager))
                                   @foreach($appraisalTasksManager as $managerAppraisalTasks)

                                       {{-- <a href="{{ route('user.appraisal.index') }}" class="dropdown-item notify-item active">
                                           <div class="notify-icon"> <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle" alt="" /> </div>
                                           <p class="notify-details">You have a New Task</p>
                                           <p class="text-muted mb-0 user-msg">
                                               <small>complete it before <b> {{ Carbon\Carbon::createFromFormat('Y-m-d', $managerAppraisalTasks->manager_review_deadlin)
                                                   ->format('d/M/Y');}} </b> </small>
                                           </p>
                                           </a>  --}}

                                           <a class="dropdown-item" href="{{ route('user.appraisal.index') }}" >
                                            <div class="d-flex align-items-center"> 
                                                <div class="user-online">
                                                  <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px">
                                               </div>
                                               <div class="flex-grow-1">
                                                  <h6 class="msg-name">You have a New Task
                                                  </h6>
                                                  <p class="text-muted mb-0 user-msg">
                                                    <small>complete it before <b> {{ Carbon\Carbon::createFromFormat('Y-m-d', $managerAppraisalTasks->manager_review_deadlin)
                                                   ->format('d/M/Y');}} </b> </small>
                                                </p>
                                               </div>
                                               </div>
                                             </a>
                                   @endforeach
                               @endif

                               @if(!empty($goalReviewManager))
                               @foreach($goalReviewManager as $managerGoalReview)
                             
                               <a href="{{ route('goalreview.team.list') }}" class="dropdown-item notify-item active">
                                   <div class="notify-icon"> <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px" /> </div>
                                   <p class="notify-details">You have a New Goals Review</p>
                                   <p class="text-muted mb-0 user-msg">
                                       <small>complete it. 
                                           {{-- <b>{{  $managerGoalReview->self_review_submitted  }} </b> --}}
                                        </small>
                                   </p>
                                   </a> 

                                   <a class="dropdown-item" href="{{ route('user.appraisal.index') }}" >
                                    <div class="d-flex align-items-center"> 
                                        <div class="user-online">
                                          <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-1.jpg') }}" class="img-fluid rounded-circle mx-2" alt="" height="45px" width="45px">
                                       </div>
                                       <div class="flex-grow-1">
                                          <h6 class="msg-name">You have a New Goals Review</h6>
                                          <p class="text-muted mb-0 user-msg">
                                            <small>complete it</small>
                                        </p>
                                       </div>
                                       </div>
                                     </a>
                               @endforeach
                                  @endif 
                       
                               
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                           <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                           <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                     </div>
                       <a href="javascript:;">
                          <div class="text-center msg-footer">View All Notifications</div>
                       </a>
                    </div>
                 </li> 
              
            
               
             </ul>
          </div>
          <div class="user-box dropdown">
             <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               @if($admin->logo)
               <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image?->file) : asset('assets/images/users/user-1.jpg') }}" alt="user-image" class="rounded-circle" height="30px" width="30px">
               @endif
                {{-- <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar"> --}}
                <div class="user-info ps-3">
                   <p class="user-name mb-0"> {{ Auth::guard('web')->user()->name }}  </p>
                   <p class="designattion mb-0">  {{ Auth::guard('web')->user()->name }}  </p>
                </div>
             </a>
             <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{route('profile.edit')}}"><i class="bx bx-user"></i><span>Profile</span></a>
                </li>
                <li>
                   <div class="dropdown-divider mb-0"></div>
                </li>
                <li>
                  {{-- <form id="myForm" method="POST">
                     @csrf --}}
                     
                     <a id="submitButton" href="auth-logout.html" class="dropdown-item notify-item dropdown-item">
                         <i class="bx bx-log-out-circle"></i><span>Logout</span>
                     </a>
                 {{-- </form> --}}
                  {{-- <a class="dropdown-item" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a> --}}
                </li>
             </ul>
          </div>
       </nav>
    </div>
    </div>
 </header>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <script>
    function viewLeaveRequest(reqId) {
        var url = "{{route('userleave.request')}}"
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: "POST", 
        data:{'reqId':reqId},
        success: function(res) {
            $(".modal-body-data").html(res);
                $("#bs-example-modal-lg").modal("show");
        },
        error: function(data) {
            if (typeof data.responseJSON.status !== 'undefined') {
                toastr.error(data.responseJSON.error, 'Error');
            } else {
                $.each(data.responseJSON.errors, function(key, value) {
                    toastr.error(value, 'Error');
                });
            }
            console.log('Error:', data);
        }
    });
    }

    $(document).ready(function() {
     appraisalTaskPopUp();
     appraisalTaskPopUpManager();
     goalReviewTaskPopUp();
     GoalTaskPopUpManager();
     });


     function appraisalTaskPopUp(){

         var data = @json($appraisalTasks);
         count = 0;
         var taskid;
         data.forEach( function(taskData) {

            function stripTime(date) {
                   return new Date(date.getFullYear(), date.getMonth(), date.getDate());
             }
             var taskDate =  new Date(taskData.self_popup_date) ;
             var currentDate = new Date();

             var strippedTaskDate = stripTime(taskDate);
              var strippedCurrentDate = stripTime(currentDate);
 
             if(taskData.self_popup_date !== null){
                 if(taskData.self_popup == 0 && strippedTaskDate < strippedCurrentDate){
                  taskid = taskData.id
                    updateAppraisalPopUp(taskid,0);
                    count++;
                }

            }else{
           
                if(taskData.self_popup == 0 && taskData.self_popup_date === null){
                  taskid = taskData.id
                  updateAppraisalPopUp(taskid,0);
                    count++;
                }

            }
            });

                if(count > 0){
                    toastr.success('You have a new task', 'Info');
                     
                }

    }

    function appraisalTaskPopUpManager(){

            var data = @json($appraisalTasksManager);
            count = 0;
            var taskid;
            data.forEach( function(taskData) {

            function stripTime(date) {
                    return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                }
                var taskDate =  new Date(taskData.manager_popup_date) ;
                var currentDate = new Date();

                var strippedTaskDate = stripTime(taskDate);
                var strippedCurrentDate = stripTime(currentDate);
                if(taskData.manager_popup_date !== null){
                    if(taskData.self_popup == 0 && strippedTaskDate < strippedCurrentDate){
                    taskid = taskData.id
                     updateAppraisalPopUp(taskid,1);
                    count++;
                }

            }else{
            
                if(taskData.self_popup == 0 && taskData.manager_popup_date === null){
                    taskid = taskData.id
                     updateAppraisalPopUp(taskid,1);
                    count++;
                }

            }
            });

        if(count > 0){
            toastr.success('You have a new task', 'Info');
                
        }

    }


    function updateAppraisalPopUp(appid,type){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
        url: "{{ route('appraisal.popstatus') }}",
        type: "POST", 
        data:{
            'appraisalId':appid,
            'type':type

        },
        success: function(res) {
           
        },
        error: function(data) {
            if (typeof data.responseJSON.status !== 'undefined') {
                toastr.error(data.responseJSON.error, 'Error');
            } else {
                $.each(data.responseJSON.errors, function(key, value) {
                    toastr.error(value, 'Error');
                });
            }
        }
    });
    }

    function goalReviewTaskPopUp(){
        var data = @json($goals);
        count = 0;
        var taskid;
        data.forEach( function(reviewData) {

        function stripTime(date) {
                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
            }
            var taskDate =  new Date(reviewData.self_popup_date) ;
            var currentDate = new Date();

            var strippedTaskDate = stripTime(taskDate);
            var strippedCurrentDate = stripTime(currentDate);

            if(reviewData.self_popup_date !== null){
                if(reviewData.self_popup == 0 && strippedTaskDate < strippedCurrentDate){
                taskid = reviewData.id
                updateGoalReviewPopUp(taskid,0);
                count++;
            }

        }else{
            if(reviewData.self_popup == 0 && reviewData.self_popup_date === null){
                taskid = reviewData.id
                updateGoalReviewPopUp(taskid,0);
                count++;
            }
        }
        });
            if(count > 0){
                toastr.success('You have a new Goal Review task', 'Info');
                    
            }
        }

        function GoalTaskPopUpManager(){

            var data = @json($goalReviewManager);
            count = 0;
            var taskid;
            data.forEach( function(goalReview) {

            function stripTime(date) {
                    return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                }
                var taskDate =  new Date(goalReview.manager_popup_date) ;
                var currentDate = new Date();

                var strippedTaskDate = stripTime(taskDate);
                var strippedCurrentDate = stripTime(currentDate);
                if(goalReview.manager_popup_date !== null){
                    if(goalReview.manager_popup == 0 && strippedTaskDate < strippedCurrentDate){
                    taskid = goalReview.id
                    updateGoalReviewPopUp(taskid,1);
                    count++;
                }
            }else{
                if(goalReview.manager_popup == 0 && goalReview.manager_popup_date === null){
                    taskid = goalReview.id
                    updateGoalReviewPopUp(taskid,1);
                    count++;
                }
            }
            });
            if(count > 0){
            toastr.success('You have a new Goal Review task', 'Info'); 
            }
        }


        function updateGoalReviewPopUp(appid,type){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
                });
            $.ajax({
            url: "{{ route('goalreview.popstatus') }}",
            type: "POST", 
            data:{
                'appraisalId':appid,
                'type':type

            },
            success: function(res) {
            
            },
            error: function(data) {
                if (typeof data.responseJSON.status !== 'undefined') {
                    toastr.error(data.responseJSON.error, 'Error');
                } else {
                    $.each(data.responseJSON.errors, function(key, value) {
                        toastr.error(value, 'Error');
                    });
                }
            }
        });
    }
 
</script>