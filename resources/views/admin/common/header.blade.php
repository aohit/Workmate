
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
         
          </div>
          <div class="top-menu ms-auto">
             <ul class="navbar-nav align-items-center">
               <li>
                  @php 
                       $rolesArr = App\Models\Session::where('id' ,session('sessionId'))->get();
                         $roles = '';
                         $currentYear = date('Y');
             
                           foreach ($rolesArr as $role) {
                            
                                     $roles .= '<span class="custom-badge  m-0" style="">
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
              
            
               
             </ul>
          </div>
          <div class="user-box dropdown">
             <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               @if($admin->logo)
               <img src="{{asset('uploads/employee/'.$admin->prfileImage->file)}}" alt="user-image" class="rounded-circle" height="30px" width="30px">
               @endif
                {{-- <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar"> --}}
                <div class="user-info ps-3">
                   <p class="user-name mb-0"> {{ Auth::guard('admin')->user()->name }} </p>
                   <p class="designattion mb-0"> {{ Auth::guard('admin')->user()->name }} </p>
                </div>
             </a>
             <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{route('admin.profile.edit')}}"><i class="bx bx-user"></i><span>Profile</span></a>
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