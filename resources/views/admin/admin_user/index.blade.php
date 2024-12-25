 @extends('admin.layouts.app')

 @section('content')


 <div class="container-fluid">
      
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body"> 
                     <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                         <thead>
                             <tr>
                                 <th>Name</th>
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

         </div>
     </div> <!-- end row -->

 </div>
 @endsection

 @section('page-js-script')
 <script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table = $('#datatable').DataTable({
            ajax: {
                "url": "{{route('admin.admin_user.list')}}",
                "type": "POST",
                "dataType": "json",

            },
           
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
            initComplete: function() {
                $("div.dataTables_length")
                    .html('<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>');
                    },
                    "bLengthChange": true,
                    "lengthMenu": [10, 25, 50, 100],
                    columnDefs: [{
                            targets: 0,
                            mData: 'name'
                        },
                        {
                            targets: 1,
                            mData: 'email'
                        },
                        {
                            targets: 2,
                            mData: 'roles'
                        },
                        {
                            targets: 3,
                            mData: 'action'
                        },


                    ]
            });


        function addForm(e) {
            var contentUrl = "{{route('admin.admin_user.create')}}";
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
                url: "{{ route('admin.admin_user.store') }}",
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
                        $('#formSubmit').find('.st_loader').hide();
                        toastr.error("Find some error", 'Error');
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
                        // console.log('Error:', data);
                    }
                });
            }
        }
 </script>
 @endsection