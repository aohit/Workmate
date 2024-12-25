@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                            <div class="col-sm-12">
                                <div class="accordion custom-accordion" id="custom-accordion-one">
                                    @foreach ($departments as $department)
                                        <div class="card mb-0">
                                            <div class="card-header" id="heading-{{ $department->id }}">
                                                <h5 class="m-0 position-relative">
                                                    <a class="custom-accordion-title text-reset d-block"  onclick="openTab({{ $department->id }})" 
                                                        data-bs-toggle="collapse"
                                                        href="#collapse-{{ $department->id }}"
                                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                        id="v-{{ $department->id }}"
                                                        aria-controls="collapse-{{ $department->id }}">
                                                        {{ ucwords($department->name) }}
                                                        <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                    </a>
                                                </h5>
                                            </div>
                                            
                                            <div  class="tab-content collapse {{ $loop->first ? 'show' : '' }}" id="collapse-{{ $department->id }}"
                                                aria-labelledby="heading-{{ $department->id }}"
                                                data-bs-parent="#custom-accordion-one">
                                                <div class="card-body tab-pane fade" id="v-pills-{{ $department->id }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="depId" name="depId" value="{{ $department->id }}">
                                    @endforeach
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div>
               
                    
        </div>

    </div> <!-- end row -->

</div>
@endsection


@section('page-js-script')
<script>
    $('.nav.nav-tabs .nav-item:first-child a').trigger('click');
    
    function profileDetail(id){
        let = id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         let url =  "{{ route('employeehistory.leave.tab') }}";
         $.ajax({
             type: "POST",
             url: url ,
             data: {
                'id':id
             },
             success: function(data) {
                $("#profileTeam .profile").remove();
                $("#profileTeam .col-xl-12").addClass('col-xl-8');
                $("#profileTeam .col-xl-8").removeClass('col-xl-12');
                $("#profileTeam").append(data.view); 
             },
             error: function() {
                 alert("Failed to load content.");
             }
         });
    }
    function openTab(id){
        let = id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         let url =  "{{ route('employee-leave-history.department.tab') }}";
         $.ajax({
             type: "POST",
             url: url ,
             data: {
                'id':id
             },
             success: function(data) {
                if(data.success == 1 ){
                    $("#v-pills-"+id).html('');
                    $("#v-pills-"+id).addClass('active show');
                    $(".tab-pane").html(''); 
                    $("#v-pills-"+id).html(data.view); 
                    tableDraw(id);
                    profileDetail(user_id)
                }else{
                    $("#v-pills-"+id).html('');
                    $("#v-pills-"+id).addClass('active show');
                    $(".tab-pane").html(''); 
                    $("#v-pills-"+id).html('<div height="50px" align="center">Data Not Found</div>');
                }
             },
             error: function() {
                 alert("Failed to load content.");
             }
         });
    }

    function tableDraw(id){
        table = $('#datatable'+id).DataTable({
                    ajax: {
                        "url": "{{route('leavehistory.list.show')}}",
                        "type": "POST",
                        "dataType": "json",
                        data: function (d) {
                            d.department_id = id; 
                            return d;
                        }
                    },
                    "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
                    "scrollX": true,
                    "scrollCollapse": true,
                    "autoWidth": true, 
                    "lengthMenu": [10, 20, 30],
                    "pageLength": 10, 
                        initComplete: function() {
                            $("div.dataTables_length")
                                .html();
                                },
                    columnDefs: [{
                            targets: 0,
                            mData: 'leavetype'
                        },
                        {
                            targets: 1,
                            mData: 'department'
                        },
                        {
                            targets: 2,
                            mData: 'booked'
                        },
                        {
                            targets: 3,
                            mData: 'remaining'
                        }

                    ]
                }); 
    }
     
    $(document).ready(function() {
        var depId =  $(".depId").val();
        openTab(depId);
    });

    
</script>
@endsection