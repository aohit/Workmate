@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="container-fluid p-2">
        <div class="card">
            <div class="card-body ">
                    @csrf
                    <h3>{{ $questionnaires->title }}</h3>
                    {{-- <hr> --}}
                    {{-- @if($questionnaires->user_id == $user)
                    <div class="section mb-3">
                        @foreach ($questionnaires->FormQue->FormSection as $formSection) 
                        
                        <input type="hidden" name="formQueID" value="{{  $questionnaires->FormQue->id }}">
                        <input type="hidden" name="appraisal_id" value="{{  $questionnaires->id }}">
                        <div class="sectionheading mb-3">
                            <h4>{{ $formSection->title }}</h4>
                        </div>
                        @foreach ($formSection->FormInput as $formInputs)   
                        <?php  //echo "<pre>"; print_r($formInputs->toArray());  ?>
                       @if($formInputs->InputType->name == 'input')
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
                        @foreach ($questionnaires->FormSection as $formSection) 
                        
                        <input type="hidden" name="formQueID" value="{{  $questionnaires->id }}">
                        <input type="hidden" name="appraisal_id" value="{{  $questionnaires->id }}">
                        <div class="sectionheading mb-3">
                            <h4>{{ $formSection->title }}</h4>
                        </div>
                            @foreach ($formSection->FormInput as $formInputs)   
                            <?php  //echo "<pre>"; print_r($QuestionsData->toArray());  ?>
                                    @if($formInputs->InputType->name == 'input')
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
                                                    <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" value="{{$multipleInput->label}}">
                                                    <label class="form-check-label"  for="{{  $multipleInput->label }}">{{  $multipleInput->label }}</label>
                                                </div>
                                            @endforeach
                                            
                                    @elseif($formInputs->InputType->name == 'checkbox')
                                        <div class="label">
                                            <label class="form-label" for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                        </div>
                                        @foreach ($formInputs->FormMultipleInput as $multipleInput) 
                                        <div class="sectionlabel mb-3">
                                            <input class="form-check-input" type="{{ $formInputs->InputType->type }}" name="{{$formSection->sec_id}}[{{$formInputs->id}}][]" value="{{$multipleInput->label}}">
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

                                    @elseif($formInputs->InputType->name == 'rating'|| $formInputs->InputType->name == 'goal' || $formInputs->InputType->name == 'competency' || $formInputs->InputType->name == 'responsibility' || $formInputs->InputType->name == 'development')
                                    <div class="sectionlabel mb-3">
                                        <label class="form-label" for="{{ $formInputs->label }}" >{{ $formInputs->label }}</label>
                                    <div class="row justify-content-center ratingData" id="ratingPreview">
                                        <?php $no =1; ?>
                                        @foreach ($formInputs->RatingsData->ratingScaleOption as $ratingoption)
                                        <div class="col-auto text-center">
                                            <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                            <div class="rating d-flex justify-content-center">
                                             <label for="rating{{$formInputs->id.$loop->iteration}}" class="border rounded-circle rating-circle" onclick="ratingColor(this,'ration{{$no}}')" >{{ $no }}</label>
                                             <input type="radio" name="{{$formSection->sec_id}}[{{$formInputs->id}}]" class="opacity-0"   id="rating{{$formInputs->id.$loop->iteration}}" value="{{$ratingoption->option_label}}">
                                            </div>
                                        </div>
                                        <?php $no++; ?>
                                        @endforeach
                                    </div>
                                    </div>


                                    @endif
                             @endforeach
                        @endforeach
                    </div>
                    {{-- @endif --}}
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('admin.questionnaire') }}" class="btn btn-light">Close</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
