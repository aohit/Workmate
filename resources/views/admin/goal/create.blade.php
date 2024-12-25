@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <form id="formSubmit" onsubmit="formSubmit(this);return false;">
            @csrf

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="progress-container my-2">
                                    <div class="progress ">
                                        <div class="progress-bar text-dark" role="progressbar" id="totalkeyresult"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span id="totalkeyresultspan"></span>
                                </div>
                                <input type="hidden" name="totalkeypregressbar" id="totalkeypregressbar" value="">
                                <div class="mb-3 col-sm-4">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="Title"
                                        name="title" />
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="validationCustom02" class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">-Select-</option>
                                        @foreach ($goalstatuses as $goalstatus)
                                            <option value="{{ $goalstatus->id }}">{{ $goalstatus->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="validationCustom02" class="form-label">User</label>
                                    <select class="form-select" name="user">
                                        <option value="">-Select-</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="validationCustom02" class="form-label">Review Cycle</label>
                                    <select class="form-select" name="reviewcycle">
                                        <option value="">-Select-</option>
                                        @foreach ($reviewcycles as $reviewcycle)
                                            <option value="{{ $reviewcycle->id }}">{{ $reviewcycle->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="validationCustom02" class="form-label">Category</label>
                                    <select class="form-select" name="category">
                                        <option value="">-Select-</option>
                                        @foreach ($goalcategories as $goalcategory)
                                            <option value="{{ $goalcategory->id }}">{{ $goalcategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-4">
                                    <label for="validationCustom03" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="validationCustom03"
                                        placeholder="End Date" name="end_date" />
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom01" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="validationCustom01" placeholder="Description..." name="description"> </textarea>

                                </div>
                                <input type="hidden" id="timeData" name="time" value="{{ time() }}">
                                <div>
                                    <button type="button" onclick="addkey(this)"
                                        class="btn btn-info waves-effect waves-light float-end mb-2">Add key
                                        Result..</button>
                                </div>
                            </div>

                            <div class="row" id="progresKey">

                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row px-2 mb-2">
                <div class="col">
                    <a href="{{ route('admin.goal') }}" class="btn btn-light">Close</a>
                </div>
                <div class="col text-end">
                    <button class="btn btn-primary" type="submit">Save<i
                            class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw"
                            style="display:none;"></i></button>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection

@section('page-js-script')
    <script src="{{ asset('assets/js/pages/form-pickers.init.js') }}"></script>
    <script>
        totalresultKey();

        function totalresultKey() {

            var totalkeies = $('#totalkeies').val();
            var totalSum = 0;
            $('.keyprogress').each(function() {

                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    totalSum += value;
                }
            });

            var totaltvalue = (totalSum * 100) / (totalkeies * 100);
            $('#totalkeyresult').css("width", totaltvalue + '%');
            $('#totalkeyresultspan').text(totaltvalue + '%');
            $('#totalkeypregressbar').val(totaltvalue);
        }

        function addkey(e) {
            var contentUrl = "{{ route('admin.addgoalkey') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {
                    'time': $('#timeData').val()

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

        function editkey(e) {
            var contentUrl = "{{ route('admin.editgoalkey') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: contentUrl,
                data: {
                    'time': $('#timeData').val(),
                    'id': e,

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

        function deletekey(id) {

            if (confirm("Are You sure want to delete this Row!")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.deletegoalkey') }}",
                    type: "POST",
                    data: {
                        'id': id
                    },
                    success: function(res) {
                        toastr.success(res.message, 'Success');
                        $("#progresKey").html(res.view);
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



        function formSubmitkey(e) {
            $('#formSubmitkey').find('.st_loader').show();
            event.preventDefault();
            var formData = new FormData($('#formSubmitkey')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.storegoalkey') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                        $('#formSubmitkey').find('.st_loader').hide();
                        $("#bs-example-modal-lg").modal("hide");
                        $("#progresKey").html(response.view);
                        totalresultKey();
                    } else {
                        toastr.error("Find some error", 'Error');
                        $('#formSubmitkey').find('.st_loader').hide();
                    }


                },
                error: function(xhr, status, error) {
                    $('#formSubmitkey').find('.st_loader').hide();
                    var $err = ''
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $err = $err + value + "<br>"
                    })
                    toastr.error($err, 'Error')
                }
            });
        }

        function formSubmit(e) {
            $('#formSubmit').find('.st_loader').show();
            event.preventDefault();
            var formData = new FormData($('#formSubmit')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.goal.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                        window.location.replace("{{ route('admin.goal') }}");
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
        }
    </script>
@endsection
