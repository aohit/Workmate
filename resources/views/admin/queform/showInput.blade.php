<style>
    .rating-circle {
        height: 50px;
        width: 50px;
        / display: block;/ display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<?php //echo "<pre>"; print_r($tempInputs->toArray()); die ?>
<div class="row mt-1  dynamicInput">
        <label for="{{ $tempInputs->placeholder }}" class="form-label"> {{ $tempInputs->label }} </label>
                    <input type="hidden" name="{{$time }}" class="form-label" value="{{ $tempInputs->id }}"> </input>
                    <input type="hidden" name="time[]" class="form-label" value="{{$time }}"> </input>
        @if ($tempInputs->inputType->name == 'input')

                   <input type="{{ $tempInputs->inputType->type }}" name="{{$tempInputs->inputType->type}}[]" class="form-control" placeholder="{{ $tempInputs->placeholder }}" readonly>

        @elseif($tempInputs->inputType->name == 'radio')

        @foreach ($tempInputs->multipleinput as $multipleInputs)
            <label for="{{ $multipleInputs->type }}"> <input type="{{ $multipleInputs->type }}"
                    name="{{ $multipleInputs->type }}[]" class="form-check-input" @readonly(true)> {{ $multipleInputs->label }}</label>
        @endforeach

        @elseif($tempInputs->inputType->name == 'checkbox')

        @foreach ($tempInputs->multipleinput as $multipleInputs)
            <label for="{{ $multipleInputs->type }}"> 

            <input type="{{ $multipleInputs->type }}" class="form-check-input" name="{{ $multipleInputs->type }}" @readonly(true) >{{ $multipleInputs->label }}

            </label>
        @endforeach

        @elseif($tempInputs->inputType->name == 'select')

            <select class="form-select" name="" id="" @readonly(true)>
                @foreach ($tempInputs->multipleinput as $multipleInputs)
                <option value="">{{$multipleInputs->label}}</option>
                @endforeach
            </select>

        @elseif($tempInputs->inputType->name == 'textarea')

        <textarea name="{{$tempInputs->inputType->name}}"  class="form-control"  rows="3" @readonly(true)></textarea>

        @elseif($tempInputs->inputType->name == 'rating' || $tempInputs->inputType->name == 'goal'  || $tempInputs->inputType->name == 'competency' || $tempInputs->inputType->name == 'responsibility'  || $tempInputs->inputType->name == 'development')
        <div class="row justify-content-center" id="ratingPreview">
            <?php $no =1; ?>
            @foreach ($tempInputs->RatingsData->ratingScaleOption as $ratingoption)
        
            <div class="col-auto text-center">
                <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                <div>
                 <label for="rating{{$no}}" class="border rounded-circle rating-circle">{{ $no }}</label>
                 <input type="radio" name="{{$tempInputs->label }}"  class="opacity-0" id="rating{{$no}}">

                </div>
            </div>
            <?php $no++; ?>
            @endforeach
        </div>

    @endif


</div>
