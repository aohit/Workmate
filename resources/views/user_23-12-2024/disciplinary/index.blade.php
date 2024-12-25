 @extends('user.layouts.app')

 @section('content')


 <div class="container-fluid">
     
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body"> 
                     <table id="datatable" class="table table-bordered w-100">
                         <thead>
                             <tr>
                                 <th>Issue Date</th>
                                 <th>Title</th>
                                 <th>Employee</th>
                                 <th>Disciplinary Action Type</th>
                                 <th>Disciplinary Letter</th>
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
        //       '<select class="form-select select2" name="department" onchange="filterDepartment(this)">' .
        //       '<option value="">Filter Department</option>';
          
        //   foreach ($departments as $department) {
        //       $addButtonHtml .= '<option value="' . $department->id . '">' . $department->name . '</option>';
        //   }
          
        //   $addButtonHtml .= '</select>';
          
        //   $addButtonHtml .= '<button type="button" class="btn btn-outline-primary mx-1" onclick="exportFilteredData()">Export to Excel</button>';
     ?> 
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
            "url": "{{route('disciplinary.teamlist')}}",
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
            initComplete: function() {
                $("div.dataTables_length").html('<?php echo $addButtonHtml; ?>'); 
                // $("div.dataTables_length")
                    // .html('<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Issue Disciplinary Action  </button>');
                    },
        columnDefs: [
            {
                targets: 0,
                mData: 'issue_date'
            },    
            {
                targets: 1,
                mData: 'title'
            },    
            {
                targets: 2,
                mData: 'employee_id'
            },    
            {
                targets: 3,
                mData: 'action_type_id'
            },
            {
                targets: 4,
                 mData: 'pdf'
            },
            {
                targets: 5,
                mData: 'action'
            }

        ]
    }); 
   
});

function addForm(e) {
    var contentUrl = "{{route('disciplinary.teamcreate')}}";
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
    window.location.href = "{{ route('admin.disciplinary.export') }}" + "?departmentId=" + departmentId;
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
        url: "{{ route('disciplinary.teamstore') }}",
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
   
   if (confirm("Are You sure want to change status!")) {
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
            //    console.log('Error:', data);/
           }
       });
   }
   }
   function upload_cif_document(form,url,id,input)
    {
        $(form).find('.'+id+'_loader').show();
        $.ajax({
            type: "POST",
            url :url+'?type='+id, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            contentType: false,       
            cache: false,             
            processData:false,
            dataType: "json",
            data: new FormData (form[0]), 
            success: function(res)
            { 
                if(res.status == 0){
                    $(form).find('.'+id+'_loader').hide();
                    toastr.error(res.msg,'Error');
                }else{
                    $(form).find('.'+id+'_loader').hide();
                    $('#'+input).val(res.file_id);  
                }
            }
        });
    }

 </script>
 @endsection