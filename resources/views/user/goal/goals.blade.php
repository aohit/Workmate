
{{-- <div class="container-fluid"> --}}
    
    <div class="row my-4">
        <div class="col-12">
            {{-- <div class="card"> --}}
                {{-- <div class="card-body">  --}}
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Goal</th>
                                <th>Review Cycle</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                {{-- </div> --}}
            {{-- </div> --}}

        </div>
    </div> <!-- end row -->

{{-- </div> --}}
<?php 
$url = route('goal.create',[ 'id' => base64_encode($id) ]);
       $addButtonHtml =
            '<a href="'. $url .'" class="btn btn-outline-primary waves-effect waves-light">Add</a>';
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
           "url": "{{route('goal.list')}}",
           "type": "POST",
           "dataType": "json",
            "data":{'id':{{$id}}
              
            }

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
               mData: 'title'
           },
           {
               targets: 1,
               mData: 'review_cycle'
           },
           {
               targets: 2,
               mData: 'type'
           },{
               targets: 3,
               mData: 'status'
           },{
               targets: 4,
               mData: 'progressbar'
           },
           {
               targets: 5,
               mData: 'duedate'
           },
           {
               targets: 6,
               mData: 'action'
           }

       ]
   }); 
  
});

function showForm(e, id, url) {
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

function addForm(e) {
   var contentUrl = "{{route('goal.create')}}";
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
       url: "{{ route('goal.store') }}",
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
        //    console.log('Error:', data);
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
            //   console.log('Error:', data);
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

    function activities(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('goalhistory') }}",
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
