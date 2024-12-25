<div class="col-xl-4 profile">
    <div class="card">
        <div class="card-body profile-tab-show">
            <div class="text-center card-body">
                <div>
                    <?php
                    if(isset($team->Image->file) && $team->Image->file != ''){
                        $image_url = url('/upload/employee/' . $team->Image->file);
                    }else{
                        $image_url = url('assets/images/users/user-1.jpg');
                    }
                    ?>
                        <div class="d-flex align-items-center">
                            <div class="avatar-lg me-3 flex-shrink-0">
                                <img src="{{ $image_url }}" class="img-thumbnail rounded-circle" style="height: 70px; width: 70px;" style="border-radius: 50%;">
                            </div>
                            <div class="flex-grow-1 overflow-hidden text-start">
                                <h5 class="mt-0 mb-1">{{ ucwords($team->name ?? 'N/A') }}</h5>
                                <span class="text-muted text-truncate">{{ $team->email ?? 'N/A' }}</span><br>
                                <small class="text-warning"><b>{{ $team->job_title ?? 'N/A' }}</b></small>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="text-md-start text-center">
                            <p class="text-muted font-13"><strong>Email :</strong> <span class="ms-2">{{ $team->email ?? 'N/A' }}</span></p>
                            <p class="text-muted font-13"><strong>Nationality :</strong> <span class="ms-2">{{ $team->county?->name ?? 'N/A' }}</span></p>
                            <p class="text-muted font-13"><strong>Team :</strong> <span class="ms-2">{{ $team->department?->name ?? 'N/A' }}</span></p>
                            <p class="text-muted font-13"><strong>Reporting To Manager:</strong> <span class="ms-2">{{ $team->manager->name ?? 'N/A' }}</span></p>
                            <p class="text-muted font-13"><strong>Work Phone :</strong> <span class="ms-2">{{ $team->phone_number ?? 'N/A' }}</span></p>
                        </div>
                        <div class="ext-center mt-3">
                            <a class="btn btn-primary rounded-pill waves-effect waves-light" target="_blank" href="{{ route('team.profile', $team->id) }}">
                                View Profile
                            </a>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>
