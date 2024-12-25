@php
$admin =  App\Models\Admin::with('logoimage','prfileImage')->find(1);
@endphp

<div class="left-side-menu" id="left-side-menu">

    <div class="h-100" data-simplebar>
    
        <!-- User box -->
        <div class="user-box text-center">
            @if($admin->logo)
              <img src="{{asset('uploads/employee/'.$admin->prfileImage->file)}}" alt="user-img" title="Mat Helme"
                class="rounded-circle img-thumbnail avatar-md">
            @else
                <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                class="rounded-circle img-thumbnail avatar-md">
            @endif
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"
                    aria-expanded="false">{{Auth::guard('admin')->user()->name}}</a> 
                <div class="dropdown-menu user-pro-dropdown">
    
                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>
    
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a> --}}
    
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>
    
                    <!-- item-->
    
                    <a id="submitButton" href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>
    
    
                </div>
            </div>
    
            {{-- <p class="text-muted left-user-info">Admin Head</p> --}}
    
            {{-- <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" class="text-muted left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>
    
                <li class="list-inline-item">
                    <a href="#">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul> --}}
        </div>
    
        <!--- Sidemenu -->
        <div id="sidebar-menu" class="sidebar-menu-item">
    
            <ul id="side-menu">
    
                <li class="menu-title">Navigation</li>
    
                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="badge bg-success rounded-pill float-end"></span>
                        <span> Workforce Overview </span>
                    </a>
                </li>
    
                <li class="menu-title mt-2">Apps</li>
    
    
                <li>
                    <a href="#email" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span> User Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="email">
                        <ul class="nav-second-level"> 
                            <li>
                                <a href="{{route('admin.employee')}}">Employees</a>
                            </li> 
                            <li>
                                <a href="{{route('admin.roles')}}">Access Management</a>
                            </li>  
                            <li>
                                <a href="{{route('admin.department')}}">Departments</a>
                            </li>
                            <li>
                                <a href="{{route('admin.announcement')}}">Announcements</a>
                            </li>
                            <li>
                                <a href="{{route('admin.year-session')}}">
                                    <span>Session List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> 

                <li>
                    <a href="#goal" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Goals</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="goal">
                        <ul class="nav-second-level"> 
                            <li>
                                <a href="{{route('admin.goal')}}">
                                    <span>Goals</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.goal-category')}}">
                                    
                                    <span>Goal Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.goal-status')}}">
                                  
                                    <span>Goal Status</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.goaloverview')}}">
                                    <span>Goals Overview</span>
                                </a>
                            </li>
            
                        </ul>
                    </div>
                </li> 
    
                <li>
                    <a href="#performance" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Performance</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="performance">
                        <ul class="nav-second-level"> 
                            <li>
                                <a href="{{route('admin.appraisal')}}">Assign Questionnaire </a>
                            </li> 
                            <li>
                                <a href="{{route('admin.goalreview')}}">
                                    <span>Goal Review</span>
                                </a>
                            </li> 

                            <li>
                                <a href="{{route('admin.disciplinary')}}">Disciplinary Actions</a>
                            </li>  
                           
                        </ul>
                    </div>
                </li> 

                <li>
                    <a href="#leave" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Leave</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="leave">
                        <ul class="nav-second-level"> 
                           <li>
                                <a href="{{route('admin.leave')}}">Book Leave</a>
                            </li>  
                            <li>
                                <a href="{{route('admin.leavetype')}}">Leave Type</a>
                            </li>
                            <li>
                                <a href="{{route('admin.holiday')}}">Public Holidays</a>
                            </li>  
                            <li>
                                <a href="{{route('admin.calendar.getleave')}}">Full Leave Calendar</a>
                            </li>  
                            <li>
                                <a href="{{route('admin.calendar')}}">Leave Calender</a>
                            </li>
                          
                        </ul>
                    </div>
                </li> 
    


                <li>
                    <a href="#settingparameter" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Setting  Parameters</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="settingparameter">
                        <ul class="nav-second-level"> 
                            <li>
                                <a href="{{route('admin.questionnaire')}}">Manage Questionnaires</a>
                            </li>  
                            <li>
                                <a href="{{route('admin.rating-scales')}}">Rating Scales</a>
                            </li>
                            <li>
                                <a href="{{route('admin.review-cycle')}}">Review Cycle</a>
                            </li>
                            <li>
                                <a href="{{route('admin.disciplinaryactiontype')}}">
                                    <span>Disciplinary Action Type</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> 

                
                <li>
                    <a href="{{route('admin.talent_search')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Talent Search</span>
                    </a>
                </li> 
    
               
                <li>
                    <a href="#resource" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Resources</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="resource">
                        <ul class="nav-second-level"> 
                            <li>
                                <a href="{{route('admin.resources')}}">Company Resources</a>
                            </li> 
                            <li>
                                <a href="{{route('admin.document-category')}}">Document Categories</a>
                            </li>
                            <li>
                                <a href="{{route('admin.team.list')}}">Employee Directory</a>
                            </li> 
                            <li>
                                <a href="{{route('admin.emergencycontact')}}">Employee Emergency Contacts</a>
                            </li> 
                            <li>
                                <a href="{{route('admin.skills')}}"><span>Employee Skills</span></a>
                            </li>
                            <li>
                                <a href="{{route('admin.training')}}"><span>Employee Training</span> </a>
                            </li> 
                            <li>
                                <a href="{{route('admin.certificate')}}"><span>Employee Certificate</span></a>
                            </li>
                        </ul>
                    </div>
                </li> 
    
                <li>
                    <a href="#reports" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Reports</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="reports">
                        <ul class="nav-second-level"> 
                            {{-- <li>
                                <a href="{{route('admin.language')}}"><span>Language</span> </a>
                            </li>  --}}
                            <!-- <li>
                                <a href="{{route('admin.disciplinary')}}">Disciplinary Actions</a>
                            </li> -->
                            {{-- <li>
                                <a href="{{route('admin.education')}}">Employee Education</a>
                            </li> --}}
                            <li>
                                <a href="{{route('admin.wagesbenefits')}}">Employee Wages and Benefits </a>
                            </li>
    
                        </ul>
                    </div>
                </li> 
                
                {{-- <li>
                    <a href="{{route('admin.disciplinaryactiontype')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Disciplinary Action Type</span>
                    </a>
                </li>  --}}
               
                {{-- <!-- <li>
                    <a href="{{route('admin.leave')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Administration</span>
                    </a>
                </li>  --> --}}

                {{-- <li>
                    <a href="{{route('admin.skills')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Employee Skills</span>
                    </a>
                </li> --}}
              
    
                {{-- <li>
                    <a href="{{route('admin.language')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Language</span>
                    </a>
                </li>  --}}
                
               {{-- <li>
                    <a href="{{route('admin.certificate')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Certificate</span>
                    </a>
                </li>  --}}
                    
               
              
                {{-- <li>
                    <a href="{{route('admin.training')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Training</span>
                    </a>
                </li> 
            --}}

                {{-- <li>
                    <a href="{{route('admin.document')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Document</span>
                    </a>
                </li>   --}}

                {{-- <li>
                    <a href="{{route('admin.review-cycle')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Review cycle</span>
                    </a>
                </li>  --}}

                {{-- <li>
                    <a href="{{route('admin.goalreview')}}">
                        <i class="mdi mdi-account-multiple-plus-outline"></i>
                        <span>Goal Review</span>
                    </a>
                </li>  --}}
     
            </ul> 
    
        </div>
        <!-- End Sidebar -->
    
        <div class="clearfix"></div>
    
    </div>
    <!-- Sidebar -left -->
    
    </div>