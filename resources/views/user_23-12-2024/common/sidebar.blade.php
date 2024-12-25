<div class="left-side-menu">

<div class="h-100" data-simplebar>

    <!-- User box -->
    <div class="user-box text-center">
        @php
        //  echo "<pre>"; print_r(Auth::guard('web')->user()->Image->file);
        @endphp
        <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image?->file) : asset('assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
        <div class="dropdown">
            <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"
                aria-expanded="false">{{Auth::guard('web')->user()->name}}</a>
            {{-- <div class="dropdown-menu user-pro-dropdown">

                <!-- item-->
                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-user me-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-settings me-1"></i>
                    <span>Settings</span>
                </a> 

                <!-- item-->
                 <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-lock me-1"></i>
                    <span>Lock Screen</span>
                </a>

                <!-- item-->

                <a id="submitButton" href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="fe-log-out me-1"></i>
                    <span>Logout</span>
                </a> -


            </div> --}}
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
                <a href="{{route('profile.edit')}}">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="badge bg-success rounded-pill float-end"></span>
                    <span>My Dashboard</span>
                </a>
            </li>

            <li class="menu-title mt-2">Apps</li>

            <li>
                <a href="{{route('my_profile')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Profile</span>
                </a>
            </li> 

        
            @if (auth('web')->user()->hasPermissionTo('goal'))
            <li>
                <a href="#email" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Goals</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="email">
                    <ul class="nav-second-level"> 
                        <li>
                            <a href="{{route('goal',['id' => base64_encode(Auth::guard('web')->user()->id)])}}">Manage Goals</a>
                        </li> 
                        @php
                            $users = App\Models\User::select('id','manager_id')->where('manager_id',Auth::guard('web')->user()->id)->count();
                        @endphp 
{{-- 
                            @if (auth('web')->user()->hasPermissionTo('manager-goal-overview'))
                            <li>
                                <a href="{{route('goalorderview')}}">Goal Overview</a>
                            </li>  
                            @endif

                            @if (auth('web')->user()->hasPermissionTo('hr-goal-overview'))
                            <li>
                                <a href="{{route('hrgoaloverview')}}">
                                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                                    <span>Goal Overview</span>
                                </a>
                            </li>  
                            @endif
                         --}}
                            {{-- @if (auth('web')->user()->hasPermissionTo('hr-goal-overview'))
                            <li>
                                <a href="{{route('hrgoaloverview')}}"><span>Team goals overview</span></a>
                            </li>  
                            @endif --}}
                       
                    </ul>
                </div>
            </li> 
            @endif 
           
            <li>
                <a href="#performance" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Performance</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="performance">
                    <ul class="nav-second-level"> 
                        @if (auth('web')->user()->hasPermissionTo('performance'))
                        <li>
                            <a href="{{route('user.appraisal')}}">Performance Questionnaires</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('goalreview')}}"> <span>Goal Review</span></a>
                        </li> 
                    </ul>
                </div>
            </li> 

            <li>
                <a href="#myleave" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Leave</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="myleave">
                    <ul class="nav-second-level"> 
                        <li>
                            <a href="{{route('userleave')}}"> <span>Book Leave</span></a>
                        </li> 
            
                        <li>
                            <a href="{{route('my_leave')}}"><span>Leave Calendar</span></a>
                        </li> 
                    </ul>
                </div>
            </li> 
           

            <li>
                <a href="{{route('user.myTraining')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span> My Training</span>
                    </a>
            </li> 

            <li>
                <a href="#myteam" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Team</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="myteam">
                    <ul class="nav-second-level"> 
                        @if (auth('web')->user()->hasPermissionTo('team-goal-review'))
                        <li>
                            <a href="{{route('goalreview.team.list')}}"><span>Team Goals</span></a>
                        </li>  
                        @endif 

                        @if (auth('web')->user()->hasPermissionTo('team-performance'))
                        <li>
                            <a href="{{route('user.appraisal.index')}}"><span>Team Performance</span></a>
                        </li>
                        @endif

                        @if (auth('web')->user()->hasPermissionTo('leave'))
                        <li>
                            <a href="{{route('leave')}}"><span>Team Leave</span></a>
                        </li> 
                        @endif 
                        @if (auth('web')->user()->hasPermissionTo('training'))
                        <li>
                            <a href="{{route('user.training')}}"> <span>Team Training</span> </a>
                        </li> 
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('team-leave-calendar'))
                        <li>
                            <a href="{{route('calendar.getleave')}}"><span>Team Full Leave Calendar</span></a>
                        </li> 
                        @endif
                        
                        {{-- @if (auth('web')->user()->hasPermissionTo('team-certificate'))
                        <li>
                            <a href="{{route('certificate')}}"><span>Team Certificate</span></a>
                        </li>  
                        @endif --}}
                        <li>
                            <a href="{{route('team.list')}}"><span> My Team </span></a>
                        </li> 
                        @if (auth('web')->user()->hasPermissionTo('team-certificate'))
                        <li>
                            <a href="{{route('myCertificate')}}"><span>Team Certificate</span></a>
                            {{-- <a href="{{route('certificate')}}"><span>Team Certificate</span></a> --}}
                        </li>  
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('hr-team-certificate'))
                        <li>
                            <a href="{{route('certificate')}}">
                                <span>Team Certificates(hr)</span></a>
                        </li> 
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('hr-goal-overview'))
                        <li>
                            <a href="{{route('hrgoaloverview')}}"><span>Team Goals Overview</span></a>
                        </li>  
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('manager-goal-overview'))
                        <li>
                            <a href="{{route('goalorderview')}}">Team Goal Overview</a>
                        </li>  
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('manager-disciplinary'))
                        <li>
                            <a href="{{route('disciplinary')}}">My Team Disciplinary</a>
                        </li>  
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('hr-disciplinary'))
                        <li>
                            <a href="{{route('disciplinary')}}">My Team Disciplinary</a>
                        </li>  
                        @endif
                        @if (auth('web')->user()->hasPermissionTo('manager-leave-report'))
                        <li>
                            <a href="{{route('employee-leave-history')}}">
                                <span>Team Leave Report</span>
                            </a>
                        </li> 
                        @endif
                        {{-- <li>
                            <a href="{{route('team.list')}}"><span> My Team </span></a>
                        </li>  --}}

                    </ul>
                </div>
            </li> 

           

            @if (auth('web')->user()->hasPermissionTo('my-resources'))
            <li>
                <a href="{{route('resources')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span> My Resources </span>
                </a>
            </li>
            @endif

            {{-- <li>
                <a href="{{route('userleave')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Leave</span>
                </a>
            </li> 

            <li>
                <a href="{{route('my_leave')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Leave Calendar</span>
                </a>
            </li>  --}}

            @if (auth('web')->user()->hasPermissionTo('leave-calendar'))
            <li>
                <a href="{{route('calendar')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Team Leave Calendar</span>
                </a>
            </li> 
            @endif 

            {{-- @if (auth('web')->user()->hasPermissionTo('performance'))
            <li>
                <a href="{{route('user.appraisal')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>My Performance </span>
                </a>
            </li>
            @endif --}}
            
      
            {{-- @if (auth('web')->user()->hasPermissionTo('team-performance'))
            <li>
                <a href="{{route('user.appraisal.index')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Team Performance</span>
                </a>
            </li>
            @endif --}}

            @if (auth('web')->user()->hasPermissionTo('department'))
            <li>
                <a href="{{route('department')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Department</span>
                    </a>
            </li> 
            @endif
            @if (auth('web')->user()->hasPermissionTo('employee'))
            <li>
                <a href="{{route('employee')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Employee</span>
                    </a>
            </li>
             @endif
             @if (auth('web')->user()->hasPermissionTo('role'))
             <li>
                 <a href="{{route('roles')}}">
                     <i class="mdi mdi-account-multiple-plus-outline"></i>
                     <span>Access Management</span>
                     </a>
             </li> 
            @endif

       
            @if (auth('web')->user()->hasPermissionTo('wages-and-benefits'))
            <li>
                <a href="{{route('wagesbenefits')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Employee Wages And Benefits</span>
                </a>
            </li> 
            @endif 
            
      
            @if (auth('web')->user()->hasPermissionTo('hr-goal-review'))
            <li>
                <a href="{{route('hr-goal-review')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Goal Review</span>
                </a>
            </li>  
            @endif 


            @if (auth('web')->user()->hasPermissionTo('talent-search'))
            <li>
                <a href="{{route('talent_search')}}">
                    <i class="mdi mdi-account-multiple-plus-outline"></i>
                    <span>Talent Search</span>
                </a>
            </li> 
            @endif
            
          

        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>