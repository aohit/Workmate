@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <table id="datatable" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Self-review</th>
                                <th>Deadline</th>
                                <th>Manager</th>
                                <th>Manager-review</th>
                                <th>Manager-deadline</th>
                                <th>Result Shared</th>
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
                "url": "{{route('admin.appraisal.list')}}",
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
                $("div.dataTables_length")
                    .html('<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>');
                    },
            columnDefs: [{
                    targets: 0,
                    mData: 'name'
                },
                {
                    targets: 1,
                    mData: 'self-review'
                },{
                    targets: 2,
                    mData: 'deadline'
                },{
                    targets: 3,
                    mData: 'manager'
                },{
                    targets: 4,
                    mData: 'manager-review'
                },{
                    targets: 5,
                    mData: 'manager-deadline'
                },{
                    targets: 6,
                    mData: 'resultshared'
                },{
                    targets: 7,
                    mData: 'status'
                },{
                    targets: 8,
                    mData: 'action'
                }
            ]
        });
    });

  function addForm(e) {

    $.ajax({
        type: "GET",
        url:  "{{route('admin.appraisal.create')}}",
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
        url: "{{ route('admin.appraisal.store') }}",
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

function editForm(id,url) {  
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

</script>
@endsection