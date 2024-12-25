<div class="modal-header">
    <h4 class="modal-title" id="myLargeModalLabel">{{$sub_title}}</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="formSubmit" onsubmit="formSubmit(this);return false;">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 35%;">Employee Name</td>
                                            <td>{{ $employee->name }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Email</td>
                                            <td>{{ $employee->email }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Department</td>
                                            <td>{{ $employee->department->name }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Employment Start Date</td>
                                            <td>{{ $employee->employment_start }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Employment End Date</td>
                                            <td>{{ $employee->employment_end }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Reporting To</td>
                                            <td>{{ $employee->reportingTo->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 35%;">Reportee</td>
                                            <td>
                                                @foreach ($reportees as $reportee)
                                                    {{$reportee->employee->name}}&nbsp;&nbsp; 
                                                @endforeach
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Date Of Birth</td>
                                            <td>{{ $employee->d_o_b }}</td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 35%;">Employee Code</td>
                                            <td>{{ $employee->employee_code }}</td>
                                        </tr> 
                                         <tr>
                                            <td style="width: 35%;">Manager</td>
                                            <td>{{ $employee->manager->name }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div> <!-- end .table-responsive -->
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
 
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 
</form>
 
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>

<script>
// $(document).ready(function() {
// $('#mySelect').select2(); 
// });
 
</script>