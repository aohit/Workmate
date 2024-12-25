function inline_form_submit(e,url) {
    $(e).find('.st_loader').show();
    $.ajax({
        url: $(e).attr('action'),
        method: "POST",
        dataType: "json",
        data: $(e).serialize(),
        success: function(data) {
            if (data.success == 1) {
                toastr.success(data.message, 'Success');
                $(e).find('.st_loader').hide();
                $(e)[0].reset();
            
                window.setTimeout(function() {
                    window.location = url;
                }, 500);
            } else if (data.success == 0) {
                var $err = '';
                $.each(data.errors, function (key, value) {
                  $err = $err + value + "<br>";
                });
                toastr.error($err, 'Error');
            }
        },
        error: function(data) {
            if (typeof data.responseJSON.status !== 'undefined') {
                toastr.error(data.responseJSON.error, 'Error');
            } else {
                $.each(data.responseJSON.errors, function(key, value) {
                    toastr.error(value, 'Error');
                });
            }
            $(e).find('.st_loader').hide();
        }
    });
    $(e).find('.st_loader').hide();
}


function show_row(url) {
$.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: url,
  method: "GET",
  data: {},
  success: function(res) {
    $('#addclient .modal-content').html(res);
    $('#addclient').modal('show');
  }
});
}
