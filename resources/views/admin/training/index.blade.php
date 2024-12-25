@extends('admin.layouts.app')

@section('content')


{{-- <div class="container-fluid">
    
    <!--<div class="row">-->
    <!--    <div class="col-12">-->
    <!--        <div class="card">-->
    <!--            <div class="card-body"> -->
    <!--             <div class="row">-->
    <!--                <div class="col-2">-->
    <!--                    <button class="btn btn-primary" type="submit" >New Item</button>-->
    <!--                </div>-->

    <!--             </div>-->
                 

    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</div> <!-- end row -->-->

</div> --}}

<div class="container-fluid p-0">
     
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>Sr.No</th> --}}
                                <th>Name</th>
                                <th>Department</th>
                                <th>Job Title</th>
                                <th>Item</th>
                                <th>Training Status</th>
                                <th>Training Objectives</th>
                                <th>State Time</th>
                                <th>Certificate</th>
                                <th>Completion Date</th>
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
             '<select class="form-select select2" name="department" onchange="filterDepartment(this)">' .
             '<option value="">Filter by Department</option>';
         
         foreach ($departments as $department) {
             $addButtonHtml .= '<option value="' . $department->id . '">' . $department->name . '</option>';
         }
         
         $addButtonHtml .= '</select>';

         $addButtonHtml .= '<button type="button" class="btn btn-outline-primary mx-1" onclick="exportFilteredData()">Export to Excel</button>';
    ?>
</div>
<?php 
// $addButtonHtml =
    //  '<button type="button" onclick="addForm(this);return false;" class="btn btn-outline-primary waves-effect waves-light">Add</button>';
?>
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
            "url": "{{route('admin.training-list')}}",
            "type": "POST",
            "dataType": "json",
            "data": function(d) {
                d.departmentId = $('#departmentId').val();  // Filter by department if applicable
            }
        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": true,
        initComplete: function() {
            $("div.dataTables_length").html('<?php echo $addButtonHtml; ?>'); // Custom buttons/filters
        },
        columnDefs: [
            {
                targets: 0,
                mData: 'name'
            },
            {
                targets: 1,
                mData: 'department_id'
            },
            {
                targets: 2,
                mData: 'job_title'
            },
            {
                targets: 3,
                mData: 'item'
            },
            {
                targets: 4,
                mData: 'trainingstatus'
            },
            {
                targets: 5,
                mData: 'trainingobject'
            },
            {
                targets: 6,
                mData: 'start_time'
            },
            {
                targets: 7,
                mData: 'certificate'
            },
            {
                targets: 8,
                mData: 'end_date'
            },
            {
                targets: 9,
                mData: 'action'
            }
        ],
        "createdRow": function(row, data, dataIndex) {
            // Ensure that no extra divs are added, only <tr> and <td> are being created.
            $(row).addClass('my-table-row');  // Optional: add a custom class to your rows if needed
        }
    });
});

function addForm(e) {
    var contentUrl = "{{route('admin.training-create')}}";
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

function filterDepartment(e) { 
       $departmentId =  $(e).val();
       $('#departmentId').val($departmentId);
       table.ajax.reload(); 
}

function exportFilteredData() {
    var departmentId = $('#departmentId').val();
    window.location.href = "{{ route('admin.my-training.export') }}" + "?departmentId=" + departmentId;
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


function formSubmit(e) {
    $('#formSubmit').find('.st_loader').show(); 
    event.preventDefault();
    var formData = new FormData($('#formSubmit')[0]);
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.training-store') }}",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {  
            if(response.success == 1){
                table.ajax.reload(); 
                toastr.success(response.message, 'Success');
                $('#formSubmit').find('.st_loader').hide();
                $("#bs-example-modal-lg").modal("hide"); 
            }else{
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

function changeStatus(e, id, url,status) {
   
   if (confirm("Are You sure want to delete this Row!")) {
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.ajax({
           url: url,
           type: "POST", 
           data:{'id':id, 'status':status},
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


