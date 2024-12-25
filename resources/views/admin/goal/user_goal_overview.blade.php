
@extends('admin.layouts.app')

@section('content')


    <div class="container-fluid p-0">

        {{-- @php echo "<pre>";print_r($users->toArray());die; @endphp --}}

        <div class="card">
            <div class="card-body"> 
                <div class="row">
                    <div class="col-12 my-1">
                      <form id="formSubmit" action="{{ route('admin.usergoaloverview') }}" class="row">
                        <div class="col-sm-3">
                        <select class="form-select" name="department" >
                        <option value="">Filter Department</option>
                        @foreach($departments as $department)
                        @php
                        if(isset($_GET['department'])){
                            $departmentId = $_GET['department'];
                        }else{
                            $departmentId = '';
                        }
                        @endphp
                     <option @if($departmentId == $department->id) Selected @endif  value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
            </select>
                    </div>
                        @php
                        if(isset($_GET['username'])){
                            $userid = $_GET['username'];
                        }else{
                            $userid = '';
                        }
                        @endphp
                    <div class="col-sm-3 py-sm-0 py-2">
                        <input type="text" class="form-control" id="search-username" name="username" value="{{ $userid }}" placeholder="Search by Username" >
                    </div>
                    @php
                    if(isset($_GET['reviewcycle'])){
                        $reviewcycleID = $_GET['reviewcycle'];
                    }else{
                        $reviewcycleID = '';
                    }
                    @endphp
                    <div class="col-3 text-sm-end text-start mt-sm-0 mt-2">
                        <select class="form-select" name="reviewcycle" >
                            <option value="">Review Cycle</option>
                            @foreach($reviewCycles as $reviewCycle)
                                <option  @if($reviewcycleID == $reviewCycle->id) Selected @endif
                                     value="{{ $reviewCycle->id }}">{{ $reviewCycle->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 text-end">
                        <button class="btn btn-primary" type="submit">Save
                            <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
                        </button>
                    </div>
                    </form>
                   </div>
              </div>
            </div>
        </div>
     

    <div class="" id="goal-overview-container" value="">
        <div class="card" id="goal-review">
            <div class="col-12 p-2">
                @foreach ($users as $user)
                    <div class="border">
                        <div class="empname p-2">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" class="rounded-circle" alt="image"
                                width="25" height="25">
                            {{ $user->name }}
                        </div>

                        <div class="row p-2">
                            <div class="col-lg-4 col-6">
                                <canvas id="pieChart{{ $user->id }}"></canvas>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="row d-flex align-items-center">
                                    <div class="col-sm-4"> {{ $user->totalOfKey }} <br>
                                        Goals </div>
                                    <div class="col-sm-4"> <br>
                                        Due This Week </div>
                                    <div class="col-sm-4"> <br>
                                        Overdue
                                    </div>

                                    <div class="progress p-0" style="height: 21px">
                                        <div class="progress-bar" role="progressbar"
                                            aria-valuenow="{{ $user->totalProgress }}" aria-valuemin="0"
                                            style="width:{{ $user->totalProgress }}%">
                                            {{ $user->totalProgress }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                @foreach ($user->keyResults as $recentKey)
                                <div class="goal-item">
                                    <div class="d-sm-flex justify-content-between align-items-center gap-3 mt-sm-0 mt-3">
                                        <div class="w-50">
                                            <span class="badge"
                                                style="background-color:{{ $recentKey->goal->goalStatus->background_color }}">{{ $recentKey->goal->goalStatus->title }}</span>
                                            <strong>{{ $recentKey->goal->title }}</strong>
                                            <p class="mb-1">Due on {{ $recentKey->goal->deadline }} </p>
                                        </div>
                                        <div class="progress-bar-container w-50">
                                            <span>{{ $recentKey->current }}%</span>
                                            <div class="progress p-0 m-0">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $recentKey->current }}%;" aria-valuenow=""
                                                    aria-valuemin="0" aria-valuemax="{{ $recentKey->target }}"></div>
                                            </div>
                                            <span>Target: {{ $recentKey->current }}/{{ $recentKey->target }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    </div>
@endsection
@section('page-js-script')
<script>
   $(document).ready(function() {
            var users = @json($users);
            users.forEach(user => {
                const GoalTitle = user.goalpailabel;
                const Goalcolor = user.paibackgroundcolor;
                const percent = Object.values(user.goalpie);
                // console.log(percent);
                
                if (GoalTitle.length !== Goalcolor.length || GoalTitle.length !== percent.length) {
                    console.error('Data length mismatch:', {
                        GoalTitle: GoalTitle,
                        Goalcolor: Goalcolor,
                        percent: percent
                    });
                    return;
                }
                
                const canvasId = 'pieChart' + user.id;
                const ctx = document.getElementById(canvasId).getContext('2d');


                if (user.goal_overview && GoalTitle.length > 0) {
                    const pieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: GoalTitle,
                            datasets: [{
                                data: percent,
                                backgroundColor: Goalcolor,
                            }],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'right',
                                },
                                datalabels: {
                                    formatter: (value, context) => {
                                        return value + '%';
                                    },
                                    color: '#fff',
                                    labels: {
                                        title: {
                                            font: {
                                                weight: 'bold'
                                            }
                                        },
                                    },
                                },
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                }
            });
        });

    
</script>
@endsection