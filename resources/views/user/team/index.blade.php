@extends('user.layouts.app')

@section('content')
<style>
    table tbody tr.active {
    background-color: #d3f4f9 !important; 
}

.dataTables_info{
    /* width: 50%; */
    float: left;
    padding-top: 10px ;
}

td.sorting_1 {
    text-align: justify;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                  <h3>My Team</h3>
                </div>
            </div>

        </div>
        
        <div class="row" id="profileTeam">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
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
                    </div>
                </div>
               {{--  <div class="card">
                    <div class="card-body"> 
                        <table id="datatable" class="table table-borderless mb-0 dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Team Member</th>
                                    <th>Department</th>
                                    <th>Manager</th>
                                </tr>
                            </thead>
                            <tbody>
    
                            </tbody>
                        </table>
                        
                    </div>
                </div>--}} 
    
            </div>
            
                        
                    
        </div>

    </div> <!-- end row -->

</div>
@endsection


@section('page-js-script')
<script>
    $('.nav.nav-tabs .nav-item:first-child a').trigger('click');
    var user_id;
    function profileDetail(id){
        let = id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         let url =  "{{ route('team.profile.tab') }}";
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
                tableDraw(user_id);
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
         let url =  "{{ route('team.department.tab') }}";
         $.ajax({
             type: "POST",
             url: url ,
             data: {
                'id':id
             },
             success: function(data) {
                // $("#v-pills-"+id).html('');
                // $("#v-pills-"+id).addClass('active show');
                // $(".tab-pane").html(''); 
                // $("#v-pills-"+id).html(data.view); 
                // tableDraw(id);
                // profileDetail(user_id)
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

    function tableDraw(id) {
            var table = $('#datatable' + id).DataTable({
                ajax: {
                    "url": "{{route('team.list.show')}}",
                    "type": "POST",
                    "dataType": "json",
                    data: function (d) {
                        d.department_id = id;
                        d.user_id = user_id;
                        return d;
                    }
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                "scrollX": true,
                "scrollCollapse": true,
                "autoWidth": true,
                rowCallback: function (row, data, index) {
                    if (data.id == user_id) {
                        $(row).toggleClass('active');
                    }
                },
                columnDefs: [
                    {
                        targets: 0,
                        mData: 'employees'
                    },
                    {
                        targets: 1,
                        mData: 'job_title'
                    },
                    {
                        targets: 2,
                        mData: 'manager'
                    }
                ]
            });
            $('#datatable' + id).on('click', 'tr', function() {
                var $row = $(this);
                $row.toggleClass('active');
                $row.siblings().removeClass('active');
            });
        }
     
    $(document).ready(function() {
        var depId =  $(".depId").val();
        openTab(depId);
    });

    
</script>
@endsection