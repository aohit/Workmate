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
                        <a href="{{route('admin.dashboard')}}" class="has-arrow">
                           <div class="parent-icon">
                           </div>
                           <div class="menu-title">Workforce Overview</div>
                        </a>
                     </li>
                    
                   
                     <li class="menu-label">Apps</li>
                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                           </div>
                           <div class="menu-title"> User Management</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.employee')}}"><i class="bx bx-right-arrow-alt"></i>Employees</a>
                           </li>
                           <li> <a href="{{route('admin.roles')}}"><i class="bx bx-right-arrow-alt"></i>Access Management</a>
                           </li>
                           <li> <a href="{{route('admin.department')}}"><i class="bx bx-right-arrow-alt"></i>Departments</a>
                           </li>
                           <li> <a href="{{route('admin.announcement')}}"><i class="bx bx-right-arrow-alt"></i>Announcements</a>
                           </li>
                           <li> <a href="{{route('admin.year-session')}}"><i class="bx bx-right-arrow-alt"></i>Session List</a>
                           </li>
                        
                        </ul>
                     </li>

                     <li>
                        <a href="javascript:;" class="has-arrow">
                           <div class="parent-icon"><i class="bx bx-cart"></i>
                           </div>
                           <div class="menu-title">Goals</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.goal')}}"><i class="bx bx-right-arrow-alt"></i>Goals</a>
                           </li>
                           <li> <a href="{{route('admin.goal-category')}}"><i class="bx bx-right-arrow-alt"></i>Goal Category</a>
                           </li>
                           <li> <a href="{{route('admin.goal-status')}}"><i class="bx bx-right-arrow-alt"></i>Goal Status</a>
                           </li>
                           <li> <a href="{{route('admin.goaloverview')}}"><i class="bx bx-right-arrow-alt"></i>Goals Overview</a>
                           </li>
                        </ul>
                     </li>

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                           </div>
                           <div class="menu-title">Performance</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.appraisal')}}"><i class="bx bx-right-arrow-alt"></i>Assign Questionnaire</a>
                           </li>
                           <li> <a href="{{route('admin.goalreview')}}"><i class="bx bx-right-arrow-alt"></i>Goal Review</a>
                           </li>
                           <li> <a href="{{route('admin.disciplinary')}}"><i class="bx bx-right-arrow-alt"></i>Disciplinary Actions</a>
                           </li>
                        </ul>
                     </li>
               

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                           </div>
                           <div class="menu-title">Leave</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.leave')}}"><i class="bx bx-right-arrow-alt"></i>Book Leave</a>
                           </li>
                           <li> <a href="{{route('admin.leavetype')}}"><i class="bx bx-right-arrow-alt"></i>Leave Type</a>
                           </li>
                           <li> <a href="{{route('admin.holiday')}}"><i class="bx bx-right-arrow-alt"></i>Public Holidays</a>
                           </li>
                           <li> <a href="{{route('admin.calendar.getleave')}}"><i class="bx bx-right-arrow-alt"></i>Full Leave Calendar</a>
                           </li>
                           <li> <a href="{{route('admin.calendar')}}"><i class="bx bx-right-arrow-alt"></i>Leave Calender</a>
                           </li>
                        </ul>
                     </li>

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                           </div>
                           <div class="menu-title">Setting  Parameters</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.questionnaire')}}"><i class="bx bx-right-arrow-alt"></i>Manage Questionnaires</a>
                           </li>
                           <li> <a href="{{route('admin.rating-scales')}}"><i class="bx bx-right-arrow-alt"></i>Rating Scales</a>
                           </li>
                           <li> <a href="{{route('admin.review-cycle')}}"><i class="bx bx-right-arrow-alt"></i>Review Cycle</a>
                           </li>
                           <li> <a href="{{route('admin.disciplinaryactiontype')}}"><i class="bx bx-right-arrow-alt"></i>Disciplinary Action Type</a>
                           </li>
                      </ul>
                     </li>

                     <li>
                        <a href="{{route('admin.talent_search')}}">
                           <div class="parent-icon"><i class="bx bx-user-circle"></i>
                           </div>
                           <div class="menu-title">Talent Search</div>
                        </a>
                     </li>

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-error"></i>
                           </div>
                           <div class="menu-title">Resources</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.resources')}}" ><i class="bx bx-right-arrow-alt"></i>Company Resources</a>
                           </li>
                           <li> <a href="{{route('admin.document-category')}}" ><i class="bx bx-right-arrow-alt"></i>Document Categories</a>
                           </li>
                           <li> <a href="{{route('admin.team.list')}}" ><i class="bx bx-right-arrow-alt"></i>Employee Directory</a>
                           </li>
                           <li> <a href="{{route('admin.emergencycontact')}}" ><i class="bx bx-right-arrow-alt"></i>Employee Emergency Contacts</a>
                           </li>
                           <li> <a href="{{route('admin.skills')}}" ><i class="bx bx-right-arrow-alt"></i>Employee Skills</a>
                           </li>
                           <li> <a href="{{route('admin.training')}}"><i class="bx bx-right-arrow-alt"></i>Employee Training</a>
                           </li>
                           <li> <a href="{{route('admin.certificate')}}" ><i class="bx bx-right-arrow-alt"></i>Employee Certificate</a>
                           </li>
                        </ul>
                     </li>

                     <li>
                        <a class="has-arrow" href="javascript:;">
                           <div class="parent-icon"><i class="bx bx-error"></i>
                           </div>
                           <div class="menu-title">Reports</div>
                        </a>
                        <ul class="mm-collapse">
                           <li> <a href="{{route('admin.wagesbenefits')}}" ><i class="bx bx-right-arrow-alt"></i>Employee Wages and Benefits </a>
                           </li>
                         
                        </ul>
                     </li>

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