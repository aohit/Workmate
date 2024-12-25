@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="{{ route('goalPendingreview') }}"
                                    data-target="#tab1" role="tab" aria-controls="tab1"
                                    aria-selected="true">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2-tab" data-toggle="tab"
                                    href="{{ route('goalCompletedreview') }}" data-target="#tab2" role="tab"
                                    aria-controls="tab2" aria-selected="false">Completed</a>
                            </li>
                          </ul>
                        <div class="tab-content" id="myTabsContent">
                            <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="tab1-tab"></div>
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    "url": "{{ route('goal-review.list') }}",
                    "type": "POST",
                    "dataType": "json",
                    "data": function(d) {
                        // d.departmentId = $('#departmentId').val();
                    },
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                "scrollX": true,
                "scrollCollapse": true,
                "autoWidth": true,
                initComplete: function() {
                    $("div.dataTables_length")
                        .html(
                            // '<button type="button" onclick=addForm(this);return;false; class = "btn btn-outline-primary waves-effect waves-light" > Add </button>'
                        );
                },
                columnDefs: [{
                        targets: 0,
                        mData: 'employee_id'
                    },
                    {
                        targets: 1,
                        mData: 'input_type_id'
                    },
                    {
                        targets: 2,
                        mData: 'review_cycle_id'
                    },
                    {
                        targets: 3,
                        mData: 'rating_id'
                    },
                    {
                        targets: 4,
                        mData: 'action'
                    },
                ]
            });
        });

        function addForm(e) {
            var contentUrl = "{{ route('goal-review.create') }}";
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

        // function filterDepartment(e) { 
        //    $departmentId =  $(e).val();
        //    $('#departmentId').val($departmentId);
        //    table.ajax.reload(); 
        // }

        function editForm(e, id, url) {
            $.ajax({
                type: "POST",
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
                url: "{{ route('admin.goal-review.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        table.ajax.reload();
                        toastr.success(response.message, 'Success');
                        $('#formSubmit').find('.st_loader').hide();
                        $("#bs-example-modal-lg").modal("hide");
                    } else if (response.success == 2) {
                        toastr.info(response.message, 'Inof');
                        $('#formSubmit').find('.st_loader').hide();
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
                        // console.log('Error:', data);
                    }
                });
            }
        }
        
        $(document).ready(function() {
         function loadTabContent(href, targetTab) {
            $.ajax({
                url: href,
                type: 'GET',
                success: function(data) {
                    $('#myTabsContent .tab-pane').html('').removeClass('show active');
                    $(targetTab).html(data).addClass('show active');
                },
                error: function(error) {
                    // console.error(error);
                }
            });
        }

         $('#myTabs a').click(function(e) {
            e.preventDefault();
            var targetTab = $(this).attr('data-target');
            var href = $(this).attr('href');

            loadTabContent(href, targetTab);
            $('#myTabs a').removeClass('active');
            $(this).addClass('active');

            localStorage.setItem('activeTab', targetTab);
        });

        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $(activeTab).load('{{ route('goalPendingreview') }}');
            $(activeTab).addClass('show active');
        } else {
            $('#tab1').load('{{ route('goalPendingreview') }}');
            // $('#tab11').load('{{ route('basic_info') }}');
            $('#tab1').addClass('show active');
        }
    });

       
    </script>
@endsection
