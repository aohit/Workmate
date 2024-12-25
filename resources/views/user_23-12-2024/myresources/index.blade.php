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
                                 <th>Document Name</th>
                                 <th>Category</th>
                                 <th>Date Uploaded</th>
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
            "url": "{{ route('resources.list')}}",
            "type": "POST",
            "dataType": "json",
            "data": function(d) {
                d.filter = {
                    // name: $('#nameFilter').val(),
                    // category: $('#categoryFilter').val(),
                };
            }
        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": true,  
        @if(auth('web')->user()->hasPermissionTo('add-delete-my-resources'))
            initComplete: function() {
                $("div.dataTables_length")
                    .html('<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>');
                    },
        @endif             
        columnDefs: [{
                targets: 0,
                mData: 'file_name'
            },
            {
                targets: 1,
                mData: 'category'
            },
            {
                targets: 2,
                mData: 'date_uploaded'
            },
            {
                targets: 3,
                mData: 'action'
            }

        ]
    }); 
   
});

function addForm(e) {
    var contentUrl = "{{route('resources.create')}}";
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


function formSubmit(e) {
    $('#formSubmit').find('.st_loader').show(); 
    event.preventDefault();
    var formData = new FormData($('#formSubmit')[0]);
    $.ajax({
        type: 'POST',
        url: "{{ route('resources.store') }}",
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
            var $err = '';
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