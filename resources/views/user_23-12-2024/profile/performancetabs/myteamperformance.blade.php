<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4 class="breadcrumb-title"> My Team Performance Review</h4>
                    </div>
                    {{-- <div class="col-3">
                        @if (auth('web')->user()->hasPermissionTo('performance'))
                            <a href="{{ route('user.appraisal') }}">Go to My Performance</a>
                        @endif
                    </div> --}}
                </div>
                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="common_data" role="tabpanel">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-2 rounded-3 text-center py-1">
                                <div class="rounded-circle mx-auto pt-2" style="background-color:#4c08a5;height: 70px;width: 70px;">
                                    @php
                                        // $user = $tasks->count();
                                        $manager = $mantaks->count();
                                        // $pendingtask = $user + $manager;
                                    @endphp
                                    <h4 class="text-center text-white  m-0">{{ $manager }}</h4>
                                    <h5 class="text-center text-white  m-0">Pending</h5>
                                </div>
                            </div>
                            <div class="col-md-10 text-md-start text-center">
                                <p>
                                    You have tasks pending completion. Go to @if (auth('web')->user()->hasPermissionTo('performance'))
                                        <a href="{{ route('user.appraisal.index') }}"> My Team Performance </a>
                                    @endif to complete before the due date
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-9">
                        <h4 class="breadcrumb-title">Team Goals Review</h4>
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
                                <div class="rounded-circle mx-auto pt-2" style="background-color:#9761dd;height: 70px;width: 70px;">
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
                                        <a href="{{ route('goalreview.team.list') }}">My Team Goals Review</a>
                                    @endif to complete before the due date
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>