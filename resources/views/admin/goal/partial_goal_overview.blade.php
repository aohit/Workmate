<div class="container-fluid">
  
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
                        <div class="col-4">
                            <canvas id="pieChart{{ $user->id }}"></canvas>
                        </div>
                        <div class="col-4">
                            <div class="row d-flex align-items-center">
                                <div class="col-4"> {{ $user->totalOfKey }} <br>
                                    Goals </div>
                                <div class="col-4"> <br>
                                    Due This Week </div>
                                <div class="col-4"> <br>
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
                        <div class="col-4">
                            @foreach ($user->keyResults as $recentKey)
                            <div class="goal-item">
                                <div class="d-flex justify-content-between align-items-center gap-3">
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

{{-- @section('page-js-script') --}}
{{-- <script>
        $(document).ready(function() {
            var users = @json($users);
            users.forEach(user => {
                const GoalTitle = user.goalpailabel;
                const Goalcolor = user.paibackgroundcolor;
                const percent = Object.values(user.goalpie);
                
                // Ensure that GoalTitle, Goalcolor, and percent have matching lengths
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

</script> --}}
{{-- @endsection --}}