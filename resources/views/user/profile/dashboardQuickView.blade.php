@foreach ($recentKeys as $recentKey)       
<div class="goal-item">
    <div class="d-flex justify-content-between align-items-center">
        <div class="w-50">
            <span class="badge" style="background-color:{{$recentKey->goal->goalStatus->background_color}}">{{ $recentKey->goal->goalStatus->title }}</span>
            <strong>{{ $recentKey->goal->title }}</strong>
            <p class="mb-1">Due on {{ $recentKey->goal->deadline }} </p>
        </div>
        @php
        $current  = $recentKey->current;
        $start = $recentKey->start;
        $target = $recentKey->target;
        $totalProgress = (($current - $start) / ($target - $start)) * 100;
        $totalpro = round($totalProgress);
            
        @endphp
        <div class="progress-bar-container">
            <span>{{ round(($totalpro ?? 0)) }}%</span>
            <div class="progress p-0 m-0">
                <div class="progress-bar bg-info" role="progressbar" style="width: {{$totalpro}}%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="{{$recentKey->target}}"></div>
            </div>
            <span>Target: {{ $recentKey->current }}/{{$recentKey->target}}</span>
        </div>
    </div>
</div>
@endforeach