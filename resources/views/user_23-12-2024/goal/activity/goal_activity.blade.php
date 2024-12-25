<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">Activities</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="card-body px-sm-3 px-0" style="background: #f7f7f7;">
   <div class="timeline">
    {{-- @php echo "<pre>";print_r($activities->toArray());die; @endphp --}}
@php
    $lastPrintedDate = null; 
@endphp
            @foreach ($activities as $activity)
                <article class="timeline-item">
                    <div class="time-show">
                            @php
                            $activityDate = \Carbon\Carbon::parse($activity->date);
                            $today = \Carbon\Carbon::today();
                            $yesterday = \Carbon\Carbon::yesterday();
                    
                            if ($activityDate->isToday()) {
                                $formattedDate = "Today";
                            } elseif ($activityDate->isYesterday()) {
                                $formattedDate = "Yesterday";
                            } else {
                                $formattedDate = $activityDate->format('d M Y');
                            }
                        @endphp
                        
                    @if ($formattedDate !== $lastPrintedDate)
                        <a href="#" class="btn btn-primary width-lg">{{ $formattedDate }}</a>
                    @php
                        $lastPrintedDate = $formattedDate;
                    @endphp
                @endif
                    </div>
                </article>
                
               
                <article class="timeline-item {{ $loop->index % 2 == 0 ? 'alt' : '' }}">
                    
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="panel-body @if($loop->index % 2 == 0) text-end @endif">
                                <span class="arrow-alt"></span>
                                    @if ($activity->is_admin == 1)
                                        <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-image"
                                            class="img-fluid avatar-xs rounded">
                                        <small>{{ $activity->admin->name }}&nbsp; {{ $activity->title }}</small>
                                    @elseif($activity->is_admin == 0)
                                        <img src="{{ !empty($activity->user->file_id) ? asset('upload/employee/' . $activity->user->Image->file) : asset('assets/images/users/user-1.jpg') }}"
                                            alt="user-img" title="Mat Helme" class="img-fluid avatar-xs rounded">
                                        <small> {{ $activity->user->name }}&nbsp; {{ $activity->title }}</small>
                                    @endif

                                @php
                                  $updatedTime = \Carbon\Carbon::parse($activity->updated_at); 
                                  $relativeTime = $updatedTime->diffForHumans(); 
                                   $formattedTime = $updatedTime->format('h:i a'); 

                                //    echo "<pre>";print_r($formattedTime);die;
                                @endphp
                                <p class="text-muted">
                                    <small>{{ $relativeTime }} ({{ $formattedTime }})</small>
                                </p>
                        
                            @foreach ($activity->activityLog as $activitylog)
                                    <div>
                                          <span class="timeline-icon {{ $activitylog->data_key == 'Key result' ? 'bg-success' : 'bg-danger' }} ">
                                        <i class="mdi mdi-circle"></i>
                                        </span>
                                        <span class="{{ $activitylog->data_key == 'Key result' ? 'text-success' : 'text-danger' }} mt-0">
                                           <small> {{ $activitylog->data_key }} :</small>
                                        </span>
                                        <span><small>{{ $activitylog->data_value }}</small></span>
                                        
                                        @if ($activitylog->data_key != 'Key result')
                                        <span>
                                            <del><small>{{ $activitylog->old_vaue }}</small></del>
                                        </span>
                                        @endif
                                    </div>
                               
                                    @endforeach
                            
                                </div>
                            </div>
                        </div>
                    </article>
            @endforeach
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
</div>
