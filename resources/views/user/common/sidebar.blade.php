
@php
$admin =  App\Models\Admin::with('logoimage','prfileImage')->find(1);
@endphp
<div class="sidebar-wrapper" data-simplebar="init">
    
   <div class="simplebar-wrapper" style="margin: 0px;">
      <div class="simplebar-height-auto-observer-wrapper">
         <div class="simplebar-height-auto-observer"></div>
      </div>
      <div class="simplebar-mask">
         <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
            <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
               <div class="simplebar-content mm-active" style="padding: 0px;">
                  <div class="sidebar-header">
                     <div>
                        {{-- @if($admin->logo)
                        <img src="{{asset('uploads/employee/'.$admin->prfileImage->file)}}"  alt="user-img" title="Mat Helme"
                          class="rounded-circle img-thumbnail avatar-md logo-icon">
                      @else
                          <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                          class="rounded-circle img-thumbnail avatar-md logo-icon">
                      @endif --}}
                        {{-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> --}}
                     </div>
                     <div>
                        {{-- <h4 class="logo-text">Rocker</h4> --}}
                        @if($admin->logo)
                        <span class="logo-lg mt-3">
                            <img src="{{asset('uploads/employee/'.$admin->logoimage->file)}}" alt="" height="" width="130px">
                        </span>
                        @endif
                     </div>
                     <div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i>
                     </div>
                  </div>
                  <!--navigation-->
                  <ul class="metismenu mm-show" id="menu">
                     <li class="menu-label">Navigation</li>
                   
                     <li>
                        <a href="{{route('profile.edit')}}" class="has-arrow">
                           <div class="parent-icon">
                           </div>
                           <div class="menu-title">My Dashboard</div>
                        </a>
                     </li>
                    
                   
                     <li class="menu-label">Apps</li>
                     <li>
                        <a href="{{route('my_profile')}}" class="has-arrow">
                           <div class="parent-icon">    <i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">My Profile</div>
                        </a>
                     </li>

                     @if (auth('web')->user()->hasPermissionTo('goal'))
                     <li>
                        <a href="javascript:;" class="has-arrow">
                           <div class="parent-icon"><i class="bx bx-cart"></i>
                           </div>
                           <div class="menu-title">Goals</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('goal',['id' => base64_encode(Auth::guard('web')->user()->id)])}}"><i class="bx bx-right-arrow-alt"></i>Manage Goals</a>
                           </li>
                           @php
                           $users = App\Models\User::select('id','manager_id')->where('manager_id',Auth::guard('web')->user()->id)->count();
                       @endphp 
                           
                        </ul>
                     </li>
                     @endif 


                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                           </div>
                           <div class="menu-title">My Performance</div>
                        </a>
                        <ul class="mm-collapse">
                            @if (auth('web')->user()->hasPermissionTo('performance'))
                           <li> <a href="{{route('user.appraisal')}}"><i class="bx bx-right-arrow-alt"></i>Performance Questionnaires</a>
                           </li>
                           @endif
                           <li> <a href="{{route('goalreview')}}"><i class="bx bx-right-arrow-alt"></i>Goal Review</a>
                           </li>
                          
                        </ul>
                     </li>
               

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                           </div>
                           <div class="menu-title">My Leave</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('userleave')}}"><i class="bx bx-right-arrow-alt"></i>Book Leave</a>
                           </li>
                           <li> <a href="{{route('my_leave')}}"><i class="bx bx-right-arrow-alt"></i>Leave Calendar</a>
                           </li>
                        </ul>
                     </li>

                     <li>
                        <a href="{{route('user.myTraining')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">My Training</div>
                        </a>
                     </li>

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                           </div>
                           <div class="menu-title">My Team</div>
                        </a>
                        <ul class="mm-collapse">
                            @if (auth('web')->user()->hasPermissionTo('team-goal-review'))
                           <li> <a href="{{route('goalreview.team.list')}}"><i class="bx bx-right-arrow-alt"></i>Team Goals</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('team-performance'))
                           <li> <a href="{{route('user.appraisal.index')}}"><i class="bx bx-right-arrow-alt"></i>Team Performance</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('leave'))
                           <li> <a href="{{route('leave')}}"><i class="bx bx-right-arrow-alt"></i>Team Leave</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('training'))
                           <li> <a href="{{route('user.training')}}"><i class="bx bx-right-arrow-alt"></i>Team Traininge</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('team-leave-calendar'))
                           <li> <a href="{{route('calendar.getleave')}}"><i class="bx bx-right-arrow-alt"></i>Team Full Leave Calendar</a>
                           </li>
                           @endif 

                           @if (auth('web')->user()->hasPermissionTo('team-certificate'))
                           <li> <a href="{{route('myCertificate')}}"><i class="bx bx-right-arrow-alt"></i>My Team </a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('hr-team-certificate'))
                           <li> <a href="{{route('certificate')}}"><i class="bx bx-right-arrow-alt"></i>Team Certificates(hr)</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('hr-goal-overview'))
                           <li> <a href="{{route('hrgoaloverview')}}"><i class="bx bx-right-arrow-alt"></i>Team Goals Overview</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('manager-goal-overview'))
                           <li> <a href="{{route('goalorderview')}}"><i class="bx bx-right-arrow-alt"></i>Team Goal Overview</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('manager-disciplinary'))
                           <li> <a href="{{route('disciplinary')}}"><i class="bx bx-right-arrow-alt"></i>My Team Disciplinary</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('hr-disciplinary'))
                           <li> <a href="{{route('disciplinary')}}"><i class="bx bx-right-arrow-alt"></i>My Team Disciplinary</a>
                           </li>
                           @endif 
                           @if (auth('web')->user()->hasPermissionTo('manager-leave-report'))
                           <li> <a href="{{route('employee-leave-history')}}"><i class="bx bx-right-arrow-alt"></i>Team Leave Report</a>
                           </li>
                           @endif 
                      </ul>
                     </li>

                     @if (auth('web')->user()->hasPermissionTo('my-resources'))
                     <li>
                        <a href="{{route('resources')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title"> My Resources</div>
                        </a>
                     </li>
                     @endif

                     @if (auth('web')->user()->hasPermissionTo('leave-calendar'))
                     <li>
                        <a href="{{route('calendar')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Team Leave Calendar</div>
                        </a>
                     </li>
                     @endif
                     
                     @if (auth('web')->user()->hasPermissionTo('department'))
                     <li>
                        <a href="{{route('department')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Department</div>
                        </a>
                     </li>
                     @endif

                    @if (auth('web')->user()->hasPermissionTo('employee'))
                     <li>
                        <a href="{{route('employee')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Employee</div>
                        </a>
                     </li>
                     @endif

                    @if (auth('web')->user()->hasPermissionTo('role'))
                     <li>
                        <a href="{{route('roles')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Access Management</div>
                        </a>
                     </li>
                     @endif

                     @if (auth('web')->user()->hasPermissionTo('wages-and-benefits'))
                     <li>
                        <a href="{{route('wagesbenefits')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Employee Wages And Benefits</div>
                        </a>
                     </li>
                     @endif

                     @if (auth('web')->user()->hasPermissionTo('hr-goal-review'))
                     <li>
                        <a href="{{route('hr-goal-review')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Goal Review</div>
                        </a>
                     </li>
                     @endif

                     @if (auth('web')->user()->hasPermissionTo('talent-search'))
                     <li>
                        <a href="{{route('talent_search')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Talent Search</div>
                        </a>
                     </li>
                     @endif

                 
                  
                     {{-- <li>
                        <a href="user-profile.html">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">User Profile</div>
                        </a>
                     </li> --}}
                 
                   
                     
                  
                  </ul>
                  <!--end navigation-->
               </div>
            </div>
         </div>
      </div>
      <div class="simplebar-placeholder" style="width: auto; height: 1391px;"></div>
   </div>
  
   
</div>