@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Cycle Name</th>
                                    <th>Start Date</th>
                                    <th>Endt Date</th>
                                    <th>Status</th>
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
            '<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>' . ' ' .
                '<select id="yearFilter" class="form-select select2" name="department" onchange="filterByYear(this)">' .
                '<option value="">Filter Department</option>';
            
            foreach ($departments as $department) {
                $addButtonHtml .= '<option value="' . $department . '">' . $department. '</option>';
            }
            
            $addButtonHtml .= '</select>';
            
            $addButtonHtml .= '<button type="button" class="btn btn-outline-primary mx-1" onclick="exportFilteredData()">Export to Excel</button>';
        ?> 

    </div>
@endsection

@section('page-js-script')
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
    <script>
        function filterByYear(e) { 
            const year = $(e).val();
            $('#yearFilter').val(year);
                table.ajax.reload(); 
         }

        $(document).ready(function() {
            $('.select2').select2();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.table = $('#datatable').DataTable({
                ajax: {
                    "url": "{{ route('admin.review-cycle-list') }}",
                    "type": "POST",
                    "dataType": "json",
                    "data": function(d) {
                        d.departmentId = $('#departmentId').val();
                        d.year = $('#yearFilter').val();
                    },
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                "scrollX": true,
                "scrollCollapse": true,
                "autoWidth": true,
                initComplete: function() {
                    $("div.dataTables_length").html('<?php echo $addButtonHtml; ?>'); 
                    // $("div.dataTables_length")
                    //     .html(
                    //         '<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>'
                    //     );
                },
                columnDefs: [{
                        targets: 0,
                        mData: 'title'
                    },
                    {
                        targets: 1,
                        mData: 'start_date'
                    },
                    {
                        targets: 2,
                        mData: 'end_date'
                    }, {
                        targets: 3,
                        mData: 'status'
                    }, {
                        targets: 4,
                        mData: 'action'
                    },
                ]
            });
        });

        function addForm(e) {
            var contentUrl = "{{ route('admin.create-review-cycle') }}";
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

        // function filterDepartment(e) { 
        //    $departmentId =  $(e).val();
        //    $('#departmentId').val($departmentId);
        //    table.ajax.reload(); 
        // }


        function exportFilteredData() {
        var departmentId = $('#departmentId').val();
        var year = $('#yearFilter').val();
        window.location.href = "{{ route('admin.review-cycle.export') }}" +  "?year=" + year; 
        }     


        function editForm(e, id, url) {
            $.ajax({
                type: "POST",
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
                url: "{{ route('admin.store-review-cycle') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        table.ajax.reload();
                        toastr.success(response.message, 'Success');
                        $('#formSubmit').find('.st_loader').hide();
                        $("#bs-example-modal-lg").modal("hide");
                    } else if (response.success == 2) {
                        toastr.info(response.message, 'Inof');
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

        function changeStatus(e, id, url, status) {

            if (confirm("Are You sure want to change status!")) {
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
                        'status': status
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
                        //    console.log('Error:', data);
                    }
                });
            }
        }
    </script>
@endsection
