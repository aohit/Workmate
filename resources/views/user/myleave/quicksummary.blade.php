

 <h4 class="card-title">{{ $employeeLeave->leaveType?->type  }}</h4>
 <p> Entitlement <samp>{{ intval($employeeLeave->total_leave_days) ?? 0 }} <span  class="fw-bolder text-dark">Days per year</span></samp> </p>
 {{-- <p  class="fw-bolder text-dark"> Accumulated leave <samp>{{ $employeeLeave->accumulated_leave ?? 0 }}</samp> </p> --}}
 @if(!empty($employeeLeave->accumulated_leave))
 <p class="fw-bolder text-dark"> 
     Accumulated leave <samp>{{ $employeeLeave->accumulated_leave }}</samp> 
 </p>
 @endif
@php 
    $total_leave_days = $employeeLeave->total_leave_days;
    $booked = $employeeLeave->booked;
    $remaining = $employeeLeave->remaining;

    $totalleavedayinHour = $employeeLeave->total_leave_days * 8;

    $bookedHours = floor($booked); 
    $bookedMinutes = ($booked - $bookedHours) * 8;
  
    $remainingDays = floor($remaining);
    $remainingHoursDecimal = ($remaining - $remainingDays) * 8; 
    $remainingHours = floor($remainingHoursDecimal);
    $remainingMinutes = ($remainingHoursDecimal - $remainingHours) * 60;

    $remainingFormatted = "{$remainingDays} days {$remainingHours}.{$remainingMinutes} hours";

    $bookedFormatted = "{$bookedHours} days and {$bookedMinutes} hours";
@endphp
<p>Booked/Taken: <samp  class="fw-bolder text-dark">{{ $bookedHours }}</samp></p>
<p>Remaining: <samp  class="fw-bolder text-dark">{{ intval($remaining) }}</samp></p>
<p  class="fw-bolder text-dark">Carried Over <samp>{{ intval($employeeLeave->carried_over_leave) ?? 0 }}</samp> </p>


