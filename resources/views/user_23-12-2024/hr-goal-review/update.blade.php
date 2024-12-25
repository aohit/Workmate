<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <input type="hidden" name="id" value="{{ $uinfo->id }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    {{-- <div class="mb-3 col-lg-6">
                                        <label for="validationCustom08" class="form-label">Reporting To</label>
                                        <select class="form-select" name="reporting">
                                            <option value="">-Select-</option>
                                            @foreach($employee as $emp)
                                            <option value="{{ $emp->id }}" @if($uinfo->reporting_to ==
                                                $emp->id) selected @endif>{{ $emp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <label for="validationCustom02" class="form-label">Employee Name</label>
                                    <select class="form-select"  name="employee">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"  @if($uinfo->employee_id ==
                                                $employee->id) selected @endif>
                                                {{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                        <label for="validationCustom02" class="form-label">Review Cycles</label>
                                    <select class="form-select"  name="reviewcycle">
                                        <option value="">Select Review Cycle</option>
                                        @foreach ($reviewcycles as $reviewcycle)
                                            <option value="{{ $reviewcycle->id }}" @if($uinfo->review_cycle_id ==
                                                $reviewcycle->id) selected @endif>
                                                {{ $reviewcycle->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Response Format</label>
                                    <select class="form-select" id="type" name="type" onchange="selected()">
                                        {{-- <option value="">Select Format</option> --}}
                                        <option value="11" data-title="goal" @if($uinfo->input_type_id == 11) selected @endif>Goal</option>
                                        <option value="10" data-title="competency" @if($uinfo->input_type_id == 10) selected @endif>Competency</option>
                                        <option value="12" data-title="responsibility" @if($uinfo->input_type_id == 12) selected @endif>Responsibility</option>
                                        <option value="13" data-title="development" @if($uinfo->input_type_id == 13) selected @endif>Development</option>
                                    </select>
                                </div>
                                 <div class="mb-3 col-lg-6" id="ratingScales">
                                        <label for="validationCustom01" class="form-label">Rating Scales</label>
                                        <select class="form-select" id="type" name="rating">
                                            <option value="">Select Scales</option>
                                            @foreach ($ratings as $rating)
                                                <option value="{{ $rating->id }}" @if($uinfo->rating_id ==
                                                $rating->id) selected @endif> {{ $rating->label }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="comment" value="1" id="flexCheckChecked" 
                                @if($uinfo->goalcomment_id == 1) checked @endif>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Comment on Goal.
                                </label>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save<i
                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
    </div>
</form>

<script src="{{ asset('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js">
</script>
<script>
    $('#colorpicker').on('input', function() {
        $('#hexcolor').val(this.value);
    });
    $('#hexcolor').on('input', function() {
        $('#colorpicker').val(this.value);
    });

    $('#colorpicker2').on('input', function() {
        $('#hexcolor2').val(this.value);
    });
    $('#hexcolor2').on('input', function() {
        $('#colorpicker2').val(this.value);
    });
</script>
