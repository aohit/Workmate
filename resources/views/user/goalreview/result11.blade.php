@extends('user.layouts.app')
@section('content')
<style>
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
</style>
<div class="container-fluid p-2">
    <div class="card">
        <div class="card-body ">
             <form action="{{route('goalresult.pdf')}}" method="post" id="pdfdown">
            @csrf
            <input type="hidden" name="id" value="{{$goalresults->id}}">
            <input type="hidden" class="empperfom" name="empperfom" value="">
            <input type="hidden" class="managerperfom" name="managerperfom" value="">
            <input type="hidden" class="totalrating" name="totalrating" value="">
            </form>
            <form id="formSubmit">
                @csrf
                <div class="row">
                    <div>
                        <div class="row">
                            <div class="col-sm-6 text-center text-sm-start">
                                <h4>Goal Review Result</h4> 
                            </div>
                            <div class="col-sm-6 text-sm-end text-center">
                            
                                 <button type="submit"  class="btn btn-outline-secondary btn-sm" form="pdfdown">Download PDF <i class="fa fa-download" aria-hidden="true"></i></button>
                                
                                    {{-- <a class="btn btn-outline-secondary btn-sm" href="{{ route('appraisal.pdf',encrypt($questionnaires->id))}}" class="btn">Download Pdf <i class="fa fa-download" aria-hidden="true"></i></a> --}}
                            </div>
 
                        </div>
                    </div>

                    {{-- @php echo "<pre>";print_r($goalresults->user->file_id);die; @endphp --}}
                    <div class="col-sm-6 p-3">
                        <div class="row">
                            <div class="col-sm-3 text-center text-sm-start">
                             {{-- <img src="{{ !empty(Auth::guard('web')->user()->file_id) ? asset('upload/employee/'.Auth::guard('web')->user()->Image->file) : asset('assets/images/users/user-8.jpg') }}" style="width: 80px" class="profile-img" alt=""> --}}
                             <?php
                             if(isset($goalresults->User->Profile->file)){
                                 $image_url = url('/upload/employee/' . $goalresults->User->Profile->file);
                             }else{
                                 $image_url = url('upload/employee/demo.jpg');
                             }
                             ?>
                             <img src="{{ $image_url }}" class="img-thumbnail profile-img" style="height: 105px; width: 160px;">
                            </div>
                            <div class="col-sm-9 text-center text-sm-start">
                                <p class="m-0">Name :<span> {{ $goalresults->User->name}}</span> </p>
                                <span> Manager Name:</span> <span> {{ $goalresults->User->Manager->name}}</span><br>
                                <span> Review cycle :</span> {{ $goalresults->reviewcycle->title }}  (<span>from {{$goalresults->reviewcycle->start_date}} to {{ $goalresults->reviewcycle->end_date }}  </span>)
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 p-3 border-start">
                        <p> <b>Result  {{ ($goalresults->results_shared == 0) ? 'Not':'' }} have been shared with {{ $goalresults->User->name}}</b> <br>
                            Selt-review submitted on date {{$goalresults->self_review_submitted}}. <br>
                            Manager review submited on date {{$goalresults->manager_review_submitted}}.</p>
                    </div> 
                    <hr>
                    {{-- @php echo "<pre>";print_r($questionnaires->GoalReviewStore);die; @endphp --}}
                    {{-- @if (!empty($questionnaires?->GoalReviewStore)) --}}
                    <div class="d-flex justify-content-center pb-2">
                        <div>
                            {{-- @php echo "<pre>";print_r($questionnaires->toArray()); @endphp --}}
                            <div class="table-container table-responsive">
                                @if(!empty($questionnaires->GoalReviewStore))
                                <table class="table table-borderless ">
                                    <thead >
                                        <tr>
                                            <th></th>
                                            <th>Self</th>
                                            <th>Manager</th>
                                            <th><span class="badge bg-warning text-dark p-1"> Gap </span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questionnaires->Goals as $goals)
                                        <tr>
                                            <th>{{ $goals->title }}</th>
                                           
                                            @foreach($questionnaires->GoalReviewStore as $goalRating)
                                                @if ($goalRating->goal_id == $goals->id) 
                                                    <td><span>{{ $goalRating->que_self_rating ?? 0 }}</span></td>
                                                    <td><span>{{ $goalRating->que_manager_rating ?? 0 }}</span></td>
                
                                                    <td><span>{{ $goalRating->total_gaps ?? 0 }}</span></td>
                                                @endif
                                            @endforeach
                                         </tr>
                                        @endforeach
                                        <tr>
                                            <th>Total</th>
                                            <td><span>{{ $questionnaires->total_self_rating  }}</span></td>
                                            <td><span>{{ $questionnaires->total_manager_rating }}</span></td>
                                            <td><span>{{ $questionnaires->total_gap }}</span></td>
                                         </tr>
                                      
                                        <tr>
                                            <th >Manager Final Average Rating</th>
                                            <th>{{ number_format($questionnaires->manager_average_rating,2) }} Out of {{ $questionnaires->total_rating_number ?? 0 }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>

                    </div>
                    {{-- @endif --}}
                    <hr>
                    <div class="companyvalues mb-2">
                        <h3>Company Values</h3>
                        <ul>
                            <li><b>Accountability </b>- Assume responsibility for actions, products, decisions and policies.</li>
                            <li><b>Commitment </b> -Commit to deliver great products and outstanding service.</li>
                            <li><b>Innovation </b>- Pursue new creative ideas that have the potential to change the world.</li>
                            <li><b>Integrity </b>-Act with honesty and honor without compromising the truth. Keep your word.</li>
                            <li><b>Ownership </b> -Take care of the company and customers as they were your own.</li>
                        </ul>
                        <span>See our company's values, vision and mission statement here: <a href="http://example.com/values">http://example.com/values</a></span>
                    </div>
                </div>
                <hr>
                 {{-- @php echo "<pre>";print_r($questionnaires->toArray());die; @endphp --}}
                <div class="section mb-3">
                
                @if($questionnaires->InputTypesData->slug == 'goal')
                <h5>Employee Goal</h5>    
                @foreach ($questionnaires->Goals as $usergoals)
                <input type="hidden" name="gaolreviewID" value="{{ $questionnaires->id }}">
                <input type="hidden" name="goalId[]" value="{{ $usergoals->id }}">
                <input type="hidden" name="managerid" value="{{ $questionnaires->user->manager->id }}">
                <input type="hidden" name="rating_id" value="{{ $questionnaires->rating_id }}">
                <input type="hidden" name="goal_input_type" value="goal">
            
                <div class="goal-title mx-2" style="font-weight: 500;">{{ ucfirst($usergoals->title) }}</div>
            
                <div class="d-flex my-3" style="align-items: baseline;">
                    <button type="button" class="btn btn-xs rounded-pill mx-2" 
                            style="background-color:{{ $usergoals->goalStatus->background_color }}; 
                                   color:{{ $usergoals->goalStatus->label_color }}">
                        {{ $usergoals->goalStatus->title }}
                    </button>
                    <span class="mx-2">Due on {{ $usergoals->deadline }}</span>
                    <span class="mx-2">{{ $usergoals->goalCategory->title }}</span>
                    <span class="mx-2">{{ number_format($usergoals->totalprogressbar, 2, '. ', ',') }}</span>
                    <div class="progress mb-0 mx-2" style="width:150px">
                        <div class="progress-bar" role="progressbar" style="width:{{ $usergoals->totalprogressbar . '%' }}" 
                             aria-valuenow="{{ $usergoals->totalprogressbar }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $usergoals->totalprogressbar . '%' }}
                        </div>
                    </div>
                </div>
            
                <div class="section mb-3">
                    <input type="hidden" name="formQueID" id="formQueID" value="{{ $questionnaires->id }}">
                    <input type="hidden" name="appraisal_id" id="appraisal_id" value="{{ $questionnaires->id }}">
                    
                    <div class="mb-3 col-lg-12">
                        <h5>Ratings</h5>
                        <div class="readonly">
                           
                        {{-- @endphp --}}
                            
                            @foreach ($usergoals->GoalReviewStore as $review)
                                <div class="innearcontainer">
                                    <span class="name">{{ $questionnaires->User->name }} <span class="badge bg-secondary"> self</span></span>
                                    {{-- @php foreach ($goalresults->rating as $key => $value) {
                                        echo "<pre>";print_r($value);
                                    } die;@endphp --}}
                                    <p class="content">
                                        <span class="ratingEmp">{{ $review->que_self_rating }}</span> 
                                        {{ $review->que_employ_value }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-3 col-lg-12">
                        <div class="readonly">  
                            @php $gap = 0; @endphp
                            @foreach ($usergoals->GoalReviewStore as $review)
                                <div class="innearcontainer">
                                    <span class="name">{{ $questionnaires->User->Manager->name }} <span class="badge bg-secondary"> Manager</span></span>
                                    <p class="content">
                                        <span class="ratingManager">{{ $review->que_manager_rating }}</span>
                                        {{ $review->que_manager_value }}
                                    </p>
                                </div>
                                @php  $gap = $review->que_manager_rating - $review->que_self_rating ; @endphp
                            @endforeach
                        </div>
                    </div>
                    <div class="">
                        <div>
                          
                            {{-- @php echo $review->que_self_rating ;die; @endphp --}}
                            <span> <b> Gap </b> </span>  <span class=" badge bg-warning text-dark p-1 totalGap">{{ $gap }}</span>
                        </div>
                        
                    </div>
                
                    {{-- @php $gap = $questionnaires->que_manager_rating - $questionnaires->que_self_rating; @endphp --}}
            
                    @if($questionnaires->goalcomment_id == 1)
                        <div class="mb-3 col-lg-12">
                            <h5>Comments:(Optional)</h5>
                            <div class="readonly">
                                @foreach ($usergoals->GoalReviewStore as $review)
                                    <div class="innearcontainer">
                                        <span class="name">{{ $questionnaires->User->name }} <span class="badge bg-secondary"> self</span></span>
                                        <p class="content">{{ $review->goal_comments }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
            
                        <div class="mb-3 col-lg-12">
                            <div class="readonly">  
                                @foreach ($usergoals->GoalReviewStore as $review)
                                    <div class="innearcontainer">
                                        <span class="name">{{ $questionnaires->User->Manager->name }} <span class="badge bg-secondary"> Manager</span></span>
                                        <p class="content">{{ $review->manager_comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
         @endif
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('goalreview') }}" class="btn btn-light">Close</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page-js-script')
    <script>
        function shareResult(e)
        {
          var id =  $('#appraisal_id').val()
            url = "{{ route('user.appraisal.shareresult') }}";
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: 'post',
                url: url,
                data:{
                   'id':id,
                },
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                        $('#formSubmit').find('.st_loader').hide();
                        window.location.replace("{{ route('user.appraisal') }}");
                    } else {
                        toastr.error("Find some error", 'Error');
                        $('#formSubmit').find('.st_loader').hide();
                    }


                },
                error: function(xhr, status, error) {
                    $('#formSubmit').find('.st_loader').hide();
                    var $err = '';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $err = $err + value + "<br>";
                    })
                    toastr.error($err, 'Error');
                }
            });
        }

    
    </script>
@endsection
