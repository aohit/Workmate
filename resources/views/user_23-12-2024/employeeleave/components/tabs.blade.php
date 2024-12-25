<div class="text-center card-body">
    <div class="inbox-widget">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Total Leave Days</th>
                                    <th>Booked/Taken</th>
                                    <th>Remaining</th>
                                    <th>Advance Leave</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->leaveType->type ?? 'N/A' }}</td> 
                                    <td>{{ $user->total_leave_days ?? 'N/A' }}</td> 
                                    <td>{{ $user->booked ?? 'N/A' }}</td> 
                                    <td>{{ $user->remaining ?? 'N/A' }}</td> 
                                    <td>{{ $user->advance_leave ?? 'N/A' }}</td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    </div>
</div>

<script>
 user_id ="{{ $user_id }}";
</script>