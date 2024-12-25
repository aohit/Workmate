<div class="row my-4">
    <div class="col-12">
        {{-- <div class="card"> --}}
        {{-- <div class="card-body">  --}}
        <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
        {{-- </div> --}}
        {{-- </div> --}}

    </div>
</div> <!-- end row -->
<?php
$addButtonHtml = '<a href="' . route('admin.creatresponsibility') . '" class="btn btn-outline-primary waves-effect waves-light">Add</a>';
?>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        window.table = $('#datatable').DataTable({
            ajax: {
                "url": "{{ route('admin.goal.responsibility.list') }}",
                "type": "POST",
                "dataType": "json",

            },
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
            "scrollX": true,
            "scrollCollapse": true,
            "autoWidth": true,
            initComplete: function() {
                $("div.dataTables_length").html('<?php echo $addButtonHtml; ?>');
            },
            columnDefs: [{
                    targets: 0,
                    mData: 'user'
                },
                {
                    targets: 1,
                    mData: 'title'
                },
                {
                    targets: 2,
                    mData: 'status'
                }, {
                    targets: 3,
                    mData: 'progressbar'
                },
                {
                    targets: 4,
                    mData: 'action'
                }

            ]
        });

    });

    function deletedata(id) {

        if (confirm("Are You sure want to delete this Row!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.destoryresponsibility') }}",
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

    function activities(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('admin.responsibilityhistory') }}",
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
</script>
