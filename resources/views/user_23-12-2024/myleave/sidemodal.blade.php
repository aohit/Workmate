<div class="modal-header">
    <h5 class="modal-title" id="rightSideModal">Leave detail</h5>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-lg-5">
                            <label for="validationCustom09" class="form-label">Reporting Person :</label>
                        </div>
                        <div class="mb-3 col-lg-5">
                            <p>{{ $employee_data->reportingTo->name }}</p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Employee</label>
                            <input type="text" class="form-control" placeholder="Name"
                                value="{{ $leavedata->user->name }}" disabled>
                            {{-- <input type="hidden" name="employee_id" class="form-control" value="{{$employee_data->id}}"> --}}
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom01" class="form-label">Leave Type</label>
                            <input type="text" class="form-control" placeholder="Name"
                                value="{{ $leavedata->leaveType->type }}" disabled>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom03" class="form-label">Start Date</label>
                            <input type="text" id="basic-datepicker" value="{{ $leavedata->start_date }}"
                                name="start_date" class="form-control" placeholder="Start Date" disabled>
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="validationCustom04" class="form-label">End Date</label>
                            <input type="text" id="basic-datepicker-two" value="{{ $leavedata->end_date }}"
                                name="end_date" class="form-control" placeholder="End Date" disabled>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <label for="validationCustom05" class="form-label">Description</label>
                            <textarea class="form-control" id="validationCustom01" placeholder="Description" name="description" disabled>{{ $leavedata->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label for="validationCustom09" class="form-label">Leave Details</label>
                            </div>
                            <div class="row mb-3 show-all-date">
                                @foreach ($leavedata->leaveSchedules as $key => $value)
                                    @php  @endphp
                                    @if ($value->type != 0)
                                        <input type="hidden" value="{{ $value->date }}" name="dates[]">
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">{{ $value->date }}</label>
                                        </div>



                                        @if (date('D', strtotime($value->date)) == 'Mon' ||
                                                date('D', strtotime($value->date)) == 'Tue' ||
                                                date('D', strtotime($value->date)) == 'Wed' ||
                                                date('D', strtotime($value->date)) == 'Thu' ||
                                                date('D', strtotime($value->date)) == 'Fri')
                                            <div class="mb-3 col-lg-6">
                                                <select class="form-select" name="leave_timing_type[]">
                                                    <option value="1"
                                                        @if ($value->type == 1) selected @endif>All day
                                                    </option>
                                                    <option value="2"
                                                        @if ($value->type == 2) selected @endif>Half day -
                                                        Morning</option>
                                                    <option value="3"
                                                        @if ($value->type == 3) selected @endif>Half day -
                                                        Evening</option>
                                                    <option value="4"
                                                        @if ($value->type == 4) selected @endif>Other</option>
                                                </select>


                                                <div id="{{ date('DM', strtotime($value->date)) }}"
                                                    class="@if ($value->type != 4) d-none @endif row">
                                                    <div class="mt-2 col-lg-3">
                                                        <select class="form-select" name="start_time[]" disabled>
                                                            <option value="09:25 AM"
                                                                @if ($value->start_time == '09:25 AM') selected @endif>09:25
                                                                AM</option>
                                                            <option value="10:25 AM"
                                                                @if ($value->start_time == '10:25 AM') selected @endif>10:25
                                                                AM</option>
                                                            <option value="10:25 AM"
                                                                @if ($value->start_time == '10:25 AM') selected @endif>10:25
                                                                AM</option>
                                                            <option value="12:25 AM"
                                                                @if ($value->start_time == '12:25 AM') selected @endif>12:25
                                                                AM</option>
                                                        </select>
                                                    </div>
                                                    -
                                                    <div class="mt-2 col-lg-3">
                                                        <select class="form-select" name="end_time[]" disabled>
                                                            <option value="09:25 PM"
                                                                @if ($value->end_time == '09:25 PM') selected @endif>09:25
                                                                PM</option>
                                                            <option value="10:25 PM"
                                                                @if ($value->end_time == '10:25 PM') selected @endif>
                                                                10:25 PM</option>
                                                            <option value="10:25 PM"
                                                                @if ($value->end_time == '10:25 PM') selected @endif>
                                                                10:25 PM</option>
                                                            <option value="12:25 PM"
                                                                @if ($value->end_time == '12:25 PM') selected @endif>
                                                                12:25 PM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div> <!-- end row -->
</div>
<div class="modal-footer">
    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
</div>


@section('page-js-script')
    <script>
       
    function myLeaveSideModal(content) {
        const sidemodal = document.getElementById('sidemodal');
        const sidemodalContent = document.getElementById('sidemodal-content');
        
        // Populate the modal content
        sidemodalContent.innerHTML = content;
        
        // Display the modal
        sidemodal.style.display = 'block';
    }

    </script>
@endsection
