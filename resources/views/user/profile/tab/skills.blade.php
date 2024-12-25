<style>
    .delete {
        visibility: hidden;
    }

    .box:hover .delete {
        visibility: visible;
    }
</style>
<div class="row my-4">
    <div class="col-3">
        <?php
        if (isset($uinfo->Image->file) && $uinfo->Image->file != '') {
            $image_url = url('/upload/employee/' . $uinfo->Image->file);
        } else {
            $image_url = url('upload/employee/demo.jpg');
        }
        ?>
        <img src="{{ $image_url }}" class="img-thumbnail" style="height: 160px; width: 185px;">


    </div>
    <div class="col-9 my-2">
        <h2 class="my-2" style="">{{ $uinfo->name }}</h2>
        <div class="my-1">
            <span class="card-text my-2"><i class="fa fa-phone" aria-hidden="true"></i>{{ $uinfo->phone_number }}</span>
            <span class=""><i class="fa fa-envelope" aria-hidden="true"></i>{{ $uinfo->email }}</span>
        </div>

        <a href=" {{ route('employee_profileedit') }}" class="btn btn-success"><i class="la-user-edit la"></i>Edit
            Info</a>
        <button type="button" onclick=addForm(this);return;false; class = "btn btn-primary waves-effect waves-light">
            <i class="bx bxs-plus-square"></i>Upload Profile Image</button>
        <a href="javascript:void(0)" onclick="deleteRow(this);" class="btn btn-warning">
            <i class="bx bxs-plus-square"></i>Delete Profile Image</a>
    </div>
</div>

<div class="card" style="box-shadow: none !important;">
    <div class="card-header mt-3 mb-3 border">
        <h3 class="" >My Skills</h3>
    </div>
    <div class="card-body">
        <div class="text-end mb-2">
            <a href="javascript:void(0)" onclick="(addskill(this))"><i class="fa fa-plus-circle" aria-hidden="true"
                    style="font-size: xx-large"></i></a>
        </div>
        <div class="row row-cols-4 g-1" id="allSkills">
            @foreach ($skills as $key => $skill)
                @if ($key <= 7)
                    <div class="col">
                        <div class="border border-success p-2 text-center box ">
                            {{ $skill->skills }}
                            <span class="delete"><a href="javascript:void(0)" onclick="deleteSkillRow({{$skill->id}});return;false;"><i
                                        class="fa fa-trash text-dark" aria-hidden="true"></i> </a></span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>


<script>
    function addForm(e) {
        var contentUrl = "{{ route('add_image') }}";
        $.ajax({
            type: "GET",
            url: contentUrl,
            success: function(data) {
                $(".modal-body-data").html(data);
                $("#bs-example-modal-lg").modal("show");
            },
            error: function() {
                alert("Failed to load content.");
            }
        });
    }

    function addskill(e) {
        var contentUrl = "{{ route('employee.add_skill') }}";
        $.ajax({
            type: "GET",
            url: contentUrl,
            success: function(data) {
                $(".modal-body-data").html(data);
                $("#bs-example-modal-lg").modal("show");
            },
            error: function() {
                alert("Failed to load content.");
            }
        });
    }

    function deleteRow(e) {

        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: "{{ route('imagedestroy') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "Get",
                data: {},
                success: function(data, msg) {
                    //  alert();
                    if (data.status == 1) {
                        toastr.success(data.msg, 'Success');
                        window.location.reload(true);
                        dataTable.draw(false);

                    } else if (data.status == 0) {

                        var $err = '';
                        toastr.error(data.msg, 'error');

                    }

                },

            });
        } else {
            return false;
        }
    }

    function deleteSkillRow(e) {

        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: "{{ route('employee.remove_skill') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    id:e
                },
                success: function(data) {
                    //  alert();
                    if (data.status == 1) {
                        toastr.success(data.msg, 'Success');
                        $("#allSkills").html(data.skills)

                    } else if (data.status == 0) {

                        var $err = '';
                        toastr.error(data.msg, 'error');

                    }

                },

            });
        } else {
            return false;
        }
    }

    function formSubmit(e) {
        $('#formSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmit')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('employee.store_skill') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 1) {
                    toastr.success(response.msg, 'Success');
                    $('#formSubmit').find('.st_loader').hide();
                    $("#bs-example-modal-lg").modal("hide");
                    $("#allSkills").html(response.skills)

                } else if (response.status == 2) {
                    toastr.info(response.msg, 'Info');
                    $('#formSubmit').find('.st_loader').hide();
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
