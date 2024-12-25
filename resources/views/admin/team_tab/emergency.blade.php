<div class="card">
  <div class="collapse" id="collapseExample">
      <div class="card card-body">
          <form id="formSubmit" onsubmit="formSubmit(this);return false;">
              @csrf
              <div class="row">
                  <div class="col-4">
                      <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                          value="" />

                  </div>
                  <div class="col-4">
                      <select class="form-select" name="relation" id="relation">
                          <option value="">Select Relation </option>
                          @foreach (App\Enums\EmergencyContectPersonEnum::cases() as $key => $value)
                              <option value="{{ $value }}">
                                  {{ $value }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-4">
                      <input type="text" class="form-control" id="contact" placeholder="Emergency Contact"
                          name="contact" value="" />
                  </div>
                  <div class="col-12 mt-2 text-end">
                      <button class="btn btn-info" onclick="cancelevent(); "> Save</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  <div class="table-responsive">
      <table id="datatable" class="table table-bordered table-hover">
          <thead>
              <tr>
                  <th>S.No.</th>
                  <th>Name</th>
                  <th>Relation</th>
                  <th>Emergency Contact</th>
                  {{-- <th>Action</th> --}}

              </tr>
          </thead>
          <tbody>
              @if (count($employee) > 0)
                  @php
                      $no = 1;
                  @endphp
                  @foreach ($employee as $detail)
                      <tr>
                          <td class="py-1"> {{ $no }}</td>
                          <td class="py-1 tabledata{{ $detail->id }} ">{{ $detail->name }}</td>
                          <td class="py-1 tabledataedit{{ $detail->id }} d-none ">
                              <input type="text" class="form-control" id="name{{ $detail->id }}"
                                  placeholder="Name" name="name" value="{{ $detail->name }}" />
                          </td>
                          <td class="py-1 tabledata{{ $detail->id }} ">{{ $detail->relation }}</td>
                          <td class="py-1 tabledataedit{{ $detail->id }} d-none ">
                              <select class="form-select" name="emergency_contact_relaton"
                                  id="relation{{ $detail->id }}">
                                  <option value="">Select Relation </option>
                                  @foreach (App\Enums\EmergencyContectPersonEnum::cases() as $key => $value)
                                      <option value="{{ $value }}" @selected($detail->relation == $value->value)>
                                          {{ $value }}</option>
                                  @endforeach
                              </select>
                          </td>
                          <td class="py-1 tabledata{{ $detail->id }} ">{{ $detail->number }}</td>
                          <td class="py-1 tabledataedit{{ $detail->id }} d-none ">
                              <input type="text" class="form-control" id="contact{{ $detail->id }}"
                                  placeholder="Emergency Contact" name="contact_number"
                                  value="{{ $detail->number }}" />
                          </td>
                        
                      </tr>
                      @php
                          $no++;
                      @endphp
                  @endforeach
              @else
                  <tr class="text-center">
                      <td colspan="5" style="text-align: center !important;">
                          <b>No data found</b>
                      </td>
                  <tr>
              @endif

          </tbody>
      </table>
  </div>
</div>

<script>
  function editrow(e) {
      $('.tabledata' + e).addClass('d-none');
      $('.tabledataedit' + e).removeClass('d-none');
  }

  function saveEditRow(e) {
      $('#user_table').find('.loder' + e).show();
      var name = $('#name' + e).val();
      var relation = $('#relation' + e).val();
      var contact = $('#contact' + e).val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'POST',
          url: "{{ route('employee_emergency_update') }}",
          data: {
              name: name,
              relation: relation,
              contact: contact,
              id: e
          },
          success: function(response) {
              if (response.success == 1) {
                  toastr.success(response.message, 'Success');
                  $('#user_table').find('.loder' + e).hide();
                  $('.tabledataedit' + e).addClass('d-none');
                  $('.table-responsive').html(response.view)
                  $('.tabledata' + e).removeClass('d-none');

              } else {
                  toastr.error("Find some error", 'Error');
                  $('#user_table').find('.loder' + e).hide();
              }


          },
          error: function(xhr, status, error) {
              $('#user_table').find('.loder' + e).hide();
              var $err = ''
              $.each(xhr.responseJSON.errors, function(key, value) {
                  $err = $err + value + "<br>"
              })
              toastr.error($err, 'Error')
          }
      });
  }

  function deleterow(e) {

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: 'POST',
          url: "{{ route('employee_emergency_remove') }}",
          data: {
              id: e
          },
          success: function(response) {
              if (response.success == 1) {
                  toastr.success(response.message, 'Success');
                  $('#user_table').find('.loder' + e).hide();
                  $('.tabledataedit' + e).addClass('d-none');
                  $('.table-responsive').html(response.view)
                  $('.tabledata' + e).removeClass('d-none');

              } else {
                  toastr.error("Find some error", 'Error');
                  $('#user_table').find('.loder' + e).hide();
              }


          },
          error: function(xhr, status, error) {
              $('#user_table').find('.loder' + e).hide();
              var $err = ''
              $.each(xhr.responseJSON.errors, function(key, value) {
                  $err = $err + value + "<br>"
              })
              toastr.error($err, 'Error')
          }
      });

  }

  function cancelevent(e) {
      $('.tabledataedit' + e).addClass('d-none');
      $('.tabledata' + e).removeClass('d-none');
  }

  function formSubmit(e) {
      $('#formSubmit').find('.st_loader').show();
      event.preventDefault();
      var formData = new FormData($('#formSubmit')[0]);
      $.ajax({
          type: 'POST',
          url: "{{ route('employee_emergency_store') }}",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              console.log(response);
              if (response.success == 1) {
                  toastr.success(response.message, 'Success');
                  $('.table-responsive').html(response.view)
                  $("#formSubmit")[0].reset();
                  $('#collapsebutton').click();

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
</script>