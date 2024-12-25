@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <h3>Manage Rating Scales</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. no.</th>
                                    <th>Name</th>
                                    <th>Includes N/A</th>
                                    <th>Appearance</th>
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
                    "url": "{{ route('admin.rating-scales.list') }}",
                    "type": "post",
                    "dataType": "json",
                    "data": function(d) {
                        // d.departmentId = $('#departmentId').val();
                    },
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                "scrollX": true,
                "scrollCollapse": true,
                "autoWidth": true, // Enable auto width
                initComplete: function() {
                    $("div.dataTables_length")
                        .html(
                            '<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add Rating Scale </button>'
                        );
                },
                columnDefs: [{
                        targets: 0,
                        mData: 'DT_RowIndex'
                    },
                    {
                        targets: 1,
                        mData: 'name'
                    }, {
                        targets: 2,
                        mData: 'include_na'
                    }, {
                        targets: 3,
                        mData: 'display_type'
                    }, {
                        targets: 4,
                        mData: 'action'
                    }
                ]
            });
        });

        function addForm(e) {

            $.ajax({
                type: "GET",
                url: "{{ route('admin.rating-scalescreate') }}",
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
                type: 'post',
                url: $(e).attr('action'),
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
                        toastr.error("Something wrong found! Please try again. ", 'Error');
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

        function editForm(id, url) {
            $.ajax({
                type: "get",
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

        function destroyForm(id, url) {
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    table.ajax.reload();
                    toastr.success(data.message, 'Success');
                },
                error: function() {
                    alert("Failed to delete rating scale.");
                }
            });
        }
    </script>
@endsection
