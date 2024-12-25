 @extends('user.layouts.app')

 @section('content')
 <!-- <style>
    .dataTables_scrollHeadInner {
    width: 100% !important;
}
</style> -->
 <div class="container-fluid p-0">

     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body"> 
                     <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                         <thead>
                             <tr>
                                 <th>Name</th>
                                 <th>Department</th>
                                 <th>Email</th>
                                 <th>Roles</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>

                         </tbody>
                     </table>
                 </div>
             </div>
             <input type="hidden" id="departmentId" value="">
             <input type="hidden" id="roleId" value="">
         </div>
     </div> <!-- end row -->
     <?php
    //  $addButtonHtml =
    //      '<button type="button" onclick="addForm(this);return false;" class="btn btn-outline-primary waves-effect waves-light">Add</button>' . ' ' .
    //      '<select class="form-select" name="department" onchange="filterDepartment(this)">' .
    //      '<option value="">Filter Department</option>';
     
    //  foreach ($departments as $department) {
    //      $addButtonHtml .= '<option value="' . $department->id . '">' . $department->name . '</option>';
    //  }
     
    //  $addButtonHtml .= '</select>';
    $addButtonHtml =
                '<button type="button" onclick=addForm(this);return;false; class="btn btn-outline-primary waves-effect waves-light"> Add </button>' . ' ' .
                '<select class="form-select" name="department" onchange="filterDepartment(this)">' .
                '<option value="">Filter Department</option>';

            foreach ($departments as $department) {
                $addButtonHtml .= '<option value="' . $department->id . '">' . $department->name . '</option>';
            }

            $addButtonHtml .= '</select>' . ' ';

            $addButtonHtml .= 
                '<select class="form-select" name="role" onchange="filterRole(this)">' .
                '<option value="">Filter Role</option>';

            foreach ($roles as $role) {
                $addButtonHtml .= '<option value="' . $role->id . '">' . $role->name . '</option>';
            }

            $addButtonHtml .= '</select>';
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
                 "url": "{{route('employee.list')}}",
                 "type": "POST",
                 "dataType": "json",
                 "data": function(d) {
                        d.departmentId = $('#departmentId').val();
                        d.roleId = $('#roleId').val();
                    },
             },
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": true, 
            "lengthMenu": [10, 20, 30],
            "pageLength": 10,
             initComplete: function() { 
                 $("div.dataTables_length").html('<?php echo $addButtonHtml; ?>'); 
             },
             columnDefs: [{
                     targets: 0,
                     mData: 'name'
                 },
                 {
                     targets: 1,
                     mData: 'department'
                 },
                 {
                     targets: 2,
                     mData: 'email'
                 },
                 {
                     targets: 3,
                     mData: 'roles'
                 },
                 {
                     targets: 4,
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

    function filterRole(e) { 
       $roleId =  $(e).val();
       $('#roleId').val($roleId);
       table.ajax.reload(); 
    }


     function addForm(e) {
         var contentUrl = "{{route('employee.create')}}";
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

     function showForm(e, id, url) {
        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
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

     function formSubmit(e) {
         $('#formSubmit').find('.st_loader').show();
         event.preventDefault();
         var formData = new FormData($('#formSubmit')[0]);
         $.ajax({
             type: 'POST',
             url: "{{ route('employee.store') }}",
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
                    //  console.log('Error:', data);
                 }
             });
         }
     }

     
     
 </script>
 @endsection