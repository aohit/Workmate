@extends('user.layouts.app')

@section('content')
    <div class="container-fluid p-2">
        <div class="card">
            <div class="card-body ">
                <form id="formSubmit" onsubmit="formSubmit(this);return false;">
                    @csrf
                    <div class="row">
                        <h4>Performance Appraisal: {{ $questionnaires->FormQue->title }}</h4>
                        <div class="col-sm-6 p-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <!--<img src="{{ asset('assets/images/users/user-8.jpg') }}" style="width: 85px"-->
                                    <!--    class="rounded-circle" alt="">-->
                                      @php 
                                          if(isset($questionnaires->User->Profile->file)){
                                            $image_url = url('/upload/employee/' . $questionnaires->User->Profile->file);
                                        }else{
                                            $image_url = url('upload/employee/demo.jpg');
                                        }
                                        @endphp
                                        <img src="{{ $image_url }}" class="img-thumbnail profile-img" style="height: 110px; width: 110px;border-radius:50%">
                                    
                                </div>
                                <div class="col-sm-9">
                                    <p class="m-0">Name :<span> {{ $questionnaires->User->name }}</span> </p>
                                    <span> Manager Name:</span> <span> {{ @$questionnaires->Manager->name }}</span><br>
                                    <span> Review cycle :</span> {{ @$questionnaires->reviewcycle->title }} (<span>from {{ $questionnaires->reviewcycle?->start_date }} to
                                        {{ @$questionnaires->reviewcycle?->end_date }} </span>)
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
                    {{-- @if ($questionnaires->user_id == $user)
                    <div class="section mb-3">
                        @foreach ($questionnaires->FormQue->FormSection as $formSection) 
                        
                        <input type="hidden" name="formQueID" value="{{  $questionnaires->FormQue->id }}">
                        <input type="hidden" name="appraisal_id" value="{{  $questionnaires->id }}">
                        <div class="sectionheading mb-3">
                            <h4>{{ $formSection->title }}</h4>
                        </div>
                        @foreach ($formSection->FormInput as $formInputs)   
                        <?php //echo "<pre>"; print_r($formInputs->toArray());
                        ?>
                       @if ($formInputs->InputType->name == 'input')
                        <div class="sectionlabel mb-3">
                                <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                <input type="{{$formInputs->InputType->type}}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" class="form-control" placeholder="{{ $formInputs->placeholder }}">
                        </div>
                        @elseif($formInputs->InputType->name == 'textarea')
                        <div class="sectionlabel mb-3">
                            <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                            <textarea class="form-control" rows="3" name="{{ $formSection->sec_id}}[{{$formInputs->id}}]" placeholder="{{ $formInputs->placeholder }}"></textarea> 
                        </div>
                        @elseif($formInputs->InputType->name == 'radio')
                        <div class="label">
                        <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                        </div>
                        @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                        <div class="sectionlabel mb-3">
                            <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" >
                            <label class="form-check-label"  for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                        </div>
                        @endforeach
                        @elseif($formInputs->InputType->name == 'checkbox')
                        <div class="label">
                            <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                        </div>
                        @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                        <div class="sectionlabel mb-3">
                            <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" >
                            <label class="form-check-label" for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                        </div>
                        @endforeach
                        @elseif($formInputs->InputType->name == 'select')
                        <div class="sectionlabel mb-3">
                             <label class="form-label" for="{{ $formInputs->label }}" >{{ $formInputs->label }}</label>
                                <select  class="form-select"name="{{$formSection->sec_id}}[{{$formInputs->id}}]" id="">
                                    @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                                    <option value="{{  $multipleInput->label }}">{{  $multipleInput->label }}</option>
                                    @endforeach
                                </select>
                         </div>
                       @endif
                        @endforeach
                        <hr>
                        @endforeach
                    </div>
                    @elseif($questionnaires->manager_id == $user) --}}

                    <div class="section mb-3">
                        @foreach ($questionnaires->FormQue->FormSection as $formSection)
                            <input type="hidden" name="formQueID" value="{{ $questionnaires->FormQue->id }}">
                            <input type="hidden" name="appraisal_id" value="{{ $questionnaires->id }}">
                            <div class="sectionheading mb-3">
                                <h4>{{ $formSection->title }}</h4>
                            </div>
                            <div class="ps-3 border-bottom">
                                @foreach ($formSection->FormInput as $formInputs)
                                    <?php //echo "<pre>"; print_r($QuestionsData->toArray());
                                    ?>
                                    @if ($formInputs->InputType->name == 'input')
                                        <div class="sectionlabel mb-3">
                                            <label class="form-label"
                                                for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                            <input type="{{ $formInputs->InputType->type }}"
                                                name="{{ $formSection->sec_id }}[{{ $formInputs->id }}]"
                                                class="form-control" placeholder="{{ $formInputs->placeholder }}">
                                        </div>
                                    @elseif($formInputs->InputType->name == 'textarea')
                                        <div class="sectionlabel mb-3">
                                            <label class="form-label"
                                                for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                            <textarea class="form-control" rows="3" name="{{ $formSection->sec_id }}[{{ $formInputs->id }}]"
                                                placeholder="{{ $formInputs->placeholder }}"></textarea>
                                        </div>
                                    @elseif($formInputs->InputType->name == 'radio')
                                        <div class="label">
                                            <label class="form-label"
                                                for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                        </div>
                                        <div class="parent mb-3">
                                            @foreach ($formInputs->FormMultipleInput as $multipleInput)
                                                <div class="sectionlabel">
                                                    <input class="form-check-input"
                                                        type="{{ $formInputs->InputType->type }}"
                                                        name="{{ $formSection->sec_id }}[{{ $formInputs->id }}]"
                                                        value="{{ $multipleInput->label }}"
                                                        id="{{ $formSection->sec_id }}{{ $formInputs->id }}{{ $multipleInput->label }}">
                                                    <label class="form-check-label"
                                                        for="{{ $formSection->sec_id }}{{ $formInputs->id }}">{{ $multipleInput->label }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif($formInputs->InputType->name == 'checkbox')
                                        <div class="label">
                                            <label class="form-label"
                                                for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                        </div>
                                        <div class="parent mb-3">
                                            @foreach ($formInputs->FormMultipleInput as $multipleInput)
                                                <div class="sectionlabel">
                                                    <input class="form-check-input"
                                                        type="{{ $formInputs->InputType->type }}"
                                                        name="{{ $formSection->sec_id }}[{{ $formInputs->id }}][]"
                                                        value="{{ $multipleInput->label }}">
                                                    <label class="form-check-label"
                                                        for="{{ $multipleInput->label }}">{{ $multipleInput->label }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif($formInputs->InputType->name == 'select')
                                        <div class="sectionlabel mb-3">
                                            <label class="form-label"
                                                for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                            <select class="form-select"
                                                name="{{ $formSection->sec_id }}[{{ $formInputs->id }}]" id="">
                                                @foreach ($formInputs->FormMultipleInput as $multipleInput)
                                                    <option value="{{ $multipleInput->label }}">
                                                        {{ $multipleInput->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @elseif($formInputs->InputType->name == 'rating'  || $formInputs->inputType->name == 'goal'  || $formInputs->inputType->name == 'competency' || $formInputs->inputType->name == 'responsibility'  || $formInputs->inputType->name == 'development')
                                        <div class="sectionlabel mb-3">
                                            <label class="form-label"
                                                for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                            <div class="row justify-content-center ratingData parent" id="ratingPreview">
                                                <?php $no = 1; ?>
                                                @if($formInputs->RatingsData?->ratingScaleOption != '')
                                                @foreach (@$formInputs->RatingsData->ratingScaleOption as $ratingoption)
                                                    <div class="col-auto text-center">
                                                        @php
                                                            $iteration = $loop->iteration;
                                                            $iteration++;
                                                        @endphp
                                                        <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                                        <div class="rating d-flex justify-content-center">
                                                            <label for="rating{{ $formInputs->id . $loop->iteration }}"
                                                                class="border rounded-circle rating-circle"
                                                                onclick="ratingColor(this,'ration{{ $no }}')">{!! $formInputs->RatingsData->display_type == 1 ? '<i class="mdi mdi-star fs-3"></i>' : $no !!}</label>
                                                            <input type="radio"
                                                                name="{{ $formSection->sec_id }}[{{ $formInputs->id }}]"
                                                                class="opacity-0"
                                                                id="rating{{ $formInputs->id . $loop->iteration }}"
                                                                value="{{ $ratingoption->option_label }}">
                                                        </div>
                                                    </div>
                                                    <?php $no++; ?>
                                                @endforeach
                                                @endif
                                                @if ($formInputs->RatingsData?->is_include_na == 1)
                                                    <div class="col-auto text-center">
                                                        <h5 class="text-wrap">Not applicable</h5>
                                                        <div class="rating d-flex justify-content-center">
                                                            <label for="rating{{ $formInputs->id . $iteration }}"
                                                                class="border rounded-circle rating-circle"
                                                                onclick="ratingColor(this,'ration{{ $no }}')">N/A</label>
                                                            <input type="radio"
                                                                name="{{ $formSection->sec_id }}[{{ $formInputs->id }}]"
                                                                class="opacity-0"
                                                                id="rating{{ $formInputs->id . $iteration }}"
                                                                value="Not applicable">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    {{-- @endif --}}
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('user.appraisal') }}" class="btn btn-light">Close</a>
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
            url = "{{ route('user.appraisal.store') }}";
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
                        window.location.replace("{{ route('user.appraisal') }}");
                    } else {
                        toastr.error("Find some error", 'Error');
                        $('#formSubmit').find('.st_loader').hide();
                    }

                    click = false;
                },
                error: function(xhr, status, error) {
                    $('#formSubmit').find('.st_loader').hide();
                    var errors = JSON.parse(xhr.responseText);
                    $.each(errors['errors'], function(key, value) {
                        $('#error-' + key).text(value);

                        const [name, number] = key.split(".");
                        // console.log(name);
                        // console.log(number);
                        input = '';
                        select = '';
                        textarea = '';
                        radio = '';
                        checkbox = '';

                        radio = $('input[name="' + name + '[' + number + ']"][type="radio"]').eq(0);
                        checkbox = $('input[name="' + name + '[' + number + '][]"][type="checkbox"]')
                            .eq(0);
                        input = $('input[name="' + name + '[' + number + ']"]').eq(0);
                        select = $('select[name="' + name + '[' + number + ']"]').eq(0);
                        textarea = $('textarea[name="' + name + '[' + number + ']"]').eq(0);

                        if (radio.length > 0) {
                            radio.parents('div.parent').append(
                                '<div class="error" style="color:red;">' + value + '</div>');
                        } else if (checkbox.length > 0) {
                            checkbox.parents('div.parent').append(
                                '<div class="error" style="color:red;">' + value + '</div>');
                        } else if (input.length > 0) {
                            input.after('<div class="error" style="color:red;">' + value + '</div>');
                        } else if (select.length > 0) {
                            select.after('<div class="error" style="color:red;">' + value + '</div>');
                        } else if (textarea.length > 0) {
                            textarea.after('<div class="error" style="color:red;">' + value + '</div>');
                        } else {
                            toastr.error('Something error found! Please try again.', 'Error')
                        }

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
