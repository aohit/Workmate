@extends('user.layouts.app')

@section('content')
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
                        <div class="row">
                            <div class="col-sm-12">
                                @foreach ($departments as $department)
                                <ul class="nav nav-tabs">
                                   
                                    <li class="nav-item">
                                        <a href="javscript:void(0);" id="v-{{ $department->id }}" onclick="openTab({{ $department->id }})" data-id="{{ $department->id }}" data-bs-toggle="tab" aria-expanded="false" class="nav-link p-1">
                                            {{ $department->name }}
                                        </a>
                                    </li>
                                  
                                    
                                </ul>
                                <div class="tab-content pt-0 mb-1">
                                    <div class="tab-pane fade" id="v-pills-{{ $department->id }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                       
                                    </div>
                                    
                                </div>
                                @endforeach
                            </div> <!-- end col-->
                        </div> <!-- end row-->
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
                $("#v-pills-"+id).html('');
                $("#v-pills-"+id).addClass('active show');
                $(".tab-pane").html(''); 
                $("#v-pills-"+id).html(data.view); 
                tableDraw(id);
                profileDetail(user_id)
             },
             error: function() {
                 alert("Failed to load content.");
             }
         });
    }

    function tableDraw(id){
        table = $('#datatable'+id).DataTable({
                    ajax: {
                        "url": "{{route('team.list.show')}}",
                        "type": "POST",
                        "dataType": "json",
                        data: function (d) {
                            d.department_id = id; 
                            return d;
                        }
                    },
                    "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip', 
                        initComplete: function() {
                            $("div.dataTables_length")
                                .html();
                                },
                    columnDefs: [{
                            targets: 0,
                            mData: 'employees'
                        },
                        {
                            targets: 1,
                            mData: 'department'
                        },
                        {
                            targets: 2,
                            mData: 'manager'
                        }

                    ]
                }); 
    }
     
   

    
</script>
@endsection