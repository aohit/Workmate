@extends('user.layouts.app')

@section('content')
    <div class="card">
        <form id="formSubmit" onsubmit="formSubmit(this);return false;">
            @csrf

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <input type="hidden" name="id" value="{{$goal->id}}">
                            <input type="hidden" name="userId" value="{{$userId}}">
                            <div class="row">
                                <div class="progress-container my-2" >
                                    <div class="progress ">
                                        <div class="progress-bar text-dark" role="progressbar"  id="totalkeyresult" aria-valuenow="100"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span id="totalkeyresultspan"></span>
                                </div>
                                <input type="hidden" name="totalkeypregressbar" id="totalkeypregressbar" value="">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="validationCustom01" placeholder="Title"
                                        name="title" value="{{ $goal->title }}" />
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="">-Select-</option>
                                        @foreach ($goalstatuses as $goalstatus)
                                            <option value="{{ $goalstatus->id }}" @selected($goalstatus->id == $goal->status)>
                                                {{ $goalstatus->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Review Cycle</label>
                                    <select class="form-select" name="reviewcycle">
                                        <option value="">-Select-</option>
                                        @foreach ($reviewcycles as $reviewcycle)
                                            <option value="{{ $reviewcycle->id }}" @selected($reviewcycle->id == $goal->review_cycle)>
                                                {{ $reviewcycle->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Category</label>
                                    <select class="form-select" name="category">
                                        <option value="">-Select-</option>
                                        @foreach ($goalcategories as $goalcategory)
                                            <option value="{{ $goalcategory->id }}" @selected($goalcategory->id == $goal->category)>
                                                {{ $goalcategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="validationCustom01" placeholder="Description..." name="description">{{ $goal->description }} </textarea>

                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom03" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="validationCustom03"
                                        placeholder="End Date" name="end_date" value="{{ $goal->deadline }}" />
                                </div>
                                <input type="hidden" id="timeData" name="time" value="{{ $goal->time }}">
                                <div>
                                    <button type="button" onclick="addkey(this)"
                                        class="btn btn-info waves-effect waves-light float-end mb-2">Add Key
                                        Result</button>
                                </div>
                            </div>

                            <div class="row" id="progresKey">
                                <input type="hidden" id="totalkeies" value="{{count($keyresults)}}">
                                @foreach ($keyresults as $keyresult)
                                <input type="hidden" class="keyprogress" value="{{$keyresult->total_progress}}">
                                    <div class="container border mt-4 p-2">
                                        <div class="milestone-container ">
                                            <div class="row d-flex">
                                                <div class="col icon">
                                                    <i class="fas fa-key"></i>
                                                    {{ $keyresult->title }}
                                                </div>
                                                <div class="col  milestone-actions text-end">
                                                    <span>
                                                        <a href="javascript:void(0)"
                                                            onclick="editkey({{ $keyresult->id }})"> <i
                                                                class="fas fa-pencil-alt"></i> </a>
                                                    </span>
                                                    <span>
                                                        <a href="javascript:void(0)"
                                                            onclick="deletekey({{ $keyresult->id }})"> <i
                                                                class="fas fa-trash"></i> </a>

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="progress-container">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $keyresult->total_progress }}%;"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="milestone-status m-1">
                                                <div class="row">
                                                    <div class="col">{{ $keyresult->traking }}</div>
                                                    <div class="col text-end">Complete - {{ $keyresult->total_progress }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row px-2 mb-2">
                <div class="col">
                   <a href="{{ route('goal',['id'=>base64_encode($userId)]) }}" class="btn btn-light">Close</a>
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
        function totalresultKey(){
            var totalkeies =  $('#totalkeies').val();
            var totalSum = 0;
            $('.keyprogress').each(function() {
  
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    totalSum += value;
                }
            });

            var totaltvalue =  Math.round((totalSum*100)/(totalkeies*100));
           $('#totalkeyresult').css("width",totaltvalue+'%');
           $('#totalkeyresultspan').text(totaltvalue + '%');
           $('#totalkeypregressbar').val(totaltvalue);
        }

        function addkey(e) {
            var contentUrl = "{{ route('addgoalkey') }}";
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
            var contentUrl = "{{ route('editgoalkey') }}";
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
                    url: "{{ route('deletegoalkey') }}",
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
                url: "{{ route('storegoalkey') }}",
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
                url: "{{ route('goal.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message, 'Success');
                         window.location.replace("{{ route('goal',['id'=>base64_encode($userId)]) }}");
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