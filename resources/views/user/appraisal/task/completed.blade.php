
<table id="datatable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Review-cycle</th>
            <th>Deadline</th>
            <th>Updated Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

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
                    "url": "{{ route('user.appraisal.completedlist') }}",
                    "type": "POST",
                    "dataType": "json",
                    "data": function(d) {
                        d.departmentId = $('#departmentId').val();
                    },
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                "scrollX": true,
                "scrollCollapse": true,
                "autoWidth": true,
                // initComplete: function() {
                //     // @if (auth('web')->user()->hasPermissionTo('creat-appraisal'))
                //     //     $("div.dataTables_length").html(
                //     //         '<button type="button" onclick="addForm(this);return false;" class="btn btn-outline-primary waves-effect waves-light">Add</button>'
                //     //     );
                //     // @endif
                // },
                columnDefs: [{
                        targets: 0,
                        mData: 'name'
                    },
                    {
                        targets: 1,
                        mData: 'reviewcycle'
                    }, {
                        targets: 2,
                        mData: 'deadline'
                    }, {
                    targets: 3,
                    mData: 'updated_at'
                }, {
                        targets: 4,
                        mData: 'action'
                    }
                ]
            });
        });
</script>