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
                                 <th>Title</th>
                                 <th>Status</th>
                                 <th>Assing</th>
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
            "url": "{{route('task-list')}}",
            "type": "POST",
            "dataType": "json",

        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": true, 
            initComplete: function() {
                @if(auth('web')->user()->hasPermissionTo('add-task'))
                $("div.dataTables_length")
                    .html('<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>');
                @endif
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
                mData: 'assing'
            }, {
                targets: 3,
                mData: 'action'
            }

        ]
    }); 
   
});

function addForm(e) {
    var contentUrl = "{{route('task-create')}}";
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
        type: "POST",
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

function changedStatus(e, id, url) {  
    $.ajax({
        type: "POST",
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
        url: "{{ route('task-stor') }}",
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

function storeStatus(e) {
    $('#formSubmit').find('.st_loader').show(); 
    event.preventDefault();
    var formData = new FormData($('#formSubmit')[0]);
    $.ajax({
        type: 'POST',
        url: "{{ route('status-store') }}",
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