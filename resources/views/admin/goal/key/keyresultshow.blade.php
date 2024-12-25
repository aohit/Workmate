<input type="hidden" id="totalkeies" value="{{count($keyresults)}}">
@foreach ($keyresults as $keyresult)
<input type="hidden" class="keyprogress" value="{{$keyresult->total_progress}}">
    <div class="container border mt-4 p-2">
        <div class="milestone-container ">
            <div class="row d-flex">
                <div class="col icon">
                    <i class="fas fa-key"></i>
                   {{$keyresult->title}}
                </div>
                <div class="col  milestone-actions text-end">
                    @if ($keyresult->goal_id == null)
                    <span class="badge rounded-pill bg-warning text-dark px-1 me-2">
                        (Draft)
                    </span>
                  @endif
                    <span>
                        <a href="javascript:void(0)" onclick="editkey({{$keyresult->id}})"> <i class="fas fa-pencil-alt"></i> </a>
                    </span>
                    <span>
                        <a href="javascript:void(0)" onclick="deletekey({{$keyresult->id}})"> <i class="fas fa-trash"></i> </a>
                        
                    </span>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{number_format($keyresult->total_progress) }}%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="milestone-status m-1">
                <div class="row">
                    <div class="col">{{ $keyresult->traking }}</div>
                    <div class="col text-end">Complete - {{ number_format($keyresult->total_progress) }}%</div>
                </div>
            </div>
        </div>
    </div>
@endforeach
