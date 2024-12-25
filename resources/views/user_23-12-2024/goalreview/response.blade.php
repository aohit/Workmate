@extends('user.layouts.app')

@section('content')
    <div class="container-fluid p-2">
        <div class="card">
            <div class="card-body ">
                <form id="formSubmit" onsubmit="formSubmit(this);return false;">
                    @csrf
                    <div class="row">
                        {{-- <h4>Performance Appraisal: {{ $questionnaires->FormQue->title }}</h4> --}}
                        <div class="col-sm-6 p-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    {{-- <img src="{{ asset('assets/images/users/user-8.jpg') }}" style="width: 85px"
                                        class="rounded-circle" alt=""> --}}
                                        @php 
                                             if(isset($questionnaires->User->Profile->file) && $questionnaires->User->Profile->file != ''){
                                            $image_url = url('/upload/employee/' . $questionnaires->User->Profile->file);
                                        }else{
                                            $image_url = url('upload/employee/demo.jpg');
                                        }
                                        @endphp
                                        <img src="{{ $image_url }}" class="img-thumbnail profile-img" style="height: 105px; width: 160px;border-radius:50%">
                                </div>
                                <div class="col-sm-9">
                                    <p class="m-0">Name :<span> {{ $questionnaires->User->name }}</span> </p>
                                    <span> Manager Name:</span> <span> {{ @$questionnaires->User->Manager->name }}</span><br>
                                    <span> Review cycle :</span> {{ $questionnaires->reviewcycle->title }} (<span>from {{ $questionnaires->reviewcycle->start_date }} to
                                        {{ $questionnaires->reviewcycle->end_date }} </span>)
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 p-3 border-start">
                            <p>Please complete the questionnaire below and use the Submit
                                button to send your final responses. You can use the Save Draft
                                button to save the questionnaire in its current state and come
                                back later to complete it.</p>
                        </div>
                        <hr>
                        <div class="companyvalues mb-2">
                            <h3>Company Values</h3>
                            <ul>
                                <li><b>Accountability </b>- Assume responsibility for actions, products, decisions and
                                    policies.</li>
                                <li><b>Commitment </b> -Commit to deliver great products and outstanding service.</li>
                                <li><b>Innovation </b>- Pursue new creative ideas that have the potential to change the
                                    world.</li>
                                <li><b>Integrity </b>-Act with honesty and honor without compromising the truth. Keep your
                                    word.</li>
                                <li><b>Ownership </b> -Take care of the company and customers as they were your own.</li>
                            </ul>
                            <span>See our company's values, vision and mission statement here: <a
                                    href="http://example.com/values">http://example.com/values</a></span>
                        </div>
                    </div>
                    <hr>
                   
                    {{-- @php echo "<pre>";print_r($questionnaires->responsibility->toArray());die; @endphp --}}
                    <div class="section mb-3">
                    @if($questionnaires->InputTypesData->slug == 'goal')
                    <h5>Employee Goal</h5>    
                    @foreach ($questionnaires->Goals as $usergoals)
                        <input type="hidden" name="gaolreviewID" value="{{  $questionnaires->id }}">
                        <input type="hidden" name="goalId[]" value="{{ $usergoals->id }}">
                        <input type="hidden" name="managerid" value="{{ $questionnaires->user->manager->id }}">
                        <input type="hidden" name="rating_id" value="{{ $questionnaires->rating_id }}">
                        <input type="hidden" name="goal_input_type" value="goal">

                        <div class="goal-title mx-2" style="font-weight: 500;">{{ ucfirst($usergoals->title) }}</div>

                        <div class="d-flex my-3" style="align-items: baseline;">
                            <button type="button" class="btn btn-xs rounded-pill mx-2" style="background-color:{{ $usergoals->goalStatus->background_color }}; color:{{ $usergoals->goalStatus->label_color }}">{{ $usergoals->goalStatus->title }}</button>
                            
                            <span class="mx-2">Due on {{ $usergoals->deadline }}</span>
                            <span class="mx-2">{{ $usergoals->goalCategory->title }}</span>
                            <span class="mx-2">{{ number_format($usergoals->totalprogressbar, 2, '. ', ',') }}</span>
                            <div class="progress mb-0 mx-2" style="width:150px">
                                <div class="progress-bar" role="progressbar" style="width:{{ $usergoals->totalprogressbar . '%' }}" aria-valuenow="{{ $usergoals->totalprogressbar }}" aria-valuemin="0" aria-valuemax="100">{{ $usergoals->totalprogressbar . '%' }}</div>
                            </div>

                        </div>
                    
                        <div class="row justify-content-center ratingData parent my-3" id="ratingPreview">
                            @php $no = 1; @endphp
                    
                            @foreach ($questionnaires->rating->ratingScaleOption as $ratingoption)
                            <div class="col-auto text-center">
                                <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                <div class="rating d-flex justify-content-center">
                                    <label for="rating_{{ $usergoals->id }}_{{ $loop->iteration }}"
                                        class="border rounded-circle rating-circle"
                                        onclick="ratingColor(this,'ration{{ $no }}')">
                                        {!! $questionnaires->rating->display_type == 1 ? '<i class="mdi mdi-star fs-3"></i>' : $no !!}
                                    </label>
                                    <input type="radio"
                                        name="goals[{{ $usergoals->id }}][ratings]"
                                        class="opacity-0"
                                        id="rating_{{ $usergoals->id }}_{{ $loop->iteration }}"
                                        value="{{ $ratingoption->option_label }}">
                                </div>
                            </div>
                            <?php $no++; ?>
                            @endforeach

                         @if($questionnaires->goalcomment_id == 1)
                              <div class="mb-3 mt-2">
                                <label for="exampleFormControlTextarea1" class="form-label">Please explain your choice here (optional):</label>
                                <textarea class="form-control" name="comment[{{ $usergoals->id }}][comments]" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        @endif
                 </div>     
                        @endforeach  @php /*die;*/ @endphp

             @elseif($questionnaires->InputTypesData->slug == 'competency')
                 
                <h5>Employee Competency</h5>
                        @foreach ($questionnaires->Competency as $competencys)
                        <input type="hidden" name="gaolreviewID" value="{{  $questionnaires->id }}">
                        <input type="hidden" name="goalId[]" value="{{ $competencys->id }}">
                        <input type="hidden" name="managerid" value="{{ $questionnaires->user->manager->id }}">
                        <input type="hidden" name="rating_id" value="{{ $questionnaires->rating_id }}">
                        <input type="hidden" name="goal_input_type" value="competency">
                    
                        <div  class="mx-2" style="font-weight: 500;">{{ $competencys->title }}</div>
                        <div class="d-flex my-2" style="align-items: baseline;">
                            
                            {{-- <span class="mx-2">{{ $competencys->discription  }}</span> --}}
                            <span class="mx-2">{{ $competencys->total_progress .'%' }}</span>
                            
                            <div class="progress mb-0 mx-2" style="width:150px">
                                <div class="progress-bar" role="progressbar" style="width:{{ $competencys->total_progress . '%' }}" aria-valuenow="{{ $competencys->total_progress }}" aria-valuemin="0" aria-valuemax="100">{{ $competencys->total_progress . '%' }}</div>
                            </div>
                        </div>
                    
                        <div class="row justify-content-center ratingData parent my-2" id="ratingPreview">
                            @php $no = 1; @endphp
                    
                            @foreach ($questionnaires->rating->ratingScaleOption as $ratingoption)
                            <div class="col-auto text-center">
                                <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                <div class="rating d-flex justify-content-center">
                                    <label for="rating_{{ $competencys->id }}_{{ $loop->iteration }}"
                                        class="border rounded-circle rating-circle"
                                        onclick="ratingColor(this,'ration{{ $no }}')">
                                        {!! $questionnaires->rating->display_type == 1 ? '<i class="mdi mdi-star fs-3"></i>' : $no !!}
                                    </label>
                                    <input type="radio"
                                        name="goals[{{ $competencys->id }}][ratings]"
                                        class="opacity-0"
                                        id="rating_{{ $competencys->id }}_{{ $loop->iteration }}"
                                        value="{{ $ratingoption->option_label }}">
                                </div>
                            </div>
                            <?php $no++; ?>
                            @endforeach
                            @if($questionnaires->goalcomment_id == 1)
                            <div class="mb-3 mt-2">
                                <label for="exampleFormControlTextarea1" class="form-label">Please explain your choice here (optional):</label>
                                <textarea class="form-control" name="comment[{{ $competencys->id }}][comments]" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            @endif
                        </div>     
                        @endforeach @php  @endphp



                     @elseif($questionnaires->InputTypesData->slug == 'responsibility')
                    {{-- @php echo "<pre>";print_r($questionnaires->responsibility->toArray());die; @endphp --}}
                     <h5>Employee Responsibility</h5>
                     @foreach ($questionnaires->responsibility as $responsibility)

                                <input type="hidden" name="gaolreviewID" value="{{  $questionnaires->id }}">
                                <input type="hidden" name="goalId[]" value="{{ $responsibility->id }}">
                                <input type="hidden" name="managerid" value="{{ $questionnaires->user->manager->id }}">
                                <input type="hidden" name="rating_id" value="{{ $questionnaires->rating_id }}">
                                <input type="hidden" name="goal_input_type" value="responsibility">
                            
                                <div class="mx-2" style="font-weight: 500;">{{ $responsibility->title }}</div>
                                <div class="d-flex my-2" style="align-items: baseline;">
                                    
                                    <span class="mx-2">{{ $responsibility->discription  }}</span>
                                    <span class="mx-2">{{ number_format($responsibility->total_progress,2,'.','') .'%' }}</span>
                                    
                                    <div class="progress mb-0 mx-2" style="width:150px">
                                        <div class="progress-bar" role="progressbar" style="width:{{ $responsibility->total_progress . '%' }}" aria-valuenow="{{ $responsibility->total_progress }}" aria-valuemin="0" aria-valuemax="100">{{ $responsibility->total_progress . '%' }}</div>
                                    </div>
                                </div>
                            
                                <div class="row justify-content-center ratingData parent my-2" id="ratingPreview">
                                    @php $no = 1; @endphp
                            
                                    @foreach ($questionnaires->rating->ratingScaleOption as $ratingoption)
                                    <div class="col-auto text-center">
                                        <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                        <div class="rating d-flex justify-content-center">
                                            <label for="rating_{{ $responsibility->id }}_{{ $loop->iteration }}"
                                                class="border rounded-circle rating-circle"
                                                onclick="ratingColor(this,'ration{{ $no }}')">
                                                {!! $questionnaires->rating->display_type == 1 ? '<i class="mdi mdi-star fs-3"></i>' : $no !!}
                                            </label>
                                            <input type="radio"
                                                name="goals[{{ $responsibility->id }}][ratings]"
                                                class="opacity-0"
                                                id="rating_{{ $responsibility->id }}_{{ $loop->iteration }}"
                                                value="{{ $ratingoption->option_label }}">
                                        </div>
                                        
                                    </div>
                                    <?php $no++; ?>
                                    @endforeach

                                    @if($questionnaires->goalcomment_id == 1)
                                            <div class="mb-3 col-lg-12">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                                                    <textarea class="form-control" name="comment[{{ $responsibility->id }}][comments]" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                         @endif
        
                                    {{-- <div class="mb-3 mt-2">
                                        <label for="exampleFormControlTextarea1" class="form-label">
                                            Please explain your choice here (optional):</label>
                                        <textarea class="form-control" name="comment[{{ $responsibility->id }}][comments]"id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div> --}}
                                </div>     
                                @endforeach @php  @endphp

                                @elseif($questionnaires->InputTypesData->slug == 'development')
                                {{-- @php echo "<pre>";print_r($questionnaires->responsibility->toArray());die; @endphp --}}
                                 <h5>Employee Development</h5>
                                 @foreach ($questionnaires->development as $development)
            
                                            <input type="hidden" name="gaolreviewID" value="{{  $questionnaires->id }}">
                                            <input type="hidden" name="goalId[]" value="{{ $development->id }}">
                                            <input type="hidden" name="managerid" value="{{ $questionnaires->user->manager->id }}">
                                            <input type="hidden" name="rating_id" value="{{ $questionnaires->rating_id }}">
                                            <input type="hidden" name="goal_input_type" value="development">
                                        
                                            <div class="mx-2" style="font-weight: 500;">{{ $development->title }}</div>
                                            <div class="d-flex my-2" style="align-items: baseline;">
                                                
                                                {{-- <span class="mx-2">{{ $development->discription  }}</span> --}}
                                                <span class="mx-2">{{ number_format($development->total_progress,2,'.','') .'%' }}</span>
                                                
                                                <div class="progress mb-0 mx-2" style="width:150px">
                                                    <div class="progress-bar" role="progressbar" style="width:{{ $development->total_progress . '%' }}" aria-valuenow="{{ $development->total_progress }}" aria-valuemin="0" aria-valuemax="100">{{ $development->total_progress . '%' }}</div>
                                                </div>
                                            </div>
                                        
                                            <div class="row justify-content-center ratingData parent my-2" id="ratingPreview">
                                                @php $no = 1; @endphp
                                        
                                                @foreach ($questionnaires->rating->ratingScaleOption as $ratingoption)
                                                <div class="col-auto text-center">
                                                    <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                                    <div class="rating d-flex justify-content-center">
                                                        <label for="rating_{{ $development->id }}_{{ $loop->iteration }}"
                                                            class="border rounded-circle rating-circle"
                                                            onclick="ratingColor(this,'ration{{ $no }}')">
                                                            {!! $questionnaires->rating->display_type == 1 ? '<i class="mdi mdi-star fs-3"></i>' : $no !!}
                                                        </label>
                                                        <input type="radio"
                                                            name="goals[{{ $development->id }}][ratings]"
                                                            class="opacity-0"
                                                            id="rating_{{ $development->id }}_{{ $loop->iteration }}"
                                                            value="{{ $ratingoption->option_label }}">
                                                    </div>
                                                    
                                                </div>
                                                <?php $no++; ?>
                                                @endforeach
                                                
                                                @if($questionnaires->goalcomment_id == 1)
                                                <div class="mb-3 mt-2">
                                                    <label for="exampleFormControlTextarea1" class="form-label">
                                                        Please explain your choice here (optional):</label>
                                                    <textarea class="form-control" name="comment[{{ $development->id }}][comments]" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                                @endif
                                            </div>     
                                            @endforeach @php  @endphp



                       @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('goalreview') }}" class="btn btn-light">Close</a>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Save<i
                                    class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                    style="display:none;"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page-js-script')
    <script>
        let click = false;

        function formSubmit(e) {
            if (click == true) {
                return;
            }
            click = true;

            $('div.error').remove();
            url = "{{ route('user.goal-review.store') }}";
            $('#formSubmit').find('.st_loader').show();
            event.preventDefault();
            var formData = new FormData($('#formSubmit')[0]);

            let input = '';
            let select = '';
            let textarea = '';
            let radio = '';
            let checkbox = '';

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                        $('#formSubmit').find('.st_loader').hide();
                     window.location.replace("{{ route('goalreview') }}");
                    } else {
                        toastr.error("Find some error.Please check ratings field you choose or not", 'Error');
                        $('#formSubmit').find('.st_loader').hide();
                    }

                    click = false;
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    
                    // $('#formSubmit').find('.st_loader').hide();
                    // var errors = JSON.parse(xhr.responseText);
                  $('#formSubmit').find('.st_loader').hide();

                    var errors = xhr.responseJSON.errors;  
                    if (errors) {
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                toastr.error(errors[key][0], 'Error');
                            }
                        }
                    }

                    click = false;

                    $.each(errors['errors'], function(key, value) {
                        // $('#error-' + key).text(value);
                        // var errors = xhr.responseJSON.errors;  
                        // if (errors) {
                        //     for (var key in errors) {
                        //         if (errors.hasOwnProperty(key)) {
                        //             toastr.error(errors[key][0], 'Error');
                        //         }
                        //     }
                        // }
                        // const [name, number] = key.split(".");
                        // console.log(name);
                        // console.log(number);
                        // input = '';
                        // select = '';
                        // textarea = '';
                        // radio = '';
                        // checkbox = '';

                        // radio = $('input[name="' + name + '[' + number + ']"][type="radio"]').eq(0);
                        // checkbox = $('input[name="' + name + '[' + number + '][]"][type="checkbox"]')
                        //     .eq(0);
                        // input = $('input[name="' + name + '[' + number + ']"]').eq(0);
                        // select = $('select[name="' + name + '[' + number + ']"]').eq(0);
                        // textarea = $('textarea[name="' + name + '[' + number + ']"]').eq(0);

                        // if (radio.length > 0) {
                        //     radio.parents('div.parent').append(
                        //         '<div class="error" style="color:red;">' + value + '</div>');
                        // }else {
                        //     toastr.error('.', 'Error')
                        // }

                    });

                    var firstError = $('div.error:first');
                    if (firstError.length) {
                        var offset = firstError.offset().top - 200;
                        $('html, body').animate({
                            scrollTop: offset
                        }, 500);
                    }

                    click = false;
                }
            });
        }

        function ratingColor(e, rating) {

            $(e).closest('.ratingData').find('.rating-circle').css('background-color', '');
            $(e).css('background-color', '#e3e9ed');
        }
    </script>
@endsection