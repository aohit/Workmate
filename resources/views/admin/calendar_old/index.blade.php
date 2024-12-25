@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="row">
				<div class="mb-3 col-lg-3">
					<div class="mb-3">
					<label for="validationCustom13" class="form-label">Department</label>
					<select class="form-select" name="department" onchange="GetEmployee(this)">
						<option value="">-Select-</option>
						@foreach($departments as $department)
						<option value="{{ $department->id }}">{{ $department->name }}</option>
						@endforeach
					</select>
					</div>
					<div class="employee-data">
					
					</div>
				</div>
				<div class="col-lg-9">
					<div class="card">
						<div class="card-body">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="emp_id">
@endsection

@section('page-js-script')
<link href="https://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.css" rel="stylesheet">
<script src="https://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js"></script>
<script src="https://fullcalendar.io/js/fullcalendar-2.4.0/lib/jquery.min.js"></script>
<script src="https://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.min.js"></script>

<script>
 
 function GetEmployee(e) { 
	var depId = $(e).val();
			var url = "{{route('admin.calendar.getemployee')}}";
			$.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
			$.ajax({
				type: "GET",
				url: url,
				dataType:'json',
				data: {
					'depId': depId
				},
				success: function(data) { 
					$('#calendar').fullCalendar('removeEvents');
					if(data.leaveDates != ''){ 
					$('#calendar').fullCalendar('addEventSource', data.leaveDates);
					}
					
				},
				error: function() {
					alert("Failed to load content.");
				}
			});
		}
// function NewEventData(id) {
// 			$('.remove-class').removeClass('active');
// 			$('.active-class-'+id).addClass('active');
// 			$('#emp_id').val(id);
// 			var url = "{{route('admin.calendar.getleave')}}";
// 			$.ajax({
// 				type: "GET",
// 				url: url,
// 				dataType:'json',
// 				data: {
// 					'id': id
// 				},
// 				success: function(data) {
// 					$('#calendar').fullCalendar('removeEvents'); 
// 					$('#calendar').fullCalendar('addEventSource', data);
// 				},
// 				error: function() {
// 					alert("Failed to load content.");
// 				}
// 			});
// 		} 

	
$(document).ready(function () {
    var currentData = []; // Initialize with an empty array 
    var currentDate = new Date();
    var formattedDate = currentDate.toISOString().slice(0, 10);

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
        },
        defaultDate: formattedDate,
        editable: true,
        eventLimit: true,
        events: currentData, // Set the initial data
    });
 
		function loadEventData(id='') {
			 
			var url = "{{route('admin.calendar.getemployee')}}";
			$.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
			$.ajax({
				type: "GET",
				url: url,
				dataType:'json',
				data: {
					'id': id
				},
				success: function(data) {
					$('#calendar').fullCalendar('removeEvents'); 
					$('#calendar').fullCalendar('addEventSource', data);
				},
				error: function() {
					alert("Failed to load content.");
				}
			});
		}
		loadEventData();

    // $('#calendar').on('click', '.fc-next-button', function () { 
        
	// 	var id = $('#emp_id').val();
	// 	if(id){
	// 		NewEventData(id);
	// 	}else{
	// 		loadEventData();
	// 	}
		
    // });

    // $('#calendar').on('click', '.fc-prev-button', function () {
        
	// 	var id = $('#emp_id').val();
	// 	if(id){
	// 		NewEventData(id);
	// 	}else{
	// 		loadEventData();
	// 	}
    // });
});


	// $(document).ready(function() {
		 
	// 	var currentData = [];
	// 	function calendarData(id = "") {
	// 		var url = "{{route('admin.calendar.getleave')}}";
	// 		$.ajax({
	// 			type: "GET",
	// 			url: url,
	// 			dataType:'json',
	// 			data: {
	// 				'id': id
	// 			},
	// 			success: function(data) {
	// 				$('#calendar').fullCalendar('addEventSource', data);  
	// 			},
	// 			error: function() {
	// 				alert("Failed to load content.");
	// 			}
	// 		});
	// 	}
	// 	calendarData();
		 
	// 	var data = allDate;

	// 	var newData = [{
	// 			title: 'stuff',
	// 			start: '2015-03-01'
	// 		},
	// 		{
	// 			title: 'stuff',
	// 			start: '2015-03-02'
	// 		}
	// 	];
	// 	var currentDate = new Date();
	// 	var formattedDate = currentDate.toISOString().slice(0, 10);
	// 	$('#calendar').fullCalendar({
	// 		header: {
	// 			left: 'prev,next today',
	// 			center: 'title',
	// 			right: 'month,agendaWeek,agendaDay'
	// 		},
	// 		defaultDate: formattedDate,
	// 		editable: true,
	// 		eventLimit: true, // allow "more" link when too many events
	// 		events: data
	// 	});
	// 	$('#calendar').on('click', '.fc-next-button', function() {
	// 		//alert('clicked');
	// 		$('#calendar').fullCalendar('removeEvents');
	// 		$('#calendar').fullCalendar('addEventSource', newData);
	// 	});
	// 	$('#calendar').on('click', '.fc-prev-button', function() {
	// 		//alert('clicked');
	// 		$('#calendar').fullCalendar('removeEvents');
	// 		$('#calendar').fullCalendar('addEventSource', data);
	// 	});
	// });


</script>

@endsection