<div class="container mt-2">
    <div class="text-end">
               <a href="{{ route('creatcompetence',['id'=>base64_encode($userid)]) }}" class="btn btn-outline-info waves-effect waves-light">Add</a>
    </div>
    <div class="card mt-2">
        @empty($comptencies)
            <div class="border p-5" style=" height: 76px; text-align: center; ">
                No Data
            </div>
        @endempty
        @foreach ($comptencies as $comptency)
            <div class="border">
                <div class="card-body py-2">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title"> {{ $comptency->title }} </h5>
                        </div>
                        <div class="col text-end">
                            <div class=" progress m-1">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $comptency->total_progress }}%;" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"> {{ $comptency->total_progress }}%</div>
                            </div>
                        </div>
                    </div>

                    <p class="card-text m-0">{{ $comptency->discription }}</p>
                    <h5>Key items:</h5>
                    @foreach ($comptency->keyresult as $results)
                        <div class="card border mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span> <i class="fas fa-key"></i> {{ $results->title }} </span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar milestone-complete" role="progressbar"
                                        style="width: {{ $results->total_progress }}%;" aria-valuenow="100"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="row">
                                    @if ($results->traking == 'Quantiflable traget')
                                        <div class="col"><small>Start-{{ $results->start }}</small>
                                            <small>Target-{{ $results->target }}</small>
                                        </div>
                                        <div class="col text-end"><small>Current-{{ $results->current }} -
                                                {{ $results->total_progress }}% <small> </div>
                                    @elseif($results->traking == 'Milestone')
                                        <div class="col"> <small>{{ $results->traking }}</small></div>
                                        <div class="col text-end">
                                            <small>Complete-{{ $results->total_progress }}%</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="badge bg-success fs-5 ">{{ $comptency->status }}</span>
                        </div>
                        <div class="col text-end">
                            {{-- <button class="btn btn-light btn-sm"><i class="fas fa-sync-alt"></i></button> --}}

                            <button type="button" title="Activity" onclick = "activities({{ $comptency->id }})"
                                class="btn btn-light btn-sm"><i class="mdi mdi-history"></i></button>

                            <a href="{{ route('updatecompetencied', base64_encode($comptency->id) ) }}" class="btn btn-light btn-sm"><i
                                    class="fas fa-pen"></i></a>
                            <a href="javascript:void(0)" onclick="deletedata({{ $comptency->id }})"
                                class="btn btn-light btn-sm"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function deletedata(id) {

        if (confirm("Are You sure want to delete this Row!")) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('destoryompetencied') }}",
                type: "POST",
                data: {
                    'id': id
                },
                success: function(res) {
                    toastr.success(res.message, 'Success');
                    var url = "{{ route('goal',['id' => base64_encode($userid)]) }}"
                    window.location.replace(url);
                },
                error: function(data) {
                    if (typeof data.responseJSON.status !== 'undefined') {
                        toastr.error(data.responseJSON.error, 'Error');
                    } else {
                        $.each(data.responseJSON.errors, function(key, value) {
                            toastr.error(value, 'Error');
                        });
                    }
                    // console.log('Error:', data);
                }
            });
        }
    }

    function activities(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('competencieshistory') }}",
            data: {
                'id': id
            },
            success: function(data) {
                $(".modal-body-data").html(data);
                $("#bs-example-modal-lg").modal("show");
            },
            error: function() {
                alert("Failed to load content.");
            }
        });
    }
</script>
