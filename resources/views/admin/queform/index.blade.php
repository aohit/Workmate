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
                                    <th>Title</th>
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

    </div>
@endsection


@section('page-js-script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.table = $('#datatable').DataTable({
                ajax: {
                    "url": "{{ route('admin.questionnaire-list') }}",
                    "type": "POST",
                    "dataType": "json",

                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                "scrollX": true,
                "scrollCollapse": true,
                "autoWidth": true,
                initComplete: function() {
                    $("div.dataTables_length")
                        .html(
                            "<a href='{{ route('admin.questionnaire-create') }}' class ='btn btn-outline-primary waves-effect waves-light' ><i class='fa fa-plus' aria-hidden='true'></i> Create New </a>"
                            );
                },
                columnDefs: [{
                        targets: 0,
                        mData: 'title'
                    },
                    {
                        targets: 1,
                        mData: 'status'
                    },
                    {
                        targets: 2,
                        mData: 'action'
                    }

                ]
            });

        });

        function addForm(e) {
            var contentUrl = "{{ route('admin.leave.create') }}";
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

        function rejectView(reqId) {
            var url = "{{ route('admin.leave.comment') }}"
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'reqId': reqId
                },
                success: function(res) {
                    $(".modal-body-data").html(res);
                    $("#bs-example-modal-lg").modal("show");
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

            if (confirm("Are You sure want to chage status!")) {
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
                         alert("Failed to load content.");
                    }
                });
            }
        }

function replica(e, id, url,) {

    if (confirm("Are You sure want to copy this!")) {
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
                if(res.success == 1){
                    toastr.success(res.message, 'Success');
                    table.ajax.reload();
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
                 console.log('Error:', data);
            }
        });
    }
}

    </script>
@endsection
