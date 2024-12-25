@extends('user.layouts.app')
@section('content')
<?php 
use App\Enums\EmergencyContectPersonEnum;
?>
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="card-title">Employee Information Edit</h4>
                        </div>
                        <form class="row g-3" action="{{ $route->employee_detailsupdate }}"
                            onsubmit="event.preventDefault();pagesform_submit(this);return false;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $info->id }}">
                            <input type="hidden" name="bankDetailId" value="{{ $info->is_login }}">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $info->name }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $info->email }}" disabled>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom13" class="form-label">Date of Birth</label>
                                <input type="text" id="basic-datepicker" name="date_of_birth"
                                    class="form-control basic-datepicker" placeholder="Date Of Birth"
                                    value="{{ $info->d_o_b }}" disabled>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom12" class="form-label">Gender</label>
                                <select class="form-select"  name="gender" disabled>
                                    <option value="">Select Genger ...</option>
                                    <option value="male" @if($info->gender == "male") @selected(true) @endif>Male</option>
                                    <option value="female" @if($info->gender == "female") @selected(true) @endif >Female</option>
                                    <option value="other" @if($info->gender == "other") @selected(true) @endif >Other</option>
                                  </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="validationCustom13" class="form-label">Job Title</label>
                                <input type="text" id="basic-datepicker" name=""
                                    class="form-control basic-datepicker" placeholder="Job Title"
                                    value="{{ $info->job_title}}" disabled>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="validationCustom02" class="form-label">Department</label>
                                    <select class="form-select" name="department" disabled>
                                        <option value="">-Select-</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->id }}" @if($info->department_id ==
                                            $department->id) selected @endif>{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="validationCustom13" class="form-label">Date Of Joining</label>
                                <input type="text" id="basic-datepicker" name=""
                                    class="form-control basic-datepicker" placeholder="Date Of Joining"
                                    value="{{ $info->employment_start}}" disabled>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom10" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="validationCustom11"
                                    placeholder="Phone Number" name="phone_number" value="{{ $info->phone_number }}" />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom12" class="form-label">Marital Status</label>
                                <select class="form-select"  name="marital_status">
                                    <option value="">Select Marital Status...</option>
                                    <option value="married" @if($info->marital_status == "married") @selected(true) @endif>Married</option>
                                    <option value="single" @if($info->marital_status == "single") @selected(true) @endif >Single</option>
                                    <option value="in-relationship" @if($info->marital_status == "in-relationship") @selected(true) @endif >In-relationship</option>
                                  </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom10" class="form-label">Nationality</label>
                                <select class="form-select select2"  name="nationality" >
                                    <option value="">Select Nationality...</option>
                                    @foreach ($countris as $country)
                                    <option value="{{$country->id}}" @if($info->nationality == $country->id) @selected(true) @endif>{{ $country->name }}</option>
                                    @endforeach
                                  </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom12" class="form-label">National ID Number</label>
                                <input type="text" class="form-control"  placeholder="National Id"
                                    name="national_id" value="{{ $info->national_id }}" />
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            {{-- <section class="" id="select">
                                <div class="mb-3 col-lg-12 border  overflow-auto p-2" style="height: 147px" id="">
                                    <table class="m-auto">
                                        <tbody>
                                            @foreach ($info->EmergencyContact as $emerContect)     
                                            <tr>
                                                <td>
                                                    <div class="row ">
                                                        <div class="col">
                                                            <input type="text" name="emergency_contact_number[]" class="form-control" placeholder="Contect Number" value="{{$emerContect->name}}">
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" name="emergency_contact_person[]" class="form-control" placeholder="Contect person name" value="{{$emerContect->number}}">
                                                        </div>
                                                        <div class="col">
                                                            <select class="form-select" name="emergency_contact_relaton[]" id="">
                                                                <option value="" >Select Relation </option>
                                                                @foreach (EmergencyContectPersonEnum::cases() as $key => $value)
                                                                <option value="{{$value}}" @selected($emerContect->relation == $value->value) > {{ $value }}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline p-0"
                                                        onclick="deleteoptionsRow(this)">
                                                        <span class="mdi mdi-delete fs-3"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-outline p-0"
                                                        onclick="addRow(this)">
                                                        <span class="mdi mdi-plus fs-3"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </section> --}}
                            <div class="mb-3 col-lg-12">
                                <label for="validationCustom10" class="form-label">Residential Address</label>
                                <textarea name="residention_address" id="" class="form-control" rows="3">{{$info->residention_address}}</textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-end">Update <i
                                        class="st_loader spinner-border spinner-border-sm"
                                        style="display:none;"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('page-js-script')
    <script>
    $(document).ready(function() {
        $('.select2').select2(); 
    });

    function addRow(e) {
        let row = $(e).parents('tr');
        let tableRowCount = $("table").find("tr").length;
            if(tableRowCount == 2){
                toastr.info("You can only add 2 persons", "Information");
            }else{

                $(row).after('<tr>' + row.html() + '</tr>');
            }
        // rowValue();
    }

    function deleteoptionsRow(e) {
        let rowCount = $('#select').find('tbody tr').length;
        if (rowCount != 1) {
            if (confirm("Are you sure you want to delete this row?")) {
                $(e).parents('tr').remove();
                // rowValue();
            }
        } else {
            alert('You can not delete this row.');
        }
    }

      function pagesform_submit(e) {
     toastr.clear();
     $(e).find('.st_loader').show();
     $.ajax({
       url: $(e).attr('action'),
       method: "Post",
       dataType: "json",
       data: $(e).serialize(),
       success: function (data) {
   
         if (data.status == 1) {
           toastr.success(data.message, 'Success');
         //   alert();
         //   window.location.href = base_url+'my_profile';
         var surl = "{{ route('my_profile') }}";
                    window.setTimeout(function() { window.location = surl; }, 500);
         //   dataTable.draw(false);
   
         } else if (data.status == 0) {
   
           var $err = '';
           $.each(data.errors, function (key, value) {
             $err = $err + value + "<br>";
           });
           toastr.error($err, 'Error');
         }
         else if (data.status == 2) {
           toastr.success(data.message, 'Success');
           window.setTimeout(function () {
             window.location.href = data.surl;
           }, 1000);
         }
       },
       error: function (data) {
         if (typeof data.responseJSON.status !== 'undefined') {
           toastr.error(data.responseJSON.error, 'Error');
         } else {
           var $err = '';
           $.each(data.responseJSON.errors, function (key, value) {
             $err = $err + value + "<br>";
           });
           toastr.error($err, 'Error');
         }
         $(e).find('.st_loader').hide();
       }
     });
   }
   </script>
   
@endsection
