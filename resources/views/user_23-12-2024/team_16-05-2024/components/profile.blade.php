<div class="col-xl-4 profile">
    <div class="card">
        <div class="card-body profile-tab-show"> 
            <div class="text-center card-body">
                <div>
                    <img src="{{asset('assets/images/users/user-1.jpg')}}" class="rounded-circle avatar-xl img-thumbnail mb-2" alt="profile-image">

                    <h4 class="m-0  text-center">{{ $team->name }}</h4>
                    <p class="text-muted text-center">{{ $team->department->name }}</p>
                    <hr class="my-3">
                    <div class="text-start">
                        <p class="text-muted font-13"><strong>Email :</strong> <span class="ms-2">{{ $team->email }}</span></p>
                        <p class="text-muted font-13"><strong>Location :</strong> <span class="ms-2">USA</span></p>
                        <p class="text-muted font-13"><strong>Team :</strong> <span class="ms-2">{{ $team->department->name }}</span></p>
                        <p class="text-muted font-13"><strong>Reports To :</strong> <span class="ms-2">{{ $team->reportingTo->name }}</span></p>
                        <p class="text-muted font-13"><strong>Work Phone :</strong> <span class="ms-2">+57568 65876</span></p>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-primary rounded-pill waves-effect waves-light" href="{{ route('team.profile',$team->id) }}">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>