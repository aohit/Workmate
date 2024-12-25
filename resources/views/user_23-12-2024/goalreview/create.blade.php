<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Employee Name</label>
                                    <select class="form-select"  name="employee">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" >
                                                {{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                        <label for="validationCustom02" class="form-label">Review Cycles</label>
                                    <select class="form-select"  name="reviewcycle">
                                        <option value="">Select Reviewcycle</option>
                                        @foreach ($reviewcycles as $reviewcycle)
                                            <option value="{{ $reviewcycle->id }}" >
                                                {{ $reviewcycle->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Response Format</label>
                                    <select class="form-select" id="type" name="type" onchange="selected()">
                                        <option value="">Select Format</option>
                                                <option value="11" data-title="{{ 'goal' }}">Goal</option>
                                                 <option value="10" data-title="{{ 'competency' }}">Competency</option>
                                                 <option value="12" data-title="{{ 'responsibility' }}">Responsibility</option>
                                                 <option value="13" data-title="{{ 'development' }}">Development</option>
                                    </select>
                                </div>
                                 <div class="mb-3 col-lg-6 d-none" id="ratingScales">
                                        <label for="validationCustom01" class="form-label">Rating Scales</label>
                                        <select class="form-select" id="type" name="rating">
                                            <option value="">Select Scales</option>
                                            @foreach ($ratings as $rating)
                                                <option value="{{ $rating->id }}"> {{ $rating->label }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="comment" value="5" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                  If you want to comment on goal. 
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

<script>
    function selected() {
        var selectedTitle = $('#type option:selected').attr('data-title');
        if (selectedTitle == 'radio') {
            $('#radio').removeClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#select').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }else if(selectedTitle == 'checkbox'){
            $('#checkbox').removeClass('d-none');
            $('#radio').addClass('d-none');
            $('#select').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }else if(selectedTitle == 'dropdown'){
            $('#select').removeClass('d-none');
            $('#radio').addClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }else if(selectedTitle == 'rating'|| selectedTitle  == 'goal' || selectedTitle  == 'competency' || selectedTitle  == 'responsibility' || selectedTitle  == 'development'){
            $('#ratingScales').removeClass('d-none');
            $('#placeholder').addClass('d-none');
            $('#radio').addClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#select').addClass('d-none');
        }else{
            $('#radio').addClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#select').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }

    }

</script>
