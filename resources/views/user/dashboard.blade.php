 
 @extends('user.layouts.app')

@section('content')
  
<style>
  .box-height{
        height: 80%; 
    }

</style>
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                         {{-- @if (auth('web')->user()->hasPermissionTo('work-force-overview'))
                       
                            <div class="col-xl-4 col-md-6">
                                <a href="{{route('employee')}}" >
                                <div class="card box-height">
                                    <div class="card-body"> 
                                        <h3 class="mt-0 mb-4 text-danger">Total Employee</h3> 
                                        <div class="widget-chart-1"> 
                                            <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                                <h2 class="fw-normal pt-2 mb-1 text-danger display-1"><b>{{count($employee)}}</b></h2> 
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
                                <a href="{{route('department')}}" >
                                <div class="card box-height">
                                    <div class="card-body"> 
                                        <h3 class=" mt-0 mb-4 text-info">Department</h3> 
                                        <div class="widget-chart-1"> 
                                           <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                                <h2 class="fw-normal pt-2 mb-1 text-info display-1"><b>{{count($department)}}</b></h2> 
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
                            @endif --}}
                            <div class="col-xl-4 col-md-6">
                                <a href="{{route('leave')}}" >
                                <div class="card box-height">
                                    <div class="card-body"> 
                                        <h3 class="mt-0 mb-4 text-success">Leave</h3> 
                                        <div class="widget-chart-1"> 
                                           <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                                <h2 class="fw-normal pt-2 mb-1 text-success display-1"><b>{{count($leave)}}</b></h2> 
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

                          {{--  @if (auth('web')->user()->hasPermissionTo('work-force-overview'))
                            <div class="col-xl-4 col-md-6">
                                 
                                <div class="card box-height">
                                    <div class="card-body"> 
                                        <h3 class=" mt-0 mb-4 text-warning">Total Vacant Positions</h3> 
                                        <div class="widget-chart-1"> 
                                           <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                                <h2 class="fw-normal pt-2 mb-1 text-warning display-1"><b>12</b></h2> 
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
                                        <h3 class=" mt-0 mb-4 text-primary">Average Tenure</h3> 
                                        <div class="widget-chart-1"> 
                                           <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                                <h2 class="fw-normal pt-2 mb-1 text-primary display-1"><b>6 Y</b></h2> 
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
                            <div class="col-xl-4 col-md-12">
                                
                                <div class="card box-height">
                                    <div class="card-body"> 
                                        <h3 class=" mt-0 mb-4 text-warning">Employee Cost</h3> 
                                        <div class="widget-chart-1"> 
                                           <div class="widget-detail-1 text-end d-flex justify-content-between align-items-center">
                                                <h2 class="fw-normal pt-2 mb-1 text-warning display-1"><b></b></h2> 
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
                       
                             @endif --}}
                        
                    
 
                    </div>
                    
                     
                    <!-- end row -->

                </div> <!-- container-fluid -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @endsection

@section('page-js-script')

@endsection