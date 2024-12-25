<div class="row my-4">
    <div class="col-12">
        {{-- <div class="card"> --}}
            {{-- <div class="card-body">  --}}
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Disciplinary Letter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            {{-- </div> --}}
        {{-- </div> --}}

    </div>
</div>

     <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
     {{-- <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script> --}}

 <script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.table = $('#datatable').DataTable({
        ajax: {
            "url": "{{route('disciplinary.list')}}",
            "type": "POST",
            "dataType": "json",

        },
        "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": true,
        @if (auth('web')->user()->hasPermissionTo('create-disciplinary'))
            initComplete: function() {
                $("div.dataTables_length")
                    // .html('<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>');
                    },
                    @endif
        columnDefs: [
            {
                targets: 0,
                mData: 'title'
            },    
            {
                targets: 1,
                mData: 'pdf'
            },
            {
                targets: 2,
                mData: 'action'
            }

        ]
    }); 
   
});

function addForm(e) {
    var contentUrl = "{{route('disciplinary.create')}}";
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




function formSubmit(e) {
    $('#formSubmit').find('.st_loader').show(); 
    event.preventDefault();
    var formData = new FormData($('#formSubmit')[0]);
    $.ajax({
        type: 'POST',
        url: "{{ route('disciplinary.store') }}",
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
