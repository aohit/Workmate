<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">Update Input</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="inputFormSubmit" onsubmit="inputformSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <input type="hidden" name="id" value="{{$InputData->id}}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body px-sm-3 px-0">
                            <section id="section">
                                <div class="row">
                                    <div class="mb-3 col-lg-12">
                                        <label for="validationCustom01" class="form-label">Parameter</label>
                                        <input type="text" class="form-control" id="validationCustom01"
                                            placeholder="Input Parameter" name="inputlabel" value="{{$InputData->label}}" />
                                    </div>
                                    <div class="mb-3 col-lg-6">
                                        <label for="validationCustom02" class="form-label">Response Formate</label>
                                        <select class="form-select" id="type" name="type" onchange="selected()">
                                            <option value="">Select Formate</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"  {{  $InputData->input_type_id == $type->id  ? 'selected' : '' }} data-title="{{ $type->slug }}">
                                                    {{ $type->title }}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-6" id="placeholder">
                                        <label for="validationCustom01" class="form-label">Placeholder</label>
                                        <input type="text" class="form-control" id="validationCustom01"
                                            placeholder="Enter Placeholder" name="placeholder"  value="{{$InputData->placeholder}}"/>
                                    </div>
                                    <div class="mb-3 col-lg-6 d-none" id="ratingScales">
                                        <label for="validationCustom01" class="form-label">Rating Scales</label>
                                         <select class="form-select" id="type" name="rating">
                                            <option value="">Select Scles</option>
                                            @foreach ($ratings as $rating)
                                                <option value="{{ $rating->id }}" {{ !empty($InputData->RatingsData->id) ==  $rating->id  ? 'selected' : '' }} > {{ $rating->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <section class="d-none" id="radio">
                                        <div class="mb-3 col-lg-12 border  overflow-auto p-2" style="height: 147px" id="">
                                            <table class="m-auto">
                                                <tbody>
                                                    @php
                                                    $count = count($InputData->FormMultipleInput);
                                                @endphp
                                                @if($count > 0)
                                                    @foreach ($InputData->FormMultipleInput as $radioInputs)

                                                    <tr>
                                                        <td><input type="text" name="radioName[]"
                                                                class="form-control" value="{{$radioInputs->label}}" placeholder="Enter a label..."
                                                                ></td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="deleteRow(this)">
                                                                <span class="mdi mdi-delete fs-3"></span>
                                                            </button>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="addRow(this)">
                                                                <span class="mdi mdi-plus fs-3"></span>
                                                            </button>
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td><input type="text" name="radioName[]"
                                                                class="form-control" placeholder="Enter a label..."
                                                                ></td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="deletecheckboxRow(this)">
                                                                <span class="mdi mdi-delete fs-3"></span>
                                                            </button>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="addRow(this)">
                                                                <span class="mdi mdi-plus fs-3"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </section>
                                    <section class="d-none" id="checkbox">
                                        <div class="mb-3 col-lg-12 border  overflow-auto p-2" style="height: 147px" id="">
                                            <table class="m-auto">
                                                <tbody>
                                                    @php
                                                    $count = count($InputData->FormMultipleInput);
                                                @endphp
                                                @if($count > 0)
                                                @foreach ($InputData->FormMultipleInput as $checkbox)
                                                    <tr>
                                                        <td><input type="text" name="checkboxName[]"
                                                                class="form-control" value="{{$checkbox->label}}" placeholder="Enter a label..."
                                                                ></td>
                                                        <td>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="deletecheckboxRow(this)">
                                                                <span class="mdi mdi-delete fs-3"></span>
                                                            </button>
                                                            <button type="button" class="btn btn-outline p-0"
                                                                onclick="addRow(this)">
                                                                <span class="mdi mdi-plus fs-3"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td><input type="text" name="checkboxName[]"
                                                            class="form-control" placeholder="Enter a label..."
                                                            ></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline p-0"
                                                            onclick="deletecheckboxRow(this)">
                                                            <span class="mdi mdi-delete fs-3"></span>
                                                        </button>
                                                        <button type="button" class="btn btn-outline p-0"
                                                            onclick="addRow(this)">
                                                            <span class="mdi mdi-plus fs-3"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                
                                                @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </section>
                                    <section class="d-none" id="select">
                                        <div class="mb-3 col-lg-12 border  overflow-auto p-2" style="height: 147px" id="">
                                            <table class="m-auto">
                                                <tbody>
                                                    @foreach ($InputData->FormMultipleInput as $options)
                                                        <tr>
                                                            <td><input type="text" name="options[]"
                                                                    class="form-control" value="{{$options->label}}" placeholder="Enter a label..."
                                                                    ></td>
                                                            <td>
                                                                <button type="button" class="btn btn-outline p-0"
                                                                    onclick="deleteoptionsRow(this)">
                                                                    <span class="mdi mdi-delete fs-3"></span>
                                                                </button>
                                                                <button type="button" class="btn btn-outline p-0"
                                                                    onclick="addRow(this)">
                                                                    <span class="mdi mdi-plus fs-3"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </section>
                                    {{-- <div class="mb-3 col-lg-12 text-end">
                                        <button type="button" onclick="remove(this)" class="btn btn-primary mb-2 text-right d-none remove"><i class="fa fa-minus" aria-hidden="true"></i> Remove</button>
                                        <button type="button" id="addInputs" onclick="addMore(this)" class="btn btn-primary mb-2 text-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Inputs</button>
                                    </div>  --}}
                                </div>
                            </section>
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
        }else if(selectedTitle == 'rating' || selectedTitle  == 'goal' || selectedTitle  == 'competency' || selectedTitle  == 'responsibility' || selectedTitle  == 'development'){
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

    var selectedTypeValue = $('#type option:selected').attr('data-title');
    if (selectedTypeValue == 'radio') {
                $('#radio').removeClass('d-none');
                $('#checkbox').addClass('d-none');
                $('#select').addClass('d-none');
                $('#ratingScales').addClass('d-none');
                $('#placeholder').removeClass('d-none');
        }else if(selectedTypeValue == 'checkbox'){
            $('#checkbox').removeClass('d-none');
            $('#radio').addClass('d-none');
            $('#select').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }else if(selectedTypeValue == 'dropdown'){
            $('#select').removeClass('d-none');
            $('#radio').addClass('d-none');
            $('#checkbox').addClass('d-none');
            $('#ratingScales').addClass('d-none');
            $('#placeholder').removeClass('d-none');
        }else if(selectedTypeValue == 'rating' || selectedTypeValue  == 'goal' || selectedTypeValue  == 'competency' || selectedTypeValue  == 'responsibility' || selectedTypeValue  == 'development'){
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

    function inputformSubmit(e) {
        $('#inputFormSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#inputFormSubmit')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.questionnaire-edit-store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) {
                    toastr.success(response.message, 'Success');
                    $('#inputFormSubmit').find('.st_loader').hide();
                    $("#bs-example-modal-lg").modal("hide");
                    location.reload();
                
                } else {
                    toastr.error("Find some error", 'Error');
                    $('#inputFormSubmit').find('.st_loader').hide();
                }


            },
            error: function(xhr, status, error) {
                $('#inputFormSubmit').find('.st_loader').hide();
                var $err = ''
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $err = $err + value + "<br>"
                })
                toastr.error($err, 'Error')
            }
        });
    }

    function addRow(e) {
        let row = $(e).parents('tr');

        $(row).after('<tr>' + row.html() + '</tr>');
        row.next('tr').find('input').val('');
        rowValue();
    }

    function deleteRow(e) {
        let rowCount = $('#radio').find('tbody tr').length;
        if (rowCount != 1) {
            if (confirm("Are you sure you want to delete this row?")) {
                $(e).parents('tr').remove();
                // rowValue();
            }
        } else {
            alert('You can not delete this row.');
        }
    }
    function deletecheckboxRow(e) {
        let rowCount = $('#checkbox').find('tbody tr').length;
        if (rowCount != 1) {
            if (confirm("Are you sure you want to delete this row?")) {
                $(e).parents('tr').remove();
                // rowValue();
            }
        } else {
            alert('You can not delete this row.');
        }
    }
    function deleteoptionsRow(e) {
        let rowCount = $('#select').find('tbody tr').length;
        if (rowCount != 1) {
            if (confirm("Are you sure you want to delete this row?")) {
                $(e).parents('tr').remove();
                // rowValue();
            }
        } else {
            alert('You can not delete this row.');
        }
    }
</script>
