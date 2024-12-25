 @extends('admin.layouts.app')

 @section('content')

 <style>
    .box-height{
        height: 80%; 
    }
    
    </style>
 <div class="content">

     <!-- Start Content-->
     <div class="container-fluid p-0">

         <div class="row">

            <div class="col-xl-4 col-md-6">
                <a href="{{route('admin.employee')}}" >
                <div class="card box-height">
                    <div class="card-body"> 
                        <h3 class="mt-0 mb-2 text-danger">Total Employee</h3> 
                        <div class="widget-chart-1"> 
                            <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                <h2 class="fw-normal pt-2 mb-1 text-danger display-1 font60"><b>{{count($employee)}}</b></h2> 
                                <ul class="list-inline chart-detail-list mb-0">
                                    <li>
                                        <h5 style="color: #ff8acc;"><i class="fa fa-circle me-1"></i>FY {{date('Y')}}</h5>
                                    </li>
                                    <li>
                                        <h5 style="color: #5b69bc;"><i class="fa fa-circle me-1"></i>FY {{date('Y',strtotime('+1 year'))}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
            {{-- <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex  justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Employee</p>
                                <h4 class="my-1 text-info">{{count($employee)}}</h4>
                                <p class="mb-0 font-13">+2.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                            </div>
                            <ul class="list-inline chart-detail-list mb-0">
                                <li>
                                    <h5 style="color: #ff8acc;"><i class="fa fa-circle me-1"></i>FY {{date('Y')}}</h5>
                                </li>
                                <li>
                                    <h5 style="color: #5b69bc;"><i class="fa fa-circle me-1"></i>FY {{date('Y',strtotime('+1 year'))}}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
           
            
            <div class="col-xl-4 col-md-6">
                <a href="{{route('admin.department')}}" >
                <div class="card box-height">
                    <div class="card-body"> 
                        <h3 class=" mt-0 mb-2 text-info">Department</h3> 
                        <div class="widget-chart-1"> 
                            <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                <h2 class="fw-normal pt-2 mb-1 text-info display-1 font60"><b>{{count($department)}}</b></h2> 
                                <ul class="list-inline chart-detail-list mb-0">
                                    <li>
                                        <h5 style="color: #ff8acc;"><i class="fa fa-circle me-1"></i>FY {{date('Y')}}</h5>
                                    </li>
                                    <li>
                                        <h5 style="color: #5b69bc;"><i class="fa fa-circle me-1"></i>FY {{date('Y',strtotime('+1 year'))}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
            
            

            <div class="col-xl-4 col-md-6">
                                 
                <div class="card box-height">
                    <div class="card-body"> 
                        <h3 class=" mt-0 mb-2 text-success">Total Vacant Positions</h3> 
                        <div class="widget-chart-1"> 
                            <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                <h2 class="fw-normal pt-2 mb-1 text-success display-1 font60"><b>12</b></h2> 
                                <ul class="list-inline chart-detail-list mb-0">
                                    <li>
                                        <h5 style="color: #ff8acc;"><i class="fa fa-circle me-1"></i>FY {{date('Y')}}</h5>
                                    </li>
                                    <li>
                                        <h5 style="color: #5b69bc;"><i class="fa fa-circle me-1"></i>FY {{date('Y',strtotime('+1 year'))}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
          
            </div>

            <div class="col-xl-4 col-md-6"> 
                <div class="card box-height">
                    <div class="card-body"> 
                        <h3 class=" mt-0 mb-2 text-warning">Average Tenure</h3> 
                        <div class="widget-chart-1"> 
                            <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                <h2 class="fw-normal pt-2 mb-1 text-warning display-1 font60"><b>6</b></h2> 
                                <ul class="list-inline chart-detail-list mb-0">
                                    <li>
                                        <h5 style="color: #ff8acc;"><i class="fa fa-circle me-1"></i>FY {{date('Y')}}</h5>
                                    </li>
                                    <li>
                                        <h5 style="color: #5b69bc;"><i class="fa fa-circle me-1"></i>FY {{date('Y',strtotime('+1 year'))}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
            <div class="col-xl-4 col-md-6">
                
                <div class="card box-height">
                    <div class="card-body"> 
                        <h3 class=" mt-0 mb-2 text-primary">Employee Cost</h3> 
                        <div class="widget-chart-1"> 
                            <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                <h2 class="fw-normal pt-2 mb-1 text-primary display-1 font60"><b>0</b></h2> 
                                <ul class="list-inline chart-detail-list mb-0">
                                    <li>
                                        <h5 style="color: #ff8acc;"><i class="fa fa-circle me-1"></i>FY {{date('Y')}}</h5>
                                    </li>
                                    <li>
                                        <h5 style="color: #5b69bc;"><i class="fa fa-circle me-1"></i>FY {{date('Y',strtotime('+1 year'))}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
             {{-- <div class="col-xl-3 col-md-6">
                 <div class="card box-height">
                     <div class="card-body">

                         <h4 class="header-title mt-0 mb-2">Employee</h4>

                         <div class="widget-chart-1">
                             <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                 <h2 class="fw-normal pt-2 mb-1 text-danger display-1 font60">{{count($employee)}}</h2>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-xl-3 col-md-6">
                 <div class="card box-height">
                     <div class="card-body">

                         <h4 class="header-title mt-0 mb-2">Department</h4>

                         <div class="widget-chart-1">
                             <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                 <h2 class="fw-normal pt-2 mb-1 text-danger display-1 font60">{{count($department)}}</h2>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div> --}}

         <!-- end row -->

     </div> <!-- container-fluid -->

 </div> <!-- content -->

 <!-- Footer Start -->
 @endsection

 @section('page-js-script')

 @endsection