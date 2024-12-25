@php
$admin =  App\Models\Admin::with('logoimage','prfileImage')->find(1);
@endphp
<style>
    .custom-badge {
    display: inline-block;
    background-color: #e2f5e9;
    color: #212529; 
    font-size: 16px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 15px;
    margin-right: 5px; 
    text-align: center;
    margin-top: 19px;
}
.invalid-badge {
    display: inline-block;
    background-color: #dc3545; /* Danger red */
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 15px;
    margin: 5px;
    text-align: center;
}
</style>
<header>
    <div class="navbar-custom">
    <div class="topbar d-flex align-items-center">
       <nav class="navbar navbar-expand">
          <div class="mobile-toggle-menu"><i class="bx bx-menu"></i>
          </div>
          <div class="search-bar flex-grow-1">
             <div class="position-relative search-bar-box">
                <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class="bx bx-search"></i></span>
                <span class="position-absolute top-50 search-close translate-middle-y"><i class="bx bx-x"></i></span>
             </div>
          </div>
          <div class="top-menu ms-auto">
             <ul class="navbar-nav align-items-center">
                <li>
                    @php 
                         $rolesArr = App\Models\Session::where('id' ,session('sessionId'))->get();
                           $roles = '';
                           $currentYear = date('Y');
               
                             foreach ($rolesArr as $role) {
                              
                                       $roles .= '<span class="custom-badge" style="">
                                                  Year ' . $role->start_year . ' - ' . $role->end_year . '
                                               </span>';
                             }
                           echo $roles;
               
                            @endphp
                       </li>       
       
                       <li class="dropdown d-inline-block d-lg-none">
                           <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                               href="#" role="button" aria-haspopup="false" aria-expanded="false">
                               <i class="fe-search noti-icon"></i>
                           </a>
                           <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                               <form class="p-3">
                                   <input type="text" class="form-control" placeholder="Search ..."
                                       aria-label="Recipient's username">
                               </form>
                           </div>
                       </li>
       
                        
                <li class="nav-item mobile-search-icon">
                   <a class="nav-link" href="#">   <i class="bx bx-search"></i>
                   </a>
                </li>
               
                <li class="nav-item dropdown dropdown-large">
                   <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
                   <i class="bx bx-bell"></i>
                   </a>
                   <div class="dropdown-menu dropdown-menu-end">
                      <a href="javascript:;">
                         <div class="msg-header">
                            <p class="msg-header-title">Notifications</p>
                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                         </div>
                      </a>
                      <div class="header-notifications-list ps">
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">5 new user registered</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">You have recived new orders</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">The pdf files generated</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">5.1 min avarage time response</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
                                  <p class="msg-info">Your new product has approved</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">New customer comments recived</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-success text-success"><i class="bx bx-check-square"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">Successfully shipped your item</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-primary text-primary"><i class="bx bx-user-pin"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">24 new authors joined last week</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="notify bg-light-warning text-warning"><i class="bx bx-door-open"></i>
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">45% less alerts last 4 weeks</p>
                               </div>
                            </div>
                         </a>
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
                <li class="nav-item dropdown dropdown-large">
                   <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                   <i class="bx bx-comment"></i>
                   </a>
                   <div class="dropdown-menu dropdown-menu-end">
                      <a href="javascript:;">
                         <div class="msg-header">
                            <p class="msg-header-title">Messages</p>
                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                         </div>
                      </a>
                      <div class="header-message-list ps">
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">The standard chunk of lorem</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
                                     sec ago</span>
                                  </h6>
                                  <p class="msg-info">Many desktop publishing packages</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-3.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">Various versions have evolved over</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
                                     min ago</span>
                                  </h6>
                                  <p class="msg-info">Making this the first true generator</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-5.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">Duis aute irure dolor in reprehenderit</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-6.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">The passage is attributed to an unknown</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-7.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">The point of using Lorem</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">It was popularised in the 1960s</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-9.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">Various versions have evolved over</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-10.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">If you are going to use a passage</p>
                               </div>
                            </div>
                         </a>
                         <a class="dropdown-item" href="javascript:;">
                            <div class="d-flex align-items-center">
                               <div class="user-online">
                                  <img src="assets/images/avatars/avatar-11.png" class="msg-avatar" alt="user avatar">
                               </div>
                               <div class="flex-grow-1">
                                  <h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
                                     ago</span>
                                  </h6>
                                  <p class="msg-info">All the Lorem Ipsum generators</p>
                               </div>
                            </div>
                         </a>
                         <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                         </div>
                         <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                         </div>
                      </div>
                      <a href="javascript:;">
                         <div class="text-center msg-footer">View All Messages</div>
                      </a>
                   </div>
                </li>
             </ul>
          </div>
          <div class="user-box dropdown">
             <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
                <div class="user-info ps-3">
                   <p class="user-name mb-0">Pauline Seitz</p>
                   <p class="designattion mb-0">Web Designer</p>
                </div>
             </a>
             <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-home-circle"></i><span>Dashboard</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-dollar-circle"></i><span>Earnings</span></a>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-download"></i><span>Downloads</span></a>
                </li>
                <li>
                   <div class="dropdown-divider mb-0"></div>
                </li>
                <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                </li>
             </ul>
          </div>
       </nav>
    </div>
 </header>


            <ul class="list-unstyled topnav-menu float-end mb-0">
            <li>
             @php 
                  $rolesArr = App\Models\Session::where('id' ,session('sessionId'))->get();
                    $roles = '';
                    $currentYear = date('Y');
        
                      foreach ($rolesArr as $role) {
                       
                                $roles .= '<span class="custom-badge" style="">
                                           Year ' . $role->start_year . ' - ' . $role->end_year . '
                                        </span>';
                      }
                    echo $roles;
        
                     @endphp
                </li>       

                <li class="dropdown d-inline-block d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-search noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                        <form class="p-3">
                            <input type="text" class="form-control" placeholder="Search ..."
                                aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                 

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                        href="{{route('admin.dashboard')}}" role="button" aria-haspopup="false" aria-expanded="false">
                        @if($admin->logo)
                        <img src="{{asset('uploads/employee/'.$admin->prfileImage->file)}}" alt="user-image" class="rounded-circle">
                        @else
                        <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                        @endif
                            {{ Auth::guard('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        {{-- <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div> --}}

                        <!-- item-->
                        <a href="{{route('admin.profile.edit')}}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Profile Setting</span>
                        </a>

                        <!-- item-->
                        {{-- <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                            <i class="fe-lock"></i>
                            <span>Lock Screen</span>
                        </a> --}}

                        <div class="dropdown-divider"></div>

                        <form id="myForm" method="POST">
                            @csrf
                            <a id="submitButton" href="auth-logout.html" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </form>


                    </div>
                </li>

                

            </ul>
            <!-- LOGO -->
            <div class="logo-box">
                @if(@$nav == 'calender')
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    @if($admin->logo)
                    <span class="logo-lg mt-3">
                        <img src="{{asset('uploads/employee/'.$admin->logoimage->file)}}" alt="" height="" width="130px">
                    </span>
                    @else
                    <span class="logo-lg mt-3">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="16">
                    </span>
                    @endif
                   
                </a>
                @else
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    @if($admin->logo)
                    <span class="logo-lg mt-3">
                        <img src="{{asset('uploads/employee/'.$admin->logoimage->file)}}" alt=""height="" width="130px">
                    </span>
                    @else
                    <span class="logo-lg mt-3">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="16">
                    </span>
                    @endif
                </a>
                @endif
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect btn_second " id="menu-toggle">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">{{$title}}</h4>
                </li>

            </ul>

            <div class="clearfix"></div>

        </div>