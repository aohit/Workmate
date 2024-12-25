<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{ $sub_title }}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmitkey" onsubmit="formSubmitkey(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id" value="{{$keyresult->id}}">
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom01" class="form-label">Key Result</label>
                                    <input type="text" class="form-control" id="validationCustom01"
                                        placeholder="Key Result" name="title" value="{{ $keyresult->title }}" />

                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label for="validationCustom02" class="form-label">Tracking</label>
                                    <select class="form-select" id="traking" name="traking" onchange="tracking(this)">
                                        <option value="Milestone" @if ($keyresult->traking == 'Milestone') selected @endif>
                                            Milestone</option>
                                        <option value="Quantifiable traget"
                                            @if ($keyresult->traking == 'Quantifiable traget') selected @endif>Quantifiable traget
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-12">
                                    <label for="validationCustom02" class="form-label">Progress</label>
                                    <div class="progress mb-0">
                                        <div class="progress-bar" role="progressbar" id="progressbar"
                                            style="width:{{ $keyresult->total_progress }}%" aria-valuenow="100"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check ms-2 checkbox">
                                <label class="form-check-label" for="checkmeout">
                                    <input type="checkbox" class="form-check-input" onclick="completed(this);"
                                        id="checkmeout" onc name="completprogess" value="1">
                                    Mark as done</label>
                            </div>
                            <input type="hidden" name="time" value="{{ $keyresult->time }}">
                            <div class="row tragetQuantiflable d-none">
                                <div class="mb-3 col-lg-4">
                                    <label for="validationCustom03" class="form-label">Start</label>
                                    <input type="number" class="form-control" id="startprogress"
                                        placeholder="Key Result" name="start" onblur="startprog(this)"
                                        value="{{ $keyresult->start }}" />

                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="validationCustom04" class="form-label">Target</label>
                                    <input type="number" class="form-control" id="targetprogress"
                                        placeholder="Key Result" name="target" onblur="targetprog(this)"
                                        value="{{ $keyresult->target }}" />

                                </div>
                                <div class="mb-3 col-lg-4">
                                    <label for="validationCustom05" class="form-label">Current</label>
                                    <input type="number" class="form-control" id="currentprogress"
                                        placeholder="Key Result" name="current" onblur="currentprog(this)"
                                        value="{{ $keyresult->current }}" />
                                </div>
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
    function tracking(e) {
        var trackingvalue = $('#traking').val();
        if (trackingvalue == "Milestone") {
            $(".tragetQuantiflable").addClass("d-none");
            $(".checkbox").removeClass("d-none");
            $("#progressbar").css("width", "0%");
            $('#currentprogress').val("");
            $('#startprogress').val("");
            $('#targetprogress').val("");
        } else if (trackingvalue == "Quantifiable traget") {
            $(".tragetQuantiflable").removeClass("d-none");
            $(".checkbox").addClass("d-none");
            $("#progressbar").css("width", "0%");
            $("#checkmeout").prop("checked", false);
        }
    }

    var trackingvalue = $('#traking').val();
    if (trackingvalue == "Milestone") {
        $(".tragetQuantiflable").addClass("d-none");
        $(".checkbox").removeClass("d-none");
        $('#currentprogress').val("");
        $('#startprogress').val("");
        $('#targetprogress').val("");
    } else if (trackingvalue == "Quantifiable traget") {
        $(".tragetQuantiflable").removeClass("d-none");
        $(".checkbox").addClass("d-none");
        $("#checkmeout").prop("checked", false);
    }

    function completed(e) {
        if ($(e).is(':checked'))
            $("#progressbar").css("width", "100%");
        else
            $("#progressbar").css("width", "0%");

    }

    function startprog(e) {
        var startprogess = $('#startprogress').val();
        var currentprogess = $('#currentprogress').val();
        var targetprogess = $('#targetprogress').val();

        $("#progressbar").attr("aria-valuemin", startprogess);

        if (currentprogess != "" && startprogess != "" && targetprogess != "") {
            var totalprogress = ((currentprogess - startprogess) / (targetprogess - startprogess)) * 100;
            $("#progressbar").css("width", totalprogress + '%');
        }
    }

    function targetprog(e) {
        var targetprogess = $('#targetprogress').val();
        var currentprogess = $('#currentprogress').val();
        var startprogess = $('#startprogress').val();

        $("#progressbar").attr("aria-valuemax", targetprogess);

        if (currentprogess != "" && startprogess != "" && targetprogess != "") {
            var totalprogress = ((currentprogess - startprogess) / (targetprogess - startprogess)) * 100;
            $("#progressbar").css("width", totalprogress + '%');
        }
    }

    function currentprog(e) {
        var currentprogess = $('#currentprogress').val();
        var startprogess = $('#startprogress').val();
        var targetprogess = $('#targetprogress').val();
        if (startprogess == "") {
            alert('Please fill start input');
        }
        if (targetprogess == "") {
            alert('Please fill target input');
        }
        if (currentprogess == "") {
            alert('Please fill current input');
        }
        $("#progressbar").attr("aria-valuemax", currentprogess);
        if (currentprogess != "" && startprogess != "" && targetprogess != "") {

            var totalprogress = ((currentprogess - startprogess) / (targetprogess - startprogess)) * 100;
            $("#progressbar").css("width", totalprogress + '%');
        }

    }
</script>
