@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form id="formSubmit" onsubmit="formSubmit(this);return false;">
                @csrf
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Questionnaire Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form_heading" placeholder="Enter Questionnaire Label"
                            name="formheading" value="{{ $questionnaires->title }}">
                    </div>
                </div>
                <input type="hidden" name="formId" id="formId" value="{{ $questionnaires->id }}">
                @foreach ($questionnaires->FormSection as $key => $formSections)
                    <section id="section">
                        @if ($key == 0)
                            <div class="d-flex justify-content-end mt-2">
                                <button type="button" onclick="addsection(this,{{ $questionnaires->id }})"
                                    class="btn btn-primary mb-2 text-right"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                            </div>
                        @else
                            <div class="d-flex justify-content-end mt-2">
                                <button type="button" onclick="removesection(this,{{ $formSections->id }})"
                                    class="btn btn-danger mb-2 text-right"><i class="fa fa-minus"
                                        aria-hidden="true"></i></button>
                            </div>
                        @endif
                        <div class="border multipleSections p-3">
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">category :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control formSection"
                                        placeholder="Enter Questionnaire Section" name="section[{{ $formSections->sec_id}}]"
                                        value="{{ $formSections->title }}">
                                </div>
                            </div>
                            <div class="row mt-2 inputs">
                                <div class="col-sm-12 text-end">
                                    <button type="button" onclick="addInput(this,{{ $formSections->id }});return false;"
                                        class="btn btn-primary mb-2 text-right"><i class="fa fa-plus"
                                            aria-hidden="true"></i> Add Inputs</button>
                                </div>
                            </div>

                            @foreach ($formSections->FormInput as $formInputs)
                                <?php //echo "<pre>"; print_r($formInputs->toArray());
                                ?>
                                <div class="row mt-1  dynamicInput">
                                    @if ($formInputs->InputType->name == 'input')
                                        <div class="row align-items-center">
                                            <div class="col-10">
                                                <div class="sectionlabel mb-3">
                                                    <label class="form-label"
                                                        for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                                    <input type="{{ $formInputs->InputType->type }}"
                                                        name="{{ $formSections->sec_id }}[{{ $formInputs->id }}]"
                                                        class="form-control" placeholder="{{ $formInputs->placeholder }}">
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex justify-content-sm-around align-items-center">
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="editInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-pencil-square-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-trash-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    @elseif($formInputs->InputType->name == 'textarea')
                                        <div class="sectionlabel mb-3 row">
                                            <div class="col-10">
                                                <label class="form-label"
                                                    for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                                <textarea class="form-control" rows="3" name="{{ $formSections->sec_id }}[{{ $formInputs->id }}]"
                                                    placeholder="{{ $formInputs->placeholder }}"></textarea>
                                            </div>
                                            <div class="col-2 d-flex justify-content-sm-around align-items-center">
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="editInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-pencil-square-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-trash-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($formInputs->InputType->name == 'radio')
                                        <div class="row">
                                            <div class="label col-10">
                                                <label class="form-label"
                                                    for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                                @foreach ($formInputs->FormMultipleInput as $multipleInput)
                                                    <div class="sectionlabel mb-2">
                                                        <input class="form-check-input"
                                                            type="{{ $formInputs->InputType->type }}"
                                                            name="{{ $formSections->sec_id }}[{{ $formInputs->id }}]"
                                                            value="{{ $multipleInput->label }}">
                                                        <label class="form-check-label"
                                                            for="{{ $multipleInput->label }}">{{ $multipleInput->label }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-2 d-flex justify-content-sm-around align-items-center">
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="editInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-pencil-square-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-trash-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($formInputs->InputType->name == 'checkbox')
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="label">
                                                    <label class="form-label"
                                                        for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                                </div>
                                                @foreach ($formInputs->FormMultipleInput as $multipleInput)
                                                    <div class="sectionlabel mb-3">
                                                        <input class="form-check-input"
                                                            type="{{ $formInputs->InputType->type }}"
                                                            name="{{ $formSections->sec_id }}[{{ $formInputs->id }}][]"
                                                            value="{{ $multipleInput->label }}">
                                                        <label class="form-check-label"
                                                            for="{{ $multipleInput->label }}">{{ $multipleInput->label }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-2 d-flex justify-content-sm-around align-items-center">
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="editInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-pencil-square-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-trash-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($formInputs->inputType->name == 'select')
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="label">
                                                    <label class="form-label"
                                                        for="{{ $formInputs->label }}">{{ $formInputs->label }}</label>
                                                </div>
                                                <select class="form-select" name="" id=""
                                                    @readonly(true)>
                                                    @foreach ($formInputs->FormMultipleInput as $multipleInputs)
                                                        <option value="">{{ $multipleInputs->label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 d-flex justify-content-sm-around align-items-center">
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="editInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-pencil-square-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-trash-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($formInputs->inputType->name == 'rating'|| $formInputs->inputType->name == 'goal' || $formInputs->inputType->name == 'competency' || $formInputs->inputType->name == 'responsibility' || $formInputs->inputType->name == 'development')
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="row justify-content-center" id="ratingPreview">
                                                    <?php $no = 1; ?>
                                                    @foreach ($formInputs->RatingsData->ratingScaleOption as $ratingoption)
                                                        <div class="col-auto text-center">
                                                            <h5 class="text-wrap">{{ $ratingoption->option_label }}</h5>
                                                            <div>
                                                                <label for="rating{{ $no }}"
                                                                    class="border rounded-circle rating-circle">{{ $no }}</label>
                                                                <input type="radio" name="{{ $formInputs->label }}"
                                                                    class="opacity-0" id="rating{{ $no }}">

                                                            </div>
                                                        </div>
                                                        <?php $no++; ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex justify-content-sm-around align-items-center">
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="editInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-pencil-square-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        onclick="deleteInputs(this,{{ $formInputs->id }});return false;"><i
                                                            class="fa fa-trash-o" style="font-size: xx-large"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </section>
                @endforeach
                <div class="row mt-3 ">
                    <div class="col-6">
                        <a href="{{ route('admin.questionnaire') }}" class="btn btn-primary"> Back</a>
                    </div>
                    <div class="mb-3 col-6 text-end">
                        <button class="btn btn-primary" type="submit">Save<i
                                class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                                style="display:none;"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page-js-script')
    <script>
        function addsection(e, id) {
            var url = "{{ route('admin.questionnaire-add-section') }}";
            if (confirm("Are You sure want to add new sction!")) {
                let category = prompt("Please enter category:", " ");
                if (category == null || category == "") {
                    toastr.info('Please fill the category', 'Info');
                    return;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'id': id,
                        'categoory': category
                    },
                    success: function(res) {
                        if (res.success == 1) {
                            toastr.success(res.message, 'Success');
                            location.reload();
                        }
                    },
                    error: function(data) {
                        if (typeof data.responseJSON.status !== 'undefined') {
                            toastr.error(data.responseJSON.error, 'Error');
                        } else {
                            $.each(data.responseJSON.errors, function(key, value) {
                                toastr.error(value, 'Error');
                            });
                        }
                        // console.log('Error:', data);
                    }
                });
            }

        }

        function removesection(e, id) {

            var url = "{{ route('admin.questionnaire-delete-section') }}";
            if (confirm("Are You sure want to delete permanently this!")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'id': id
                    },
                    success: function(res) {
                        if (res.success == 1) {
                            toastr.success(res.message, 'Success');
                            location.reload();
                        }
                    },
                    error: function(data) {
                        if (typeof data.responseJSON.status !== 'undefined') {
                            toastr.error(data.responseJSON.error, 'Error');
                        } else {
                            $.each(data.responseJSON.errors, function(key, value) {
                                toastr.error(value, 'Error');
                            });
                        }
                        // console.log('Error:', data);
                    }
                });
            }

            // var parentDiv = e.closest('.multipleSections');
            // parentDiv.remove();
        }

        function addInput(e, id) {

            var contentUrl = "{{ route('admin.questionnaire-add-sectionInput') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                type: "POST",
                url: contentUrl,
                data: {
                    'sectionId': id,
                    'formId': $('#formId').val(),
                },
                success: function(data) {
                    $(".modal-body-data").html(data);
                    $("#bs-example-modal-lg").modal("show");
                },
                error: function() {
                    alert("Failed to load content.");
                }
            });
        }

        function editInputs(e, id) {
            var contentUrl = "{{ route('admin.questionnaire-edit-inputs') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {
                    'id': id,
                },
                success: function(data) {
                    $(".modal-body-data").html(data);
                    $("#bs-example-modal-lg").modal("show");
                },
                error: function() {
                    alert("Failed to load content.");
                }
            });
        }


        function deleteInputs(e, id) {
            var url = "{{ route('admin.questionnaire-delete-input') }}";
            if (confirm("Are You sure want to delete permanently this!")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'id': id
                    },
                    success: function(res) {
                        toastr.success(res.message, 'Success');
                        location.reload();
                    },
                    error: function(data) {
                        if (typeof data.responseJSON.status !== 'undefined') {
                            toastr.error(data.responseJSON.error, 'Error');
                        } else {
                            $.each(data.responseJSON.errors, function(key, value) {
                                toastr.error(value, 'Error');
                            });
                        }
                        // console.log('Error:', data);
                    }
                });
            }
        }

        function formSubmit(e) {
            var formHeading = $('.form_heading').val();
            //  var formSection = $(e).closest('.multipleSections').find('.formSection').val();
            var formSection = $(e).find('.multipleSections').find('.formSection').val();

            if ((formHeading.trim() !== '') && (formSection.trim() !== '')) {
                $('#formSubmit').find('.st_loader').show();
                event.preventDefault();
                var formData = new FormData($('#formSubmit')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.questionnaire-stor') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == 1) {
                            //  table.ajax.reload(); 
                            //  toastr.success(response.message, 'Success');
                            toastr.success("Inserted successfully.", 'Success');
                            location.reload(true);
                        } else {
                            toastr.error("Find some error", 'Error');
                            $('#formSubmit').find('.st_loader').hide();
                        }


                    },
                    error: function(xhr, status, error) {
                        $('#formSubmit').find('.st_loader').hide();
                        var $err = ''
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $err = $err + value + "<br>"
                        })
                        toastr.error($err, 'Error')
                    }
                });
            } else {
                alert("Form Field can not be empty!")
            }
        }
    </script>
@endsection
