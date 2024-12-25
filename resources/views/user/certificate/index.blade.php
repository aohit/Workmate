@extends('user.layouts.app')

@section('content')

<div class="container-fluid p-0">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Employee </th>
                                <th>Certificate</th>
                                <th>Action</th>                               
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div> <!-- end row -->

    <input type="hidden" id="departmentId" value="">
    <?php
    $addButtonHtml =
        '<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>';
            //  '<select class="form-select select2" name="department" onchange="filterDepartment(this)">';
        //      '<option value="">Filter Department</option>';
         
        //  foreach ($departments as $department) {
        //      $addButtonHtml .= '<option value="' . $department->id . '">' . $department->name . '</option>';
        //  }
         
        //  $addButtonHtml .= '</select>';
    ?>
</div>
@endsection

@section('page-js-script')
<link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script>
   
    $(document).ready(function() {
        $('.select2').select2(); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        window.table = $('#datatable').DataTable({
            ajax: {
                "url": "{{route('certificate.list')}}",
                "type": "POST",
                "dataType": "json",
                "data": function(d) {
                        // d.departmentId = $('#departmentId').val();
                    },
            },
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
            "scrollX": true,
            "scrollCollapse": true,
            "autoWidth": true, 
            initComplete: function() {
                // $("div.dataTables_length").html('<?php echo $addButtonHtml; ?>'); 
                    },
            columnDefs: [{
                    targets: 0,
                    mData: 'user_id'
                },
                {
                    targets: 1,
                    mData: 'file'
                },{
                    targets: 2,
                    mData: 'action'
                }
               
            ]
        });
    });

    function filterDepartment(e) { 
       $departmentId =  $(e).val();
       $('#departmentId').val($departmentId);
       table.ajax.reload(); 
    }

    function addForm(e) {
        var contentUrl = "{{route('certificate.create')}}";
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

    function editForm(e, id, url) {
        $.ajax({
            type: "GET",
            url: url,
            data: {
                'id': id
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

    function showForm(e, id, url) {
        $.ajax({
            type: "GET",
            url: url,
            data: {
                'id': id
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

    function formSubmit(e) {
        $('#formSubmit').find('.st_loader').show();
        event.preventDefault();
        var formData = new FormData($('#formSubmit')[0]);
        $.ajax({
            type: 'POST',
            url: "{{ route('certificate.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success == 1) {
                    table.ajax.reload();
                    toastr.success(response.message, 'Success');
                    $('#formSubmit').find('.st_loader').hide();
                    $("#bs-example-modal-lg").modal("hide");
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

    function deleteRow(e, id, url) {
        if (confirm("Are You sure want to delete this Row!")) {
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
                    table.ajax.reload();
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



 
</script>
@endsection