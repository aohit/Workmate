@extends('user.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable3" class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Review-cycle</th>
                                    <th>Deadline</th>
                                    <th>Updated Date</th>
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
            window.table = $('#datatable3').DataTable({
                ajax: {
                    "url": "{{ route('user.appraisalList') }}",
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
                    @if (auth('web')->user()->hasPermissionTo('creat-appraisal'))
                        $("div.dataTables_length").html(
                            '<button type="button" onclick="addForm(this);return false;" class="btn btn-outline-primary waves-effect waves-light">Add</button>'
                        );
                    @endif
                },
                columnDefs: [{
                        targets: 0,
                        mData: 'name'
                    },
                    {
                        targets: 1,
                        mData: 'reviewcycle'
                    }, {
                        targets: 2,
                        mData: 'deadline'
                    },  {
                    targets: 3,
                    mData: 'updated_at'
                },{
                        targets: 4,
                        mData: 'action'
                    }
                ]
            });
        });

        function formSubmitAppraisal(e) {
            $('#formSubmitAppraisal').find('.st_loader').show();
            event.preventDefault();
            var formData = new FormData($('#formSubmitAppraisal')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('user.store-create-appraisal') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == 1) {
                        table.ajax.reload();
                        toastr.success(response.message, 'Success');
                        $('#formSubmitAppraisal').find('.st_loader').hide();
                        $("#bs-example-modal-lg").modal("hide");
                    } else {
                        toastr.error("Find some error", 'Error');
                        $('#formSubmitAppraisal').find('.st_loader').hide();
                    }

                },
                error: function(xhr, status, error) {
                    $('#formSubmitAppraisal').find('.st_loader').hide();
                    var $err = ''
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $err = $err + value + "<br>"
                    })
                    toastr.error($err, 'Error')
                }
            });
        }

        function editForm(id, url) {
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
            var contentUrl = "{{ route('user.appraisal.genrate') }}";
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
            $(activeTab).load('{{ route('appraisalPendingtask') }}');
            $(activeTab).addClass('show active');
        } else {
            $('#tab1').load('{{ route('appraisalPendingtask') }}');
        }
    </script>
@endsection
