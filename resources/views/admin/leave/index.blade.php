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
                                <th>Employee</th>
                                 <th>Leave Type</th> 
                                 <th>Start Date</th> 
                                 <th>End Date</th> 
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
            "url": "{{route('admin.leave.list')}}",
            "type": "POST",
            "dataType": "json",

        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": true,
            initComplete: function() {
                $("div.dataTables_length")
                    .html("<a href='{{route('admin.leave.create')}}' class ='btn btn-outline-primary waves-effect waves-light' > Add </a>");
                    },
        columnDefs: [{
                targets: 0,
                mData: 'employee'
            },
            {
                targets: 1,
                mData: 'leave_type'
            },
            {
                targets: 2,
                mData: 'start_date'
            },
            {
                targets: 3,
                mData: 'end_date'
            },
            {
                targets: 4,
                mData: 'status'
            },
            {
                targets: 5,
                mData: 'action'
            }

        ]
    }); 
   
});

function addForm(e) {
    var contentUrl = "{{route('admin.leave.create')}}";
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
        data:{'id':id},
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
        var url = "{{route('admin.leave.comment')}}"
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: "POST", 
        data:{'reqId':reqId},
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
        data:{'id':id},
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