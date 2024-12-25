
<table id="datatable" class="table table-bordered w-100 text-nowrap">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Response in</th>
            <th>Review Cycle</th>
            <th>Rating</th>
            <th>Action</th>
            <th>ManagerAverage final rating</th>
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
                    "url": "{{ route('user.goalreview.completedlist') }}",
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
                        mData: 'employee_id'
                    },
                    {
                        targets: 1,
                        mData: 'input_type_id'
                    },
                    {
                        targets: 2,
                        mData: 'review_cycle_id'
                    },
                    {
                        targets: 3,
                        mData: 'rating_id'
                    },
                    {
                        targets: 4,
                        mData: 'action'
                    },
                    {
                         targets: 5,
                        mData: 'manager_rating'
                    },
                ]
            });
        });
</script>